<?php

/**
 * Форматирует длительность фильма в различных форматах
 * @param int $minutes - длительность в минутах
 * @param string $format - формат: 'minutes' (по умолчанию), 'hm' (часы:минуты)
 */
function formatDuration(int $minutes, string $format = 'minutes'): string {
	switch ($format) {
		case 'hm':
			$hours = intdiv($minutes, 60);
			$mins = $minutes % 60;
			return sprintf('%d:%02d', $hours, $mins);
		case 'minutes':
		default:
			return $minutes . ' мин.';
	}
}

/**
 * Получить все фильмы или фильмы по жанру из БД
 */
function getAllMovies(?string $genreFilter = null): array {
	if ($genreFilter === null) {
		// Получить все фильмы со всеми данными
		$sql = "
			SELECT 
				m.ID, 
				m.TITLE, 
				m.ORIGINAL_TITLE, 
				m.DESCRIPTION, 
				m.DURATION, 
				m.AGE_RESTRICTION, 
				m.RELEASE_DATE,
				m.RATING,
				d.NAME AS DIRECTOR,
				GROUP_CONCAT(DISTINCT a.NAME SEPARATOR ', ') AS CAST,
				GROUP_CONCAT(DISTINCT g.NAME SEPARATOR ', ') AS GENRES
			FROM movie m
			LEFT JOIN director d ON m.DIRECTOR_ID = d.ID
			LEFT JOIN movie_actor ma ON m.ID = ma.MOVIE_ID
			LEFT JOIN actor a ON ma.ACTOR_ID = a.ID
			LEFT JOIN movie_genre mg ON m.ID = mg.MOVIE_ID
			LEFT JOIN genre g ON mg.GENRE_ID = g.ID
			GROUP BY m.ID
			ORDER BY m.TITLE
		";
		
		$movies = db_fetch_all($sql);
	} else {
		// Получить фильмы конкретного жанра
		$sql = "
			SELECT 
				m.ID, 
				m.TITLE, 
				m.ORIGINAL_TITLE, 
				m.DESCRIPTION, 
				m.DURATION, 
				m.AGE_RESTRICTION, 
				m.RELEASE_DATE,
				m.RATING,
				d.NAME AS DIRECTOR,
				GROUP_CONCAT(DISTINCT a.NAME SEPARATOR ', ') AS CAST,
				GROUP_CONCAT(DISTINCT g.NAME SEPARATOR ', ') AS GENRES
			FROM movie m
			LEFT JOIN director d ON m.DIRECTOR_ID = d.ID
			LEFT JOIN movie_actor ma ON m.ID = ma.MOVIE_ID
			LEFT JOIN actor a ON ma.ACTOR_ID = a.ID
			LEFT JOIN movie_genre mg ON m.ID = mg.MOVIE_ID
			LEFT JOIN genre g ON mg.GENRE_ID = g.ID
			WHERE mg.GENRE_ID IN (
				SELECT ID FROM genre WHERE CODE = ? OR NAME = ?
			)
			GROUP BY m.ID
			ORDER BY m.TITLE
		";
		
		$movies = db_fetch_all($sql, 'ss', [$genreFilter, $genreFilter]);
	}
	
	// Нормализировать данные
	return array_map('normalizeMovie', $movies);
}

/**
 * Нормализировать данные фильма из БД
 */
function normalizeMovie(array $movie): array {
	$cast = $movie['CAST'] ? explode(', ', $movie['CAST']) : [];
	$genres = $movie['GENRES'] ? explode(', ', $movie['GENRES']) : [];
	
	return [
		'id'               => (int)$movie['ID'],
		'title'            => $movie['TITLE'],
		'original_title'   => $movie['ORIGINAL_TITLE'] ?? '',
		'year'             => (int)$movie['RELEASE_DATE'] ?? 0,
		'director'         => $movie['DIRECTOR'] ?? 'Unknown',
		'actors'           => $cast,
		'genres'           => $genres,
		'rating'           => (float)$movie['RATING'] ?? 0,
		'duration'         => (int)$movie['DURATION'], // Храним как число, форматируем при выводе
		'description'      => $movie['DESCRIPTION'],
		'age_restriction'  => (int)$movie['AGE_RESTRICTION'] ?? null
	];
}

/**
 * Получить фильм по ID
 */
function getMovieById(int $id): ?array {
	$sql = "
		SELECT 
			m.ID, 
			m.TITLE, 
			m.ORIGINAL_TITLE, 
			m.DESCRIPTION, 
			m.DURATION, 
			m.AGE_RESTRICTION, 
			m.RELEASE_DATE,
			m.RATING,
			d.NAME AS DIRECTOR,
			GROUP_CONCAT(DISTINCT a.NAME SEPARATOR ', ') AS CAST,
			GROUP_CONCAT(DISTINCT g.NAME SEPARATOR ', ') AS GENRES
		FROM movie m
		LEFT JOIN director d ON m.DIRECTOR_ID = d.ID
		LEFT JOIN movie_actor ma ON m.ID = ma.MOVIE_ID
		LEFT JOIN actor a ON ma.ACTOR_ID = a.ID
		LEFT JOIN movie_genre mg ON m.ID = mg.MOVIE_ID
		LEFT JOIN genre g ON mg.GENRE_ID = g.ID
		WHERE m.ID = ?
		GROUP BY m.ID
	";
	
	$movie = db_fetch_one($sql, 'i', [$id]);
	
	return $movie ? normalizeMovie($movie) : null;
}

/**
 * Фильтровать фильмы по жанру и поиску
 */
function filterMovies(array $movies, ?string $genreFilter = null, ?string $search = null): array {
	// Защита от передачи массивов через GET параметры
	if ($genreFilter !== null && !is_string($genreFilter)) {
		return $movies;
	}
	if ($search !== null && !is_string($search)) {
		return $movies;
	}
	
	return array_filter($movies, function ($movie) use ($genreFilter, $search) {
		// Фильтрация по жанру
		if ($genreFilter !== null && $genreFilter !== '') {
			$filtered = false;
			foreach ($movie['genres'] as $genre) {
				if (mb_strtolower($genre) === mb_strtolower($genreFilter)) {
					$filtered = true;
					break;
				}
			}
			if (!$filtered) return false;
		}
		
		// Фильтрация по поиску
		if ($search !== null && $search !== '') {
			$search = mb_strtolower(trim($search));
			$title = mb_strtolower($movie['title']);
			$original = mb_strtolower($movie['original_title']);
			if (mb_strpos($title, $search) === false && mb_strpos($original, $search) === false) {
				return false;
			}
		}
		return true;
	});
}