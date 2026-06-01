<section class="content-header">
	<h1>Настройки сайта</h1>
</section>

<section class="content">
	
	<div class="box">
		<div class="box-body">
			
			<div class="row">
				<div class="col-md-2">
					<?php if (!empty($settings['logo_header'])): ?>
						<img src="/img/<?= $settings['logo_header'] ?>" alt="" style="max-height:80px;">
					<?php endif; ?>
				</div>
				<div class="col-md-10">
					<h1><?= $settings['name_site'] ?></h1>
					<p><?= $settings['description_site'] ?></p>
				</div>
				
				<div class="col-md-12">
					<div class="form-group">
						<h2>Информация</h2>
						<p><i class="fa fa-fw fa-user"></i> <?= $settings['name_organization'] ?></p>
						<?= $settings['legal_entity'] ?>
					</div>
					
					
					<div class="form-group">
						<h4>Адрес офиса</h4>
						<p><i class="fa fa-fw fa-map-marker"></i><?= $settings['address_office'] ?></p>
						<h4>Адрес склада</h4>
						<p><i class="fa fa-fw fa-map-marker"></i><?= $settings['address_store'] ?></p>
					</div>
					
					<div class="form-group">
						<h4>Телефоны:</h4>
						<p><i class="fa fa-fw fa-phone"></i><?= $settings['phone'] ?></p>
						<p><i class="fa fa-fw fa-phone"></i><?= $settings['phone_office'] ?></p>
						<p><i class="fa fa-fw fa-phone"></i><?= $settings['phone_store_1'] ?></p>
						<p><i class="fa fa-fw fa-phone"></i><?= $settings['phone_store_2'] ?></p>
						<p><i class="fa fa-fw fa-phone"></i><?= $settings['phone_manager_1'] ?></p>
						<p><i class="fa fa-fw fa-phone"></i><?= $settings['phone_manager_2'] ?></p>
						<p><i class="fa fa-fw fa-phone"></i><?= $settings['phone_general'] ?></p>
					</div>
					
					<div class="form-group">
						<p><i class="fa fa-fw fa-copyright"></i> <?= $settings['copyright'] ?></p>
					</div>
				</div>
			</div>
			
			
			<a href="<?= ADMIN ?>/settings/edit" class="btn btn-success">
				<i class="fa fa-fw fa-pencil"></i> Изменить настройки
			</a>
		</div>
		
		<div class="box-footer">
			<h2>Дополнительные настройки для сайта:</h2>
			
			<div class="btn-group">
				<a href="<?= ADMIN ?>/settings/sitemap" class="btn btn-success">
					<i class="fa fa-fw fa-gears"></i> Сгенерировать sitemap.xml
				</a>
				<a href="<?= PATH ?>/sitemap.xml" class="btn btn-primary">
					<i class="fa fa-fw fa-file-text"></i> Открыть sitemap.xml
				</a>
			</div>
		
		</div>
	</div>

</section>