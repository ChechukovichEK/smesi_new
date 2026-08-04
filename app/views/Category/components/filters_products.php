<?php if (!empty($filter_group)): ?>
	<div class="filters">
		<div class="title">Фильтры</div>
		
		<div class="filters-sections">
			<?php foreach ($filter_group as $group_id => $group_item): ?>
				<section class="filters-sections-form">
					<div class="text">
						<?= htmlspecialchars($group_item, ENT_QUOTES, 'UTF-8') ?>
					</div>
					
					<div class="filters-sections-checkbox">
						<?php if (isset($attrs[$group_id])): ?>
							<?php foreach ($attrs[$group_id] as $attr_id => $value): ?>
								
								<?php
								$filterIds = is_array($filter) ? $filter : [];
								$checked = in_array($attr_id, $filterIds, true) ? 'checked' : '';
								?>
								
								<label class="label">
									<input
											type="checkbox"
											class="checkbox"
											data-filter
											value="<?= (int)$attr_id ?>"
										<?= $checked ?>
									>
									<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>
								</label>
							
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</section>
			<?php endforeach; ?>
		</div>
		
		<div class="sbros">
			<a class="btn btn-none" href="javascript:void(0)" data-modal="close">Применить фильтр</a>
			<a class="btn btn-xs-none" href="<?= PATH ?>/category/<?= htmlspecialchars($category->alias, ENT_QUOTES, 'UTF-8') ?>">Сбросить фильтры</a>
			<a class="btn-link btn-none" href="<?= PATH ?>/category/<?= htmlspecialchars($category->alias, ENT_QUOTES, 'UTF-8') ?>">Сбросить</a>
		</div>
	</div>
<?php endif; ?>
