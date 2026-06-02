<div class="errors">
	<div class="container">
		<div class="errors-block">
			<h1>404</h1>
			<div class="description">
				<div class="title">Упс, страница переехала по другому адресу</div>
				<div class="text">Вероятно, в ходе обновлений и улучшений, ссылка на запрашиваемый товар была изменена,
					предлагаем найти товар в нашем каталоге
				</div>
				<div class="actions">
					<a href="<?= PATH ?>/catalog" class="btn-gradient">Перейти в каталог</a>
					<a href="/" class="btn-gray">Вернуться на главную</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if (!empty($popular)): ?>
	<div class="errors-popular">
		<div class="container">
			<div class="home-title">
				<div class="title">Популярные товары</div>
			</div>
			<div class="swiper" data-toggle="popular">
				<div class="swiper-wrapper">
					<?php foreach ($popular as $item): ?>
						<div class="swiper-slide">
							<?php require APP . '/views/components/card.php'; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="swiper-nav">
				<div class="swiper-button-prev svp-prev"></div>
				<div class="swiper-button-next svp-next"></div>
			</div>
		</div>
	</div>
<?php endif; ?>