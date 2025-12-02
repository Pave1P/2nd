<?php
require_once __DIR__ . '/../../app/bootstrap.php';

$currentPage = 'home';
$genreName = $_GET['genre'] ?? null;
$search = $_GET['q'] ?? null;

// Защита от передачи массивов через GET параметры
if ($genreName !== null && !is_string($genreName)) {
	$genreName = null;
}
if ($search !== null && !is_string($search)) {
	$search = null;
}

// Получить фильмы из БД с фильтром по жанру
$movies = getAllMovies($genreName);

// Применить фильтр по поиску (в памяти, так как фильтр по жанру уже в SQL)
if ($search) {
	$search = mb_strtolower(trim($search));
	$movies = array_filter($movies, function($movie) use ($search) {
		$title = mb_strtolower($movie['title']);
		$original = mb_strtolower($movie['original_title']);
		return mb_strpos($title, $search) !== false || mb_strpos($original, $search) !== false;
	});
}

$title = $genreName ? htmlspecialchars($genreName) : 'Каталог фильмов';

$data = ['movies' => $movies, 'search' => $search];
$contentTemplate = 'main';

include __DIR__ . '/../../app/templates/layout.php';
