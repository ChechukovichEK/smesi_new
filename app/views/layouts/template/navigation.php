<div class="navigation">
	<div class="container">
		<div class="cat-all">
			<button class="cat-all-open">Каталог</button>
			<div class="cat-open">
				<div class="cat-open-close" title="Закрыть меню"></div>
				<?php new \app\widgets\menu\Menu([
					'tpl' => WWW . '/menu/menu-open.php',
					'container' => 'div',
					'class' => 'cat-open-flex',
				]) ?>
				
				<div class="go-cat">
					<a href="<?= PATH ?>/catalog" class="hover">перейти в каталог</a>
				</div>
			
			</div>
		</div>
		
		<div class="nav-all">
			<button class="nav-all-open">Меню</button>
			<nav class="navigation-main" itemscope itemtype="http://schema.org/SiteNavigationElement">
				
				<?php  $menu = \ishop\App::$app->getProperty('nav_header');
					if ($menu): ?>
					
					<?php foreach ($menu as $item): ?>
						
						<a itemprop="url" class="navigation-main-link" href="<?= PATH ?><?= $item['link'] ?>">
							<?= $item['title'] ?>
						</a>
					
					<?php endforeach; ?>
				
				<?php endif; ?>
				
			</nav>
		</div>
	</div>
</div>