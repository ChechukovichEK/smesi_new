<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<ol class="breadcrumb">
			<li><a href="<?=PATH;?>">Главная</a></li>
			<li>Поиск по запросу "<?=h($query);?>"</li>
		</ol>
	</div>
</div>

<section class="page-search">
	<div class="container">
		<div class="search">
			<h1 class="title">Поиск по каталогу</h1>
			
			<form action="search" class="search-form" method="get" autocomplete="off">
				<div class="search-control" data-control-clean>
					<input type="text" class="typeahead" id="typeModal" name="s" placeholder="Поиск товаров.." autocomplete="off">
					<div class="actions">
						<a href="javascript:void(0)" data-input-clean class="search-close"></a>
						<button type="submit" class="btn-gradient" value=""><span>Найти</span></button>
					</div>
				</div>
			</form>
		</div>
		
		<?php if (isset($products) && !empty($products)): ?>
			
			<div class="page-search-text">Найденные товары: <?= count($products) ?></div>
			<div class="card-list">
				<?php foreach ($products as $item): ?>
					<?php require APP . '/views/components/card.php'; ?>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<div class="page-search-text">По вашему запросу ничего не найдено.</div>
		<?php endif; ?>
	</div>
</section>

<?php

\ishop\App::renderProductList('Рекомендуемые товары', $categoryProducts);
\ishop\App::renderProductList('Недавно просмотренные', $recentlyViewed);

?>


