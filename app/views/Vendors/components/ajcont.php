<?php if (isset($products) && !empty($products)): ?>
	<div class="card-list">
		<?php foreach ($products as $item): ?>
			<?php require APP . '/views/components/card.php'; ?>
		<?php endforeach; ?>
	</div>
<?php else: ?>
	<div class="no-products">
		<p>Товары не найдены</p>
	</div>
<?php endif; ?>

<?php if ($pagination->countPages > 1): ?>
	<?=$pagination;?>
<?php endif; ?>