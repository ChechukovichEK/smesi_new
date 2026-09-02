<div class="breadcrumbs">
    <div class="breadcrumbs-content">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href='<?=PATH;?>'>Главная</a></li>
                <li><a href='<?=PATH;?>/vendors'>Производители</a></li>
                <li class='current-crumb'><?=$brand['title']?></li>
            </ol>
        </div>
    </div>
</div>

<div class="pages-content">
	<div class="container">
		<div class="brand-top">
			<h1 itemprop="headline">Товары <?=$brand['title']?></h1>
			<div class="brand-top-inner">
				<?php if (!empty($brand['img'])): ?>
					<img class="image" src="<?= PATH; ?>/brands/<?= $brand['img'] ?>" alt="<?= $brand['title'] ?>">
				<?php endif; ?>
				<div class="brand-top-description">
					<div class="text-editor">
						<?= $brand['content'] ?>
					</div>
				</div>
			</div>
			
			<?php if (!empty($brand['opt_title'])): ?>
				<div class="opt-brand-prices">
					<div class="opt-brand-prices-inner">
						<div class="description">
							<h2 class="title">
								<?= $brand['opt_title']?></h2>
							<div class="text text-editor">
								<?= $brand['opt_desc']?>
							</div>
						</div>
						<div class="action">
							<a href="<?=PATH;?>/vendors/<?= $brand['alias'] ?>#ctaForm" class="btn-gradient" data-toggle="ctaForm">Запросить цены</a>
						</div>
					</div>
					<picture class="opt-brand-prices-bg">
						<img class="image" src="<?= PATH ?>/img/opt_brand_bg.jpg" data-no-webp>
					</picture>
				</div>
			<?php endif; ?>
			
<!--			<?php /*if($categories && count($categories)  > 1): */?>
				<div class="filter-category">
					<div class="filter-category-list">
						<a href="<?php /*= PATH */?>/vendors/<?php /*=$brand['alias']*/?>" class="filter-category-item <?php /*=!isset($_GET['category']) ? 'filter-category-item-current' : ''*/?>">
							<span>Все товары (<?php /*=$count*/?>)</span>
						</a>
						<?php /*foreach ($categories as $category): */?>
							<a href="<?php /*= PATH */?>/vendors/<?php /*=$brand['alias']*/?>?category=<?php /*= $category['id']; */?>" class="filter-category-item <?php /*=isset($_GET['category']) && $_GET['category'] == $category['id'] ? 'filter-category-item-current' : ''*/?>">
								<span><?php /*= $category['title']; */?> (<?php /*= $category['product_count']; */?>)</span>
							</a>
						<?php /*endforeach; */?>
					</div>
				</div>
			<?php /*endif; */?>
		</div>-->
			
			
			<?php if ($categories && count($categories) > 1): ?>
			<div class="filter-category" data-toggle="tabs">
				<div class="filter-category-list">
					<!-- Таб "Все товары" -->
					<a href="#brandTabAll"
					   class="filter-category-item filter-category-item-current"
					   data-tabs="link">
						<span>Все товары (<?=$count?>)</span>
					</a>
					<!-- Табы категорий -->
					<?php $i = 1; foreach($categories as $category): ?>
						<a href="#brandTab<?= $i ?>"
						   class="filter-category-item"
						   data-tabs="link">
							<span><?= $category['title']; ?> (<?= $category['product_count']; ?>)</span>
						</a>
						<?php $i++; endforeach; ?>
				</div>
				
				<!-- Контент "Все товары" -->
				<div class="filter-category-content current" id="brandTabAll" data-tabs="content">
					<div class="card-list">
						<?php if (isset($products)): ?>
							<?php foreach ($products as $item): ?>
								<?php require APP . '/views/components/card.php'; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<?php /*if($pagination->countPages > 1): */?><!--
						<?php /*=$pagination;*/?>
					--><?php /*endif; */?>
				</div>
				
				<!-- Контент категорий -->
				<?php $i = 1; foreach($categories as $category): ?>
					<div class="filter-category-content" id="brandTab<?= $i ?>" data-tabs="content">
						<div class="card-list">
							<!--<p>Категория : <?php /*= $category['id'] */?></p>
							--><?php /*= var_dump($products); */?>
							<?php if (isset($products)): ?>
								<?php foreach ($products as $item): ?>
									<?php if ($item['category_id'] == $category['id']): ?>
										<?php require APP . '/views/components/card.php'; ?>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
					<?php $i++; endforeach; ?>
			</div>
			
			<?php else: ?>
				
				<div id="ajax-container">
					<?php if (isset($products)): ?>
						<div class="card-list">
							<?php foreach ($products as $item): ?>
								<?php require APP . '/views/components/card.php'; ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					
					<?php if($pagination->countPages > 1): ?>
						<?=$pagination;?>
					<?php endif; ?>
				</div>
			
			<?php endif; ?>
	</div>
</div>