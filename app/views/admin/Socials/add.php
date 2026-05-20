<?php $keys = \app\models\admin\Socials::keysList(); ?>

<section class="content-header">
	<h2>Добавить соц. сеть</h2>
	<ol class="breadcrumb">
		<li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active">Добавить соц. сеть</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<form method="post">
						
						<div class="form-group">
							<label>Социальная сеть</label>
							<select name="key" class="form-control">
								<?php foreach ($keys as $k => $v): ?>
									<option value="<?= $k ?>"><?= $v ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						
						<div class="form-group">
							<label>Ссылка</label>
							<input type="text" name="link" class="form-control" required>
						</div>
						
						<div class="form-group">
							<label>Сортировка</label>
							<input type="number" name="sort" class="form-control" value="1">
						</div>
						
						<div class="form-group form-check">
							<input type="checkbox" name="is_published" class="form-check-input" value="1" checked>
							<label class="form-check-label">Публиковать</label>
						</div>
						
						<div class="box-footer">
							<button class="btn btn-success">Сохранить</button>
							<a href="<?= ADMIN ?>/socials" class="btn btn-default">Вернуться назад</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>