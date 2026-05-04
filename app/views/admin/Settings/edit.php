<section class="content-header">
	<h1>Настройки сайта</h1>
	<ol class="breadcrumb">
		<li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Главная</a></li>
		<li class="active">Настройки</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<form action="<?=ADMIN;?>/settings/edit" method="post" data-toggle="validator">
					<div class="box-body">
						
						<div class="form-group has-feedback">
							<label for="phone">Телефон</label>
							<input type="text" name="phone" class="form-control" id="phone" placeholder="Телефона" value="<?=$settings['phone']?>" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
						
						<div class="form-group has-feedback">
							<label for="phone">E-mail</label>
							<input type="text" name="email" class="form-control" id="email" placeholder="E-mail" value="<?=$settings['email']?>" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
						
						<div class="form-group has-feedback">
							<label for="phone">Адрес офиса</label>
							<input type="text" name="address_office" class="form-control" id="address_office" placeholder="Адрес офиса" value="<?=$settings['address_office']?>" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
						
						<div class="form-group has-feedback">
							<label for="phone">Адрес склада</label>
							<input type="text" name="address_store" class="form-control" id="address_store" placeholder="Адрес склада" value="<?=$settings['address_store']?>" required>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
						
						<div class="form-group">
							<label for="phone">Время работы</label>
							<textarea type="text" name="schedule" class="form-control" id="schedule" rows="2" cols="80" ><?=$settings['schedule']?></textarea>
						</div>
						
						<div class="form-group has-feedback">
							<label for="additional_phones">Дополнительные номера (разделять через |)</label>
							<input type="text" name="additional_phones" class="form-control" id="additional_phones" placeholder="Телефона" value="<?=$settings['additional_phones']?>">
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
						
						<div class="form-group has-feedback">
							<label for="legal_entity">Юр.лицо</label>
							<textarea name="legal_entity" id="legal_entity" rows="10" cols="80"><?=$settings['legal_entity']?></textarea>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group has-feedback">
							<label for="header_scripts">Скрипт в head</label>
							<textarea name="header_scripts" id="header_scripts" rows="10" cols="80"><?=$settings['header_scripts']?></textarea>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group has-feedback">
							<label for="body_scripts">Скрипт в body</label>
							<textarea name="body_scripts" id="body_scripts" rows="10" cols="80"><?=$settings['body_scripts']?></textarea>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group has-feedback">
							<label for="footer_scripts">Скрипт в footer</label>
							<textarea name="footer_scripts" id="footer_scripts" rows="10" cols="80"><?=$settings['footer_scripts']?></textarea>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="box-footer">
							<button class="btn btn-success">Сохранить</button>
							<a href="<?= ADMIN ?>/settings" class="btn btn-default">Отмена</a>
						</div>
					
					</div>
				</form>
			</div>
		</div>
	</div>
</section>