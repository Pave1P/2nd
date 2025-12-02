<aside class="nav-panel">
	<a href="<?= BASE_URL ?>pages/index.php" class="panel-logo">
		<img src="<?= BASE_URL ?>img/logo.svg" alt="BITFLIX">
	</a>
	<nav class="panel-nav">
		<!-- Главная страница -->
		<a href="<?= BASE_URL ?>pages/index.php" class="nav-item <?= $currentPage === 'home' ? '--active' : '' ?>">Главная</a>
		<!-- Жанры -->
		<?php $genres = getAllGenres(); ?>
		<?php foreach ($genres as $key => $name): ?>
			<a href="<?= BASE_URL ?>pages/index.php?genre=<?= urlencode($name) ?>"
			   class="nav-item <?= ($genreName ?? '') === $name ? '--active' : '' ?>">
				<?= htmlspecialchars($name) ?>
			</a>
		<?php endforeach; ?>
		<!-- Избранное -->
		<a href="<?= BASE_URL ?>pages/favorites.php" class="nav-item <?= $currentPage === 'favorites' ? '--active' : '' ?>">Избранное</a>
	</nav>
</aside>