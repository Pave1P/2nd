<header class="page-header">
	<form class="search-panel" action="<?= BASE_URL ?>pages/index.php" method="get">
		<div class="search-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M21 21L16.65 16.65" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>
		<input class="search-field" name="q" type="search" placeholder="Поиск по каталогу..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
		<button class="action-btn --orange" type="submit">Искать</button>
	</form>
	<div class="header-controls">
		<a href="<?= BASE_URL ?>pages/add-movie.php" class="action-btn --teal">Добавить фильм</a>
	</div>
</header>