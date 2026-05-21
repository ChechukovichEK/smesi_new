<?php if (!empty($filter_group)): ?>
	<div class="card-list-with-filter">
		
		<!-- Фильтры -->
		<div class="flt">
			<p>Фильтры</p>
			
			<div class="flt-sections">
				<?php foreach ($filter_group as $group_id => $group_item): ?>
					<section class="sky-form">
						<div class="sky_title"><?= $group_item ?><span class="caret"></span></div>
						
						<div class="row1 scroll-pane">
							<div class="col col-4">
								<?php if (isset($attrs[$group_id])): ?>
									<?php foreach ($attrs[$group_id] as $attr_id => $value): ?>
										
										<?php
										$filterIds = is_array($filter) ? $filter : explode(',', (string)$filter);
										$filterIds = array_filter($filterIds);
										$checked = in_array($attr_id, $filterIds) ? 'checked' : '';
										?>
										
										<label class="checkbox">
											<input type="checkbox"
												   class="filter-checkbox"
												   data-filter
												   value="<?= $attr_id ?>"
												<?= $checked ?>>
											<?= $value ?>
										</label>
									
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>
					</section>
				<?php endforeach; ?>
			</div>
			
			<div class="sbros">
				<a class="hover" href="<?= PATH ?>/category/<?= $category->alias ?>">Сбросить фильтры</a>
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
				<?= $no_products_message ?: 'В данной категории товары отсутствуют'; ?>
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
			<?= $no_products_message ?: 'В данной категории товары отсутствуют'; ?>
		</div>
	<?php endif; ?>

<?php endif; ?>