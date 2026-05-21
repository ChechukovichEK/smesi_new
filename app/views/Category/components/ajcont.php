<div id="ajax-container" class="aj-cont" itemscope itemtype="https://schema.org/OfferCatalog">
	
	<meta itemprop="name" content="<?= $category->title ?>">
	
	<!-- Сортировка -->
	<?php require APP . '/views/Category/components/sort_block.php'; ?>
	
	<!-- Фильтры + товары -->
	<?php require APP . '/views/Category/components/filters_products.php'; ?>
	
	<!-- Пагинация -->
	<?php if ($pagination->countPages > 1): ?>
		<?= $pagination; ?>
	<?php endif; ?>
	
	<!-- SEO-текст -->
	<?php if ($unic_text): ?>
		<div class="text-editor"><?= $unic_text->content ?></div>
	<?php else: ?>
		<?php if (!empty($category->content)): ?>
			<div class="text-editor"><?= $category->content ?></div>
		<?php endif; ?>
	<?php endif; ?>

</div>