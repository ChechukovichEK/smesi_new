<div class="home-brands">
	<div class="container">
		<div class="home-title">
			<div class="title">Популярные бренды</div>
			<a href="<?= PATH ?>/vendors" rel="nofollow">Смотреть все</a>
		</div>
		<div id="homeBrandsSlider">
			<div class="brands-list">
				<?php foreach ($brands as $brand): ?>
					<a href="/vendors/<?= $brand['alias'] ?>" class="brands-item">
						<div class="image-wrapper">
							<div class="image">
								<?php if (!empty($brand['img'])): ?>
									<img src="<?= PATH; ?>/brands/<?= $brand['img'] ?>" alt="<?= $brand['title'] ?>"
										 title="<?= $brand['title'] ?>">
								<?php else: ?>
									<img loading="lazy"
										 src="<?= PATH; ?>/images/logo.svg" alt="<?= $brand['title'] ?> title="<?= $brand['title'] ?>">
								<?php endif; ?>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
			
			<div class="swiper-pagination brands-dots"></div>
		</div>
	</div>
</div>