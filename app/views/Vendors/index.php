<div class="breadcrumbs">
	<div class="breadcrumbs-content">
		<div class="breadcrumbs-main">
			<ol class="breadcrumb">
				<li><a href='<?=PATH;?>'>Главная</a></li>
				<li class='current-crumb'>Производители</li>
			</ol>
		</div>
	</div>
</div>

<div class="pages-content">
	<div class="container">
	<h1>Производители</h1>
		<?php if (isset($brands) && !empty($brands)): ?>
			<div class="brands-list">
				<?php foreach ($brands as $brand): ?>
					<a href="/vendors/<?= $brand['alias'] ?>" class="brands-item">
						<div class="image-wrapper">
							<div class="image">
								<?php if (!empty($brand['img'])): ?>
									<img src="<?= PATH; ?>/brands/<?= $brand['img'] ?>" alt="<?= $brand['title'] ?>" title="<?= $brand['title'] ?>">
								<?php else: ?>
									<img loading="lazy" src="<?= PATH; ?>/images/logo.svg" alt="<?= $brand['title'] ?> title="<?= $brand['title'] ?>">
								<?php endif; ?>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<div class = "if-not">
				<p>Скоро здесь появятся производители с которыми мы работаем</p>
			</div>
		<?php endif; ?>
	</div>
</div>
