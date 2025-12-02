<?php if (empty($movies)): ?>
	<p class="no-results">
		<?= $search ? "Ничего не найдено по запросу «" . htmlspecialchars($search) . "»" : "Фильмы не найдены" ?>
	</p>
<?php else: ?>
	<?php foreach ($movies as $movie): ?>
		<div class="film-item">
			<div class="film-cover">
				<img src="<?= IMG_PATH ?><?= $movie['id'] ?>.jpg" alt="<?= htmlspecialchars($movie['title']) ?>">
				<a href="<?= BASE_URL ?>pages/detail.php?id=<?= $movie['id'] ?>" class="detail-btn">ПОДРОБНЕЕ</a>
			</div>
			<div class="film-content">
				<h3 class="film-title"><?= htmlspecialchars($movie['title']) ?> (<?= $movie['year'] ?>)</h3>
				<div class="film-original"><?= htmlspecialchars($movie['original_title']) ?></div>
				<div class="film-summary">
					<?= htmlspecialchars(mb_substr($movie['description'], 0, 140)) ?>...
				</div>
				<div class="film-meta">
                    <span class="duration">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <?= formatDuration($movie['duration']) ?>
                    </span>
					<span class="genres">
                        <?= implode(', ', $movie['genres']) ?>
                    </span>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>