<div class="prod-price-dis">
	<div class="price-text"><p>ваша цена</p></div>
	<div class="price-num">
		<p><?= $product->price_master ?: $product->price ?></p>
		<p>руб./<?= $product->units ?></p>
	</div>
</div>
