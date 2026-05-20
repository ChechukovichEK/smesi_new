<!--start-breadcrumbs 12-->
<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<div class="breadcrumbs-main">
			<ol class="breadcrumb" itemscope itemtype='https://schema.org/BreadcrumbList'>
				<?= $breadcrumbs; ?>
			</ol>
		</div>
	</div>
</div>
<!--end-breadcrumbs-->

<div class="pages-content">
	<div class="container">
		
		<!-- Заголовок -->
		<?php if (!empty($filter_meta)): ?>
			<h1><?= $category->title . ' ' . $filter_meta; ?></h1>
		<?php else: ?>
			<h1><?= $category->title; ?></h1>
		<?php endif; ?>
		
		<!-- Короткий текст -->
		<?php if ($category->short_text): ?>
			<div style="margin-bottom: 30px;"><?= $category->short_text ?></div>
		<?php endif; ?>
		
		<!-- Дочерние категории -->
		<?php if ($children_cats): ?>
			<div class="filter-category">
				<div class="filter-category-list">
					<?php foreach ($children_cats as $item): ?>
						<a href="<?= PATH ?>/category/<?= $item['alias']; ?>" class="filter-category-item">
							<span><?= $item['title']; ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
		
		<!-- Группы -->
		<?php if ($groupes): ?>
			<div class="groups">
				<div class="groups-content">
					<?php foreach ($groupes as $groupe): ?>
						<a class="group-item hover" href="group/<?= $groupe['alias']; ?>"><?= $groupe['title']; ?></a>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
		
		<!-- Кнопка фильтров -->
		<?php if (!empty($filter_group)) : ?>
			<button class="filter-toggle">Фильтры</button>
		<?php endif; ?>
		
		<!-- Модальное окно фильтров -->
		<div class="filter-modal">
			<div class="filter-modal-content">
				<span class="filter-close">&times;</span>
				<div class="filter-modal-body"></div>
			</div>
		</div>
		
		<!-- AJAX-контейнер -->
		<div id="ajax-container">
			<?php require APP . '/views/Category/components/ajcont.php'; ?>
		</div>
	
	</div>
</div>