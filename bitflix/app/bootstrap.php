<?php
session_start();

// Загрузить локальные настройки (БД)
require_once __DIR__ . '/config/local.php';

require_once __DIR__ . '/config/settings.php';
require_once __DIR__ . '/services/Database.php';
require_once __DIR__ . '/functions/template.php';
require_once __DIR__ . '/functions/genres.php';
require_once __DIR__ . '/functions/movies.php';