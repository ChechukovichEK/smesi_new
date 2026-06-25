<?php if (!empty($breadcrumbs)): ?>
	<div class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
		<div class="breadcrumbs-content">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<?= $breadcrumbs ?>
				</ol>
			</div>
		</div>
	</div>
<?php endif; ?>