<div class="card-list">
	<?php foreach ($products as $item): ?>
		<?php require APP . '/views/components/card.php'; ?>
	<?php endforeach; ?>
</div>

<?php if ($pagination->countPages > 1): ?>
	<?= $pagination; ?>
<?php endif; ?>