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
		<h1 itemprop="headline"><?=$brand['title']?></h1>
		<div class="text-editor">
			<?php if (!empty($brand['img'])): ?>
				<img class="brand-image" src="<?= PATH; ?>/brands/<?= $brand['img'] ?>" alt="<?= $brand['title'] ?>">
			<?php endif; ?>
			<?= $brand['content'] ?>
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