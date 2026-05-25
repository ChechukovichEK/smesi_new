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
				<i class="glyphicon glyphicon-info-sign"></i> <?= $no_products_message ?: '1В данной категории товары отсутствуют'; ?>
			</div>
		<?php endif; ?>
	
	</div>

<?php else: ?>
	
	<!-- Без фильтров -->
	<?php if (!empty($products)): ?>
		<div class="card-list">
			<?php foreach ($products as $item): ?>
				<?php require APP . '/views/components/card.php'; ?>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<div class="no-products">
			<i class="glyphicon glyphicon-info-sign"></i> <?= $no_products_message ?: '2В данной категории товары отсутствуют'; ?>
		</div>
	<?php endif; ?>

<?php endif; ?>