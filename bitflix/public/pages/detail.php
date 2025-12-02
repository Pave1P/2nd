<?php
require_once __DIR__ . '/../../app/bootstrap.php';

$id = $_GET['id'] ?? null;

// Защита от передачи массивов через GET параметры
if ($id !== null && !is_numeric($id)) {
	$id = null;
}

$movie = $id ? getMovieById((int)$id) : null;

$currentPage = 'detail';
$genreName = null; // На странице деталей нет фильтра по жанрам
$title = $movie ? $movie['title'] . ' (' . $movie['year'] . ')' : 'Фильм не найден';

$data = ['movie' => $movie];
$contentTemplate = 'detail';

include __DIR__ . '/../../app/templates/layout.php';
