<section class="content-header">
	<h1>Настройки сайта</h1>
	<ol class="breadcrumb">
		<li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i>Главная</a></li>
		<li class="active">Настройки</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<form action="<?= ADMIN; ?>/settings/edit" method="post" enctype="multipart/form-data" data-toggle="validator">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								
								<h2>Основные поля</h2>
								
								<div class="form-group has-feedback">
									<label for="title">Название сайта</label>
									<input type="text" name="name_site" class="form-control" id="name_site"
										   placeholder="Название сайта"
										   value="<?= $settings['name_site'] ?>" required>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
								
								<div class="form-group has-feedback">
									<label for="description">Описание сайта</label>
									<input type="text" name="description_site" class="form-control" id="description_site"
										   placeholder="Описание сайта"
										   value="<?= $settings['description_site'] ?>" required>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
								
								<div class="form-group has-feedback">
									<label for="organization">Владелец сайта</label>
									<input type="text" name="name_organization" class="form-control" id="name_organization"
										   placeholder="Владелец сайта"
										   value="<?= $settings['name_organization'] ?>" required>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
								
								<div class="form-group has-feedback">
									<label for="phone">E-mail</label>
									<input type="text" name="email" class="form-control" id="email" placeholder="E-mail"
										   value="<?= $settings['email'] ?>" required>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
								
								<div class="form-group has-feedback">
									<label for="phone">Адрес офиса</label>
									<input type="text" name="address_office" class="form-control" id="address_office"
										   placeholder="Адрес офиса" value="<?= $settings['address_office'] ?>" required>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
								
								<div class="form-group has-feedback">
									<label for="phone">Адрес склада</label>
									<input type="text" name="address_store" class="form-control" id="address_store"
										   placeholder="Адрес склада" value="<?= $settings['address_store'] ?>" required>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
								
								<div class="form-group">
									<label for="schedule">Время работы</label>
									<textarea type="text" name="schedule" class="form-control" id="schedule" rows="2"
											  cols="80"><?= $settings['schedule'] ?></textarea>
								</div>
								
								<div class="form-group">
									<label for="copyright">Копирайт</label>
									<textarea type="text" name="copyright" class="form-control" id="copyright" rows="2"
											  cols="80"><?= $settings['copyright'] ?></textarea>
								</div>
							
							</div>
							
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<h2>Телефоны</h2>
										<div class="form-group has-feedback">
											<label for="phone">Основной телефон</label>
											<input type="text" name="phone" class="form-control" id="phone" placeholder="Основной телефон"
												   value="<?= $settings['phone'] ?>" required>
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
										
										<div class="form-group has-feedback">
											<label for="phone_office">Телефон офиса</label>
											<input type="text" name="phone_office" class="form-control" id="phone_office"
												   placeholder="Телефон офиса" value="<?= $settings['phone_office'] ?>">
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
										
										<div class="form-group has-feedback">
											<label for="phone_store_1">Телефон магазина</label>
											<input type="text" name="phone_store_1" class="form-control" id="phone_store_1"
												   placeholder="Телефон магазина" value="<?= $settings['phone_store_1'] ?>">
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
										
										<div class="form-group has-feedback">
											<label for="phone_store_2">Телефон магазина</label>
											<input type="text" name="phone_store_2" class="form-control" id="phone_store_2"
												   placeholder="Телефон магазина" value="<?= $settings['phone_store_2'] ?>">
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
										
										<div class="form-group has-feedback">
											<label for="phone_manager_1">Телефон менеджера</label>
											<input type="text" name="phone_manager_1" class="form-control" id="phone_manager_1"
												   placeholder="Телефон менеджера" value="<?= $settings['phone_manager_1'] ?>">
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
										
										<div class="form-group has-feedback">
											<label for="phone_manager_2">Телефон менеджера</label>
											<input type="text" name="phone_manager_2" class="form-control" id="phone_manager_2"
												   placeholder="Телефон менеджера" value="<?= $settings['phone_manager_2'] ?>">
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
										
										<div class="form-group has-feedback">
											<label for="phone_general">Общий телефон</label>
											<input type="text" name="phone_general" class="form-control" id="phone_general"
												   placeholder="Общий телефон" value="<?= $settings['phone_general'] ?>">
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
									</div>
									<div class="col-md-6">
										<h2>Микроразметка</h2>
										
										<div class="form-group has-feedback">
											<label for="postal_code">Почтовый индекс</label>
											<input type="text" name="postal_code" class="form-control" id="postal_code" placeholder="Почтовый индекс"
												   value="<?= $settings['postal_code'] ?>" required>
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
										
										<div class="form-group has-feedback">
											<label for="address_locality">Населенный пункт</label>
											<input type="text" name="address_locality" class="form-control" id="address_locality" placeholder="Населенный пункт"
												   value="<?= $settings['address_locality'] ?>" required>
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
										
										<div class="form-group has-feedback">
											<label for="address_street">Улица</label>
											<input type="text" name="address_street" class="form-control" id="address_street" placeholder="Улица"
												   value="<?= $settings['address_street'] ?>" required>
											<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
										</div>
									
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<h2>Логотип в шапке</h2>
								<input type="hidden" name="logo_header_old" value="<?= $settings['logo_header'] ?>">
								
								<?php if (!empty($settings['logo_header'])): ?>
									<img src="/img/<?= $settings['logo_header'] ?>" alt="" style="max-height:80px;">
								<?php endif; ?>
								
								<div class="form-group">
									<label for="logo_header">Загрузить новый логотип</label>
									<input type="file" name="logo_header" id="logo_header" class="form-control">
								</div>
							
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<h2>Логотип в футере</h2>
								<input type="hidden" name="logo_footer_old" value="<?= $settings['logo_footer'] ?>">
								
								<?php if (!empty($settings['logo_footer'])): ?>
									<img src="/img/<?= $settings['logo_footer'] ?>" alt="" style="max-height:80px;">
								<?php endif; ?>
								
								<div class="form-group">
									<label for="logo_footer">Загрузить новый логотип</label>
									<input type="file" name="logo_footer" id="logo_footer" class="form-control">
								</div>
							
							</div>
							
							<div class="col-md-12">
								<h2>Дополнительная информация</h2>
								<div class="form-group has-feedback">
									<label for="legal_entity">Юр.лицо</label>
									<textarea name="legal_entity" id="legal_entity" rows="5"
											  cols="80"><?= $settings['legal_entity'] ?></textarea>
									<div class="help-block with-errors"></div>
								</div>
								
								<h2>Скрипты</h2>
								
								<div class="form-group has-feedback">
									<label for="header_scripts">Скрипт в head</label>
									<textarea name="header_scripts" id="header_scripts" rows="5"
											  cols="80"><?= $settings['header_scripts'] ?></textarea>
									<div class="help-block with-errors"></div>
								</div>
								
								<div class="form-group has-feedback">
									<label for="body_scripts">Скрипт в body</label>
									<textarea name="body_scripts" id="body_scripts" rows="5"
											  cols="80"><?= $settings['body_scripts'] ?></textarea>
									<div class="help-block with-errors"></div>
								</div>
								
								<div class="form-group has-feedback">
									<label for="footer_scripts">Скрипт в footer</label>
									<textarea name="footer_scripts" id="footer_scripts" rows="5"
											  cols="80"><?= $settings['footer_scripts'] ?></textarea>
									<div class="help-block with-errors"></div>
								</div>
								
								
								<div class="box-footer">
									<button class="btn btn-success">Сохранить</button>
									<a href="<?= ADMIN ?>/settings" class="btn btn-default">Отмена</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>