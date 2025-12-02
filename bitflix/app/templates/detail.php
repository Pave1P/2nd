<?php if (empty($movie)): ?>
	<p class="no-results">Фильм не найден</p>
<?php else: ?>
	<div class="film-detail-container">
		<article class="film-card">
			<div class="film-image">
				<img src="<?= IMG_PATH ?><?= $movie['id'] ?>.jpg" alt="<?= htmlspecialchars($movie['title']) ?>">
			</div>
			<div class="film-details">
				<div class="film-heading">
					<h1 class="film-title">
						<?= htmlspecialchars($movie['title']) ?> (<?= $movie['year'] ?>)
					</h1>
					<button class="like-btn" aria-label="В избранное">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
						</svg>
					</button>
				</div>

				<div class="title-rating-block">
					<div class="original-title"><?= htmlspecialchars($movie['original_title']) ?></div>
					<?php if ($movie['age_restriction']): ?>
						<span class="age-rating-gray"><?= $movie['age_restriction'] ?>+</span>
					<?php endif; ?>
				</div>

				<div class="film-rating">
					<div class="rating-squares">
						<?php
						$filledSquares = getRatingBars($movie['rating']);
						for ($i = 1; $i <= 10; $i++):
							?>
							<div class="rating-square <?= $i <= $filledSquares ? 'filled' : '' ?>"></div>
						<?php endfor; ?>
					</div>
					<div class="rating-number"><?= $movie['rating'] ?></div>
				</div>

				<div class="film-info">
					<div><strong>Год производства</strong></div>
					<div><?= $movie['year'] ?></div>

					<div><strong>Режиссёр</strong></div>
					<div><?= htmlspecialchars($movie['director']) ?></div>

					<div><strong>В главных ролях</strong></div>
					<div><?= implode(', ', array_map('htmlspecialchars', $movie['actors'])) ?></div>

					<div><strong>Жанры</strong></div>
					<div><?= implode(', ', array_map('htmlspecialchars', $movie['genres'])) ?></div>

					<div><strong>Длительность</strong></div>
					<div><?= formatDuration($movie['duration']) ?></div>
				</div>
				<div><strong>Описание</strong></div>
				<p class="film-description"><?= nl2br(htmlspecialchars($movie['description'])) ?></p>
			</div>
		</article>
	</div>
<?php endif; ?>