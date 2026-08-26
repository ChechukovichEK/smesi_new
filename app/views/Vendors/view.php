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
					<h2 class="title">
						<?= $brand['opt_title']?></h2>
					<div class="text">
						<?= $brand['opt_desc']?>
					</div>
					<a href="<?=PATH;?>/vendors/<?= $brand['alias'] ?>#ctaForm" class="btn-gradient" data-toggle="ctaForm">Запросить цены</a>
				</div>
			<?php endif; ?>
			
			<?php if ($categories): ?>
				<div class="filter-category">
					<div class="filter-category-list">
						<a href="<?= PATH ?>/vendors/<?=$brand['alias']?>" class="filter-category-item <?=!isset($_GET['category']) ? 'filter-category-item-current' : ''?>">
							<span>Все товары (<?=$count?>)</span>
						</a>
						<?php foreach ($categories as $category): ?>
							<a href="<?= PATH ?>/vendors/<?=$brand['alias']?>?category=<?= $category['id']; ?>" class="filter-category-item <?=isset($_GET['category']) && $_GET['category'] == $category['id'] ? 'filter-category-item-current' : ''?>">
								<span><?= $category['title']; ?> (<?= $category['product_count']; ?>)</span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

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
</div>