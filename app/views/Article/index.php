<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<div class="breadcrumbs-main">
			<ol class="breadcrumb">
				<li><a href='<?= PATH; ?>'>Главная</a></li>
				<li class='current-crumb'>Статьи</li>
			</ol>
		</div>
	</div>
</div>

<div class="pages-content">
	<div class="container">
		<h1>Полезный блог</h1>
		<?php if (isset($news) && !empty($news)): ?>
			<div class="blog-list">
				<?php foreach ($news as $item): ?>
					<?php
					$date = new DateTime($item['date']);
					$has_update_date = !empty($item['published_at']) && $item['published_at'] !== '0000-00-00 00:00:00';
					$updated_date = $has_update_date ? new DateTime($item['published_at']) : null;
					
					$formatter = new IntlDateFormatter(
						'ru_RU',
						IntlDateFormatter::LONG,
						IntlDateFormatter::NONE,
					);
					
					$formatter->setPattern('d MMMM yyyy');
					?>
					
					<a
							class="blog-item"
							href="article/<?= $item['alias']; ?>"
							itemprop="blogPosts"
							itemscope
							itemtype="http://schema.org/BlogPosting"
					>
						<div class="image-container">
							<div class="image">
								<img itemprop="image" src="images/<?= $item['img']; ?>" alt="<?= $item['title']; ?>"/>
							</div>
						</div>
						
						<div class="description">
							<h2 class="title" itemprop="headline"><?= $item['title']; ?></h2>
							<div class="data-block">
								<div class="date">
									<?php if ($has_update_date): ?>
										Обновлено: <?= $formatter->format($updated_date); ?>
									<?php else: ?>
										Опубликовано: <?= $formatter->format($date); ?>
									<?php endif; ?>
								</div>
								<meta itemprop="datePublished" content="<?= date('c', strtotime($item['date'])); ?>">
								
								<?php if ($has_update_date): ?>
									<meta itemprop="dateModified" content="<?= date('c', strtotime($item['published_at'])); ?>">
								<?php endif; ?>
							
							</div>
							<div class="text" itemprop="description">
								<?= $item['pre_content']; ?>
							</div>
							<div class="more">Узнать подробнее</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<div class="if-not">
				<p>Скоро здесь появятся самые полезные и интересные статьи о ремонте</p>
			</div>
		<?php endif; ?>
		
		<?php if ($pages > 1): ?>
			
			<ul class="pagination">
				
				<!-- Кнопка "в начало" -->
				<?php if ($page > 1): ?>
					<li><a href="<?= PATH ?>/article?page=1" class="nav-link">«</a></li>
				<?php endif; ?>
				
				<!-- Кнопка "назад" -->
				<?php if ($page > 1): ?>
					<li><a href="<?= PATH ?>/article?page=<?= $page - 1 ?>" class="nav-link">‹</a></li>
				<?php endif; ?>
				
				<!-- Показываем только 3 страницы вокруг текущей -->
				<?php
				$start = max(1, $page - 1);
				$end = min($pages, $page + 1);
				
				// Если текущая страница 1 — показываем 1–3
				if ($page == 1) $end = min(3, $pages);
				
				// Если текущая последняя — показываем последние 3
				if ($page == $pages) $start = max(1, $pages - 2);
				?>
				
				<?php for ($i = $start; $i <= $end; $i++): ?>
					<li class="<?= ($i == $page) ? 'active' : '' ?>">
						<a href="<?= PATH ?>/article?page=<?= $i ?>" class="nav-link"><?= $i ?></a>
					</li>
				<?php endfor; ?>
				
				<!-- Кнопка "вперёд" -->
				<?php if ($page < $pages): ?>
					<li><a href="<?= PATH ?>/article?page=<?= $page + 1 ?>" class="nav-link">›</a></li>
				<?php endif; ?>
				
				<!-- Кнопка "в конец" -->
				<?php if ($page < $pages): ?>
					<li><a href="<?= PATH ?>/article?page=<?= $pages ?>" class="nav-link">»</a></li>
				<?php endif; ?>
			
			</ul>
		
		<?php endif; ?>
	
	</div>
</div>
