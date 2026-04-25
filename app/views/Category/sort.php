<div class="aj-cont">
	<div class="sort">
		<p>Сортировка:</p>
		<p class="sort-item hover" data-sort="price">По цене ↑</p>
		<p class="sort-item hover" data-sort="discount">Сначала со скидкой</p>
	</div>
	<?php if ($filter_group): ?>
	<div class="card-list-with-filter">
		<div class="flt">
			<p>Фильтры</p>
			<div class="flt-sections">
			<?php foreach($filter_group as $group_id => $group_item): ?>
				<section  class="sky-form">
					<div class="sky_title"><?=$group_item;?><span class="caret"></span></div>
					<div class="row1 scroll-pane">
						<div class="col col-4">
						<?php if(isset($attrs[$group_id])): ?>
							<?php foreach($attrs[$group_id] as $attr_id => $value): ?>
								<?php
									if(!empty($_GET['filter'])){
										trim($_GET['filter'], ',');
										$filter = explode(',', $_GET['filter']);
									}
									if((!empty($filter) && is_array($filter)) && in_array($attr_id, $filter)){
										$checked = 'checked';
									} else {
									$checked = null;
									}
								?>
								<?php if (!in_array($attr_id, $params_array)): ?>
									<label class="checkbox" style="opacity:0.5;">
										<input type="checkbox" disabled name="checkbox" value="<?=$attr_id;?>" <?=$checked;?>><i></i><?=$value;?>
									</label>
								<?php else: ?>
									<label class="checkbox">
										<input type="checkbox" name="checkbox" value="<?=$attr_id;?>" <?=$checked;?>><i></i><?=$value;?>
									</label>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
						</div>
					</div>
				</section>
			<?php endforeach; ?>
			</div>
			<div class="sbros">
				<a class="hover" href="category/<?=$category['alias'];?>">Сбросить фильтры</a>
			</div>
		</div>
		<?php if(!empty($products)): ?>
			<div class="card-list">
			<?php foreach ($products as $item): ?>
				<?php require APP . '/views/components/card.php'; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
	<?php else: ?>
		<div class="card-list">
			<?php foreach ($products as $item): ?>
				<?php require APP . '/views/components/card.php'; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	
	<?php if($pagination->countPages > 1): ?>
		<?=$pagination;?>
	<?php endif; ?>
	
	<?php if ($unic_text): ?>
		<div class="text-editor">
			<?=$unic_text->content?>
		</div>
		<?php else: ?>
		<?php if (!empty($category->content)): ?>
			<div class="text-editor">
				<?=$category->content?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>
