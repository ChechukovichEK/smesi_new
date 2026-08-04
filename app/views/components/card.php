<div class="card" itemprop="itemListElement" itemscope itemtype="https://schema.org/Offer">
	
	<?php if ($item['hit']): ?>
		<div class="card-hit">ХИТ продаж</div>
	<?php endif; ?>
	
	<?php if ($item['sale']): ?>
		<div class="card-sale">Акция</div>
	<?php endif; ?>
	
	<a href="<?= PATH; ?>/product/<?= $item['alias'] ?>" class="card-img-wrapper">
		<img class="card-img" src="<?= PATH; ?>/prodimg/<?= $item['img'] ?>" itemprop="image"
			 alt="<?= str_replace('"', '', $item['title']) ?>">
	</a>
	
	<?php if (!empty($item['articul'])): ?>
		<p class="card-article">Артикул: <?= $item['articul'] ?></p>
	<?php endif; ?>
	
	<div class="card-is-there">
		<?php if ($item['is_have'] == '1'): ?>
			<span class="card-is-there-green">В наличии</span>
			позиция:<?= $item['position'] ?>; статус:<?= $item['status'] ?>
		<?php else: ?>
			<span class="card-is-there-blue">Скоро в продаже</span>
			позиция:<?= $item['position'] ?>; статус:<?= $item['status'] ?>
		<?php endif; ?>
	</div>
	
	<a href="<?= PATH; ?>/product/<?= $item['alias'] ?>" class="card-title">
		<?= $item['title'] ?>
	</a>
	
	<meta itemprop="name" content="<?= $item['title'] ?>">
	<link itemprop="url" href="<?= PATH; ?>/product/<?= $item['alias'] ?>">
	
	<?php if ($item['price'] > 0): ?>
		
		<!-- Базовая цена -->
		<div class="card-price">
			<?php if (!$item['discount']): ?>
				<p class="card-price-val"><?= $item['price'] ?></p>
			<?php else: ?>
				<div class="card-price-val">
					<div><?= round($item['price'] * (100 - $item['discount']) / 100, 2) ?></div>
					<div><?= $item['price'] ?></div>
				</div>
			<?php endif; ?>
			<p class="card-price-text">руб./<?= $item['units'] ?></p>
		</div>
		
		<!-- Персональная цена -->
		<?php
		$status = $_SESSION['user']['status'] ?? null;
		$priceMap = [
			'master' => $item['price_master'] ?? null,
			'opt'    => $item['price_opt'] ?? null,
			'client' => $item['price_dis'] ?? null,
		];
		
		if ($status):
			$userPrice = $priceMap[$status] ?? null;
			?>
			<div class="card-dis">
				<div class="card-dis-val">
					<p class="card-price-val"><?= $userPrice ?: $item['price'] ?></p>
					<p class="card-price-text">руб./<?= $item['units'] ?></p>
				</div>
				<p class="card-dis-text">
					<?= $status === 'client'
						? 'при сумме чека от&nbsp;' . DISCOUNT . 'руб.'
						: 'ваша&nbsp;цена'
					?>
				</p>
			</div>
		<?php else: ?>
			<!-- Для незарегистрированных -->
			<div class="card-dis">
				<div class="card-dis-val">
					<p class="card-price-val"><?= $item['price_dis'] ?: $item['price'] ?></p>
					<p class="card-price-text">руб./<?= $item['units'] ?></p>
				</div>
				<p class="card-dis-text">при сумме чека от&nbsp;<?= DISCOUNT ?>руб.</p>
			</div>
		<?php endif; ?>
		
		<!-- Кнопки -->
		<?php if ($item['is_have'] !== '0' && $item['is_have'] !== '-'): ?>
			<div class="card-action">
				<div class="quantity">
					<div class="input-number__minus">-</div>
					<input class="input-number__input" type="text" pattern="^[0-9]+$" value="1" name="quantity">
					<div class="input-number__plus">+</div>
				</div>
				<a href="cart/add?id=<?= $item['id'] ?>" class="card-btn add-to-cart-link" data-id="<?= $item['id'] ?>">
					В корзину
				</a>
			</div>
		<?php endif; ?>
	
	<?php endif; ?>

</div>
