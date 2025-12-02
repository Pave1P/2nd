<?php

/**
 * Получить все жанры из БД
 */
function getAllGenres(): array {
	static $genres = null;
	
	if ($genres === null) {
		$rows = db_fetch_all("SELECT ID, CODE, NAME FROM genre ORDER BY NAME");
		
		$genres = [];
		foreach ($rows as $row) {
			$genres[$row['CODE']] = $row['NAME'];
		}
	}
	
	return $genres;
}

/**
 * Получить ключ жанра по названию
 */
function getGenreKey(string $name): ?string {
	$genres = getAllGenres();
	return array_search($name, $genres) ?: null;
}

/**
 * Получить название жанра по ключу
 */
function getGenreName(string $key): string {
	$genres = getAllGenres();
	return $genres[$key] ?? $key;
}

/**
 * Форматирует рейтинг для визуализации (например, количество заполненных квадратиков)
 * @param float $rating - рейтинг (0-10)
 * @return int - количество заполненных блоков (0-10)
 * Используется в шаблонах для отображения рейтинга визуально
 */
function getRatingBars(float $rating): int {
	return (int) min(10, max(0, round($rating)));
}