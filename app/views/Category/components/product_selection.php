<?php if (!empty($products)): ?>
		<?php foreach ($products as $item): ?>
			<?php require APP . '/views/components/card.php'; ?>
		<?php endforeach; ?>
<?php else: ?>
	<div class="no-products">
		Товары не найдены
	</div>
<?php endif; ?>