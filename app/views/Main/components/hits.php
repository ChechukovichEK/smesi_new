<div class="home-products">
	<div class="container">
		<div class="home-title">
			<h2 class="title">Товары - хиты для&nbsp;строительства и&nbsp;ремонта</h2>
		
		</div>
		<div id="homeHitsSlider">
			<div class="card-list">
				<?php foreach ($hits as $item): ?>
					<?php require APP . '/views/components/card.php'; ?>
				<?php endforeach; ?>
			</div>
			
			<div class="swiper-pagination card-dots"></div>
		</div>
	</div>
</div>