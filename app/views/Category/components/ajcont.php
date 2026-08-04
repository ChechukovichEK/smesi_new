<?php require APP . '/views/Category/components/sort_block.php'; ?>

<?php if (!empty($filter_group)): ?>
	<div class="card-list-with-filter">
		
		<?php require APP . '/views/Category/components/filters_products.php'; ?>
		
		<?php if (!empty($products)): ?>
			<div class="card-list-wrapper">
				<div class="card-list-preloader"></div>
				
				<div class="card-list">
					<?php foreach ($products as $item): ?>
						<?php require APP . '/views/components/card.php'; ?>
					<?php endforeach; ?>
				</div>
				
				<?php if (isset($pagination) && $pagination->countPages > 1): ?>
					<?= $pagination; ?>
				<?php endif; ?>
			
			</div>
		<?php else: ?>
			<div class="no-products">
				<i class="glyphicon glyphicon-info-sign"></i>
				<?= $no_products_message ?: 'В данной категории товары отсутствуют'; ?>
			</div>
		<?php endif; ?>
	
	</div>

<?php else: ?>
	
	<?php if (!empty($products)): ?>
		<div class="card-list-wrapper">
			<div class="card-list-preloader"></div>
			
			<div class="card-list">
				<?php foreach ($products as $item): ?>
					<?php require APP . '/views/components/card.php'; ?>
				<?php endforeach; ?>
			</div>
			
			<?php if (isset($pagination) && $pagination->countPages > 1): ?>
				<?= $pagination; ?>
			<?php endif; ?>
		
		</div>
	<?php else: ?>
		<div class="no-products">
			<i class="glyphicon glyphicon-info-sign"></i>
			<?= $no_products_message ?: 'В данной категории товары отсутствуют'; ?>
		</div>
	<?php endif; ?>

<?php endif; ?>
