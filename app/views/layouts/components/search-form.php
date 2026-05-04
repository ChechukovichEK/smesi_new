<div class="header-top">
	<div class="container">
		<?php if (!empty($_GET)): ?>
			<p class="text">Интернет-магазин строительных материалов</p>
		<?php else: ?>
			<h1 class="text">Интернет-магазин строительных материалов</h1>
		<?php endif; ?>
		
		<div class="search">
			<form action="search" class="search-form" method="get" autocomplete="off">
				<p>
					<input type="text" class="typeahead" id="typeahead" name="s" placeholder="Поиск товаров.."
						   autocomplete="off">
					<input type="submit" class="search-bg" value="" title="Поиск товаров">
				</p>
			</form>
		</div>
	</div>
</div>