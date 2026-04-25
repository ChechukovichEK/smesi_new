<div class="card" itemprop="itemListElement" itemscope itemtype="https://schema.org/Offer">
	<?php if ($item['hit']): ?>
		<div class="card-hit">ХИТ продаж</div>
	<?php endif; ?>
	<?php if ($item['sale']): ?>
		<div class="card-sale">Акция</div>
	<?php endif; ?>
	<a href="<?= PATH; ?>/product/<?= $item['alias'] ?>" class="card-img-wrapper">
		<img class="card-img" src="<?= PATH; ?>/prodimg/<?= $item['img'] ?>" itemprop="image" alt="<?= str_replace("\"", "", $item['title']) ?>">
	</a>
	<p class="card-article">
		<?php if(!empty($item['articul'])): ?>
			Артикул: <?=$item['articul'] ?>
		<?php endif; ?>
	</p>
	<div class="card-is-there">
		<?php if (($item['is_have'] !== '0') && ($item['is_have'] !== '-')): ?>
			<span class="card-is-there-green">В наличии</span>
		<?php else : ?>
			<span class="card-is-there-blue">Скоро в продаже</span>
		<?php endif; ?>
	</div>
	<a href="<?= PATH; ?>/product/<?= $item['alias'] ?>" class="card-title" >
		<?= $item['title'] ?>
	</a>
    <meta itemprop="name" content="<?= $item['title'] ?>">
    <link itemprop="url" href="<?= PATH; ?>/product/<?= $item['alias']  ?>">

    <?php if ($item['price'] > '0'): ?>
		<div class="card-price">
			<?php if (!($item['discount'])): ?>
				<p class="card-price-val"><?= $item['price']; ?></p>
				<p class="card-price-text">руб./<?= $item['units']; ?></p>
			<?php else: ?>
				<div class="card-price-val">
					<div><?= round(($item['price']) * ((100 - $item['discount']) / 100), 2) ?></div> <div><?= $item['price']; ?></div>
				</div>
				<p class="card-price-text">руб./<?= $item['units']; ?></p>
			<?php endif; ?>
		</div>
		<?php if (isset($_SESSION['user']['status'])): ?>
			<?php if ($_SESSION['user']['status'] == 'master'): ?>
				<div class="card-dis">
					<div class="card-dis-val">
						<?php if (!($item['price_master'])): ?>
							<p class="card-price-val"><?= $item['price']; ?></p>
							<p class="card-price-text">руб./<?= $item['units']; ?></p>
						<?php else: ?>
							<p class="card-price-val"><?= $item['price_master']; ?></p>
							<p class="card-price-text">руб./<?= $item['units']; ?></p>
						<?php endif; ?>
					</div>
					<p class="card-dis-text">ваша&nbsp;цена</p>
				</div>
			<?php endif; ?>
			
			<?php if ($_SESSION['user']['status'] == 'opt'): ?>
				<div class="card-dis">
					<div class="card-dis-val">
						<?php if (!($item['price_opt'])): ?>
							<p class="card-price-val"><?= $item['price']; ?></p>
							<p class="card-price-text">руб./<?= $item['units']; ?></p>
						<?php else: ?>
							<p class="card-price-val"><?= $item['price_opt']; ?></p>
							<p class="card-price-text">руб./<?= $item['units']; ?></p>
						<?php endif; ?>
					</div>
					<p class="card-dis-text">ваша&nbsp;цена</p>
				</div>
			<?php endif; ?>
			
			<?php if ($_SESSION['user']['status'] == 'client'): ?>
				<div class="card-dis">
					<div class="card-dis-val">
						<?php if (!($item['price_dis'])): ?>
							<p class="card-price-val"><?= $item['price']; ?></p>
							<p class="card-price-text">руб./<?= $item['units']; ?></p>
						<?php else: ?>
							<p class="card-price-val"><?= $item['price_dis']; ?></p>
							<p class="card-price-text">руб./<?= $item['units']; ?></p>
						<?php endif; ?>
					</div>
					<p class="card-dis-text">при сумме чека от&nbsp;<?= DISCOUNT; ?>руб.</p>
				</div>
			<?php endif; ?>
		
		<?php else: ?>
			<div class="card-dis">
				<div class="card-dis-val">
					<?php if (!($item['price_dis'])): ?>
						<p class="card-price-val"><?= $item['price']; ?></p>
						<p class="card-price-text">руб./<?= $item['units']; ?></p>
					<?php else: ?>
						<p class="card-price-val"><?= $item['price_dis']; ?></p>
						<p class="card-price-text">руб./<?= $item['units']; ?></p>
					<?php endif; ?>
				</div>
				<p class="card-dis-text">при сумме чека от&nbsp;<?= DISCOUNT; ?>руб.</p>
			</div>
		<?php endif; ?>
		
		<?php if (($item['is_have'] !== '0') && ($item['is_have'] !== '-')): ?>
			<div class="card-action">
				<div class="quantity">
					<div class="input-number__minus">-</div>
					<input class="input-number__input" type="text" pattern="^[0-9]+$" value="1" name="quantity">
					<div class="input-number__plus">+</div>
				</div>
				<a href="cart/add?id=<?= $item['id']; ?>" class="card-btn add-to-cart-link" data-id="<?= $item['id']; ?>">
					В корзину
				</a>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>