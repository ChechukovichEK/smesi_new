<?php $keys = \app\models\admin\Socials::keysList(); ?>

<div class="container">
	<h2>Редактировать соц. сеть</h2>
	
	<form method="post">
		
		<div class="form-group">
			<label>Соц. сеть</label>
			<select name="key" class="form-control">
				<?php foreach ($keys as $k => $v): ?>
					<option value="<?= $k ?>" <?= $social->key == $k ? 'selected' : '' ?>><?= $v ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		
		<div class="form-group">
			<label>Ссылка</label>
			<input type="text" name="link" class="form-control" value="<?= $social->link ?>" required>
		</div>
		
		<div class="form-group">
			<label>Сортировка</label>
			<input type="number" name="sort" class="form-control" value="<?= $social->sort ?>">
		</div>
		
		<div class="form-group form-check">
			<input type="checkbox" name="is_published" class="form-check-input" <?= $social->is_published ? 'checked' : '' ?>>
			<label class="form-check-label">Публиковать</label>
		</div>
		
		<button class="btn btn-primary">Сохранить</button>
	</form>
</div>