<?php
require_once __DIR__ . '/../../app/bootstrap.php';

$currentPage = 'favorites';
$title = 'Избранное';
$genreName = null; // На странице избранного нет фильтра по жанрам
$data = [];
$contentTemplate = 'main';

include __DIR__ . '/../../app/templates/layout.php';
