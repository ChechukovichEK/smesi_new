<?php
$filter = $filter ?? [];
$filter_group = $filter_group ?? [];
$attrs = $attrs ?? [];
$cat_values = $cat_values ?? [];
$groupes = $groupes ?? [];
?>


<?php if (!empty($filter_group)): ?>
	<div class="card-list-with-filter">
		
		<!-- Фильтры -->
		<div class="filters">
			<div class="title">Фильтры</div>
			
			<div class="filters-sections">
				<?php foreach ($filter_group as $group_id => $group_item): ?>
					<section class="filters-sections-form">
						<div class="text"><?= $group_item ?></div>
						
						<div class="filters-sections-checkbox">
							<?php if (isset($attrs[$group_id])): ?>
								<?php foreach ($attrs[$group_id] as $attr_id => $value): ?>
									
									<?php
									$filterIds = is_array($filter) ? $filter : explode(',', (string)$filter);
									$filterIds = array_filter($filterIds);
									$checked = in_array($attr_id, $filterIds) ? 'checked' : '';
									?>
									
									<label class="label">
										<input type="checkbox" class="checkbox" data-filter value="<?= $attr_id ?>" <?= $checked ?>>
										<?= $value ?>
									</label>
								
								<?php endforeach; ?>
							<?php endif;?>
						</div>
					</section>
				<?php endforeach; ?>
			</div>
			
			<div class="sbros">
				<a class="btn btn-none" href="javascript:void(0)" data-modal="close">Применить фильтр</a>
				<a class="btn btn-xs-none" href="<?= PATH ?>/category/<?= $category->alias ?>">Сбросить фильтры</a>
				<a class="btn-link btn-none" href="<?= PATH ?>/category/<?= $category->alias ?>">Сбросить</a>
			</div>
		</div>
		
		<!-- Товары -->
		<?php if (!empty($products)): ?>
			<div class="card-list-wrapper">
				<div class="card-list-preloader"></div>
				<div class="card-list">
					<?php foreach ($products as $item): ?>
						<?php require APP . '/views/components/card.php'; ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php else: ?>
			<div class="no-products">
				<i class="glyphicon glyphicon-info-sign"></i> <?= $no_products_message ?: 'В данной категории товары отсутствуют'; ?>
			</div>
		<?php endif; ?>
	
	</div>

<?php else: ?>
	
	<!-- Без фильтров -->
	<?php if (!empty($products)): ?>
		<div class="card-list">
			<?php $i = 0; foreach ($products as $item): ?>
				<?php require APP . '/views/components/card.php'; ?>
				
				<?php $i++; ?>
				
				<?php if ($i === 4 && $category->alias == 'khozyajstvennyj-inventar'): ?>
					<div class="card-block">
						<div class="card-block-inner">
							<picture class="card-block-image">
								<img class="image" src="<?= PATH ?>/img/card-block-image.png" data-no-webp>
							</picture>
							<div class="description">
								<div class="title">Оптовые поставки продукции «Строймаш»</div>
								<div class="text">для строительных организаций и оптовых клиентов по специальным ценам</div>
								
								<div class="action">
									<a href="<?=PATH;?>/category/<?= $category->alias ?>#ctaForm" class="btn-gradient" data-toggle="ctaForm">Запросить цены</a>
									<a href="<?=PATH;?>/vendors/stroymash" class="btn-outline">Смотреть каталог «Строймаш»</a>
								</div>
							</div>
						</div>
						<picture class="card-block-bg">
							<img class="image" src="<?= PATH ?>/img/card-block-bg.jpg" data-no-webp>
						</picture>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<div class="no-products">
			<i class="glyphicon glyphicon-info-sign"></i> <?= $no_products_message ?: 'В данной категории товары отсутствуют'; ?>
		</div>
	<?php endif; ?>

<?php endif; ?>