<?php
/** @var \RedBeanPHP\OODBBean $category */
/** @var \ishop\libs\Pagination $pagination */
/** @var array $products */
/** @var array $sortList */
/** @var string|null $unic_text */
/** @var string|null $filter_meta */
?>

<meta itemprop="name" content="<?= $category->title ?>">

<!-- Сортировка -->
<?php require APP . '/views/Category/components/sort_block.php'; ?>

<!-- Фильтры + товары -->
<?php require APP . '/views/Category/components/filters_products.php'; ?>

<!-- Пагинация -->
<?php if (isset($pagination) && $pagination->countPages > 1): ?>
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