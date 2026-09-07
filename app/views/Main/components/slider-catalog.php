<div class="home-catalog-slider">
	<div class="cat-top-cont swiper">
		<?php if (!isset($_GET['catalog'])) {
			new \app\widgets\menu\Menu([
				'tpl' => WWW . '/menu/menu.php',
				'container' => 'div',
				'class' => 'swiper-wrapper',
			]);
		} ?>
	</div>
	<div class="swiper-button-prev swiper-button-prev-cat-top-cont"></div>
	<div class="swiper-button-next swiper-button-next-cat-top-cont"></div>
</div>
