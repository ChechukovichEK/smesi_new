<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<ol class="breadcrumb">
			<li><a href="<?=PATH;?>">Главная</a></li>
			<li>Поиск по запросу "<?=h($query);?>"</li>
		</ol>
	</div>
</div>

<div class="product-wrapper">
	<div class="container">
		<?php if (isset($products) && !empty($products)): ?>
			<div class="card-list">
				<?php foreach ($products as $item): ?>
					<?php require APP . '/views/components/card.php'; ?>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<p>По вашему запросу ничего не найдено</p>
		<?php endif; ?>
	</div>
</div>
