<?php if (!empty($products)): ?>
		<?php foreach ($products as $item): ?>
			<?php require APP . '/views/components/card.php'; ?>
		<?php endforeach; ?>
<?php else: ?>
	<div class="no-products">
		<i class="glyphicon glyphicon-info-sign"></i> В данной категории товары отсутствуют
	</div>
<?php endif; ?>