<?php
/**
 * Функции для работы с базой данных
 * Процедурный стиль mysqli_*
 */

$GLOBALS['db_connection'] = null;

/**
 * Подключиться к БД
 */
function db_connect()
{
    $connection = mysqli_init();

    $connected = mysqli_real_connect(
        $connection,
        DB_HOST,
        DB_USER,
        DB_PASS,
        DB_NAME
    );

    if (!$connected) {
        $error = mysqli_connect_errno() . ': ' . mysqli_connect_error();
        throw new Exception('Ошибка подключения БД: ' . $error);
    }

    $encodingResult = mysqli_set_charset($connection, DB_CHARSET);

    if (!$encodingResult) {
        throw new Exception('Ошибка установки кодировки: ' . mysqli_error($connection));
    }

    $GLOBALS['db_connection'] = $connection;
    return $connection;
}

/**
 * Получить подключение к БД
 */
function db_get_connection()
{
    if ($GLOBALS['db_connection'] === null) {
        db_connect();
    }
    return $GLOBALS['db_connection'];
}

/**
 * Выполнить подготовленный запрос
 * 
 * @param string $sql SQL запрос с ? плейсхолдерами
 * @param string $types Типы параметров: 'i' - int, 's' - string, 'd' - double, 'b' - blob
 * @param array $params Массив параметров для подстановки
 * @return mysqli_result|bool Результат запроса или false при ошибке
 */
function db_query($sql, $types = '', $params = [])
{
    $conn = db_get_connection();
    
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        throw new Exception('Ошибка подготовки запроса: ' . mysqli_error($conn));
    }

    // Привязка параметров если они есть
    if (!empty($params) && !empty($types)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Ошибка выполнения запроса: ' . mysqli_stmt_error($stmt));
    }

    return mysqli_stmt_get_result($stmt);
}

/**
 * Получить одну строку результата
 * 
 * @param string $sql SQL запрос
 * @param string $types Типы параметров
 * @param array $params Массив параметров
 * @return array|null Массив с данными или null
 */
function db_fetch_one($sql, $types = '', $params = [])
{
    $result = db_query($sql, $types, $params);

    if (!$result) {
        return null;
    }

    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $row;
}

/**
 * Получить все строки результата
 * 
 * @param string $sql SQL запрос
 * @param string $types Типы параметров
 * @param array $params Массив параметров
 * @return array Массив всех строк
 */
function db_fetch_all($sql, $types = '', $params = [])
{
    $result = db_query($sql, $types, $params);

    if (!$result) {
        return [];
    }

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    mysqli_free_result($result);

    return $rows;
}

/**
 * Закрыть подключение к БД
 */
function db_close()
{
    if ($GLOBALS['db_connection'] !== null) {
        mysqli_close($GLOBALS['db_connection']);
        $GLOBALS['db_connection'] = null;
    }
}

// Автоматическое закрытие при завершении скрипта
register_shutdown_function('db_close');
