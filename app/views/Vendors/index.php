<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<div class="breadcrumbs-main">
			<ol class="breadcrumb">
                <li><a href='<?=PATH;?>'>Главная</a></li>
                <? if (isset($_GET['search'])): ?>
                    <li><a href='<?=PATH;?>/vendors'>Производители</a></li>
                    <li class='current-crumb'>Поиск товаров по производителю, бренду</li>
                <? else: ?>
                    <li class='current-crumb'>Производители</li>
                <? endif; ?>
			</ol>
		</div>
	</div>
</div>

<div class="pages-content">
	<div class="container">
        <? if (isset($_GET['search'])): ?>
            <h1>Поиск товаров по производителю, бренду</h1>
        <? else: ?>
            <h1>Производители</h1>
        <? endif; ?>
		
		<div class="vendor-search">
			<form action="vendors" class="search-form" method="get" autocomplete="off">
				<div class="search-control" data-control-clean>
					<input type="text" name="search" value="<?= $_GET['search'] ?? '' ?>" placeholder="Поиск товаров по производителю" autocomplete="off">
					<div class="actions">
						<a href="javascript:void(0)" data-input-clean class="search-close"></a>
						<button type="submit" class="btn-gradient" value=""><span>Найти</span></button>
					</div>
				</div>
			</form>
		</div>
		
		<?php if (isset($brands) && !empty($brands)): ?>
			<div class="brands-list">
				<?php foreach ($brands as $brand): ?>
					<a href="<?= PATH; ?>/vendors/<?= $brand['alias'] ?>" class="brands-item">
						<div class="image-wrapper">
							<div class="image">
								<?php if (!empty($brand['img'])): ?>
									<img src="<?= PATH; ?>/brands/<?= $brand['img'] ?>" alt="<?= $brand['title'] ?>" title="<?= $brand['title'] ?>">
								<?php else: ?>
									<img loading="lazy" src="<?= PATH; ?>/images/logo.svg" alt="<?= $brand['title'] ?> title="<?= $brand['title'] ?>">
								<?php endif; ?>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<div class = "if-not">
				<p>Скоро здесь появятся производители с которыми мы работаем</p>
			</div>
		<?php endif; ?>
	</div>
</div>
