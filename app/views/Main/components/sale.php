<div class="home-products">
	<div class="container">
		<div class="home-title">
			<div class="title">Скидки и акции</div>
		</div>
		<div class="card-list">
			<?php foreach ($sales as $item): ?>
				<?php require APP . '/views/components/card.php'; ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>