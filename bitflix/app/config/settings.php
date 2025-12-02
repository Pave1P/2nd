<?php
// Абсолютный путь к app директории (более надежен, чем __DIR__ в разных файлах)
define('APP_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

define('BASE_URL', '/bitflix/public/');
define('IMG_PATH', BASE_URL . 'img/');
define('SITE_NAME', 'FilmCatalog');

// Карта навигационных страниц (избегаем хардкода)
define('NAVIGATION_PAGES', [
	'home' => ['label' => 'Главная', 'url' => BASE_URL . 'pages/index.php'],
	'favorites' => ['label' => 'Избранное', 'url' => BASE_URL . 'pages/favorites.php'],
]);