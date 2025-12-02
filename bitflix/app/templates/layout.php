<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= htmlspecialchars($title ?? SITE_NAME) ?></title>
	<link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>
<div class="film-collection">
	<?php render('sidebar', ['currentPage' => $currentPage, 'genreName' => $genreName ?? null]); ?>
	<div class="main-content">
		<?php render('header'); ?>

		<?php 
		// Определяем класс контейнера в зависимости от типа контента
		$mainClass = ($contentTemplate === 'detail') ? 'film-detail-container' : 'films-grid';
		?>
		<main class="<?= $mainClass ?>">
			<?php render($contentTemplate, $data ?? []); ?>
		</main>

	</div>
</div>
</body>
</html>