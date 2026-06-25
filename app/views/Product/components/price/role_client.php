<div class="prod-price-dis">
	<div class="price-text"><p>при сумме чека от <?= DISCOUNT ?> руб</p></div>
	<div class="price-num">
		<p><?= $product->price_dis ?: $product->price ?></p>
		<p>руб./<?= $product->units ?></p>
	</div>
</div>
