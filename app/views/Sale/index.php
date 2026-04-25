<!--start-breadcrumbs-->
<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
        <li><a href='<?=PATH?>'>Главная</a></li>
        <li class='current-crumb'>Скидки/Акции</li>
      </ol>
    </div>
  </div>
</div>
<!--end-breadcrumbs-->

<div class="pages-content">
	<div class="container">
		<h1>Акции и скидки</h1>
		<?php if ($sales): ?>
			<div class="card-list">
				<?php foreach ($sales as $item): ?>
					<?php require APP . '/views/components/card.php'; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
