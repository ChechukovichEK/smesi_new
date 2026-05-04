<?php
$ctrl = $alias;

$names = [
	'top'    => 'Навигация',
	'bottom' => 'Футер',
	'mobile' => 'Мобильное меню',
];

$menuName = $names[$position] ?? 'Меню';
?>

<section class="content-header">
	<h1>Редактировать пункт: <?= $menuName ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li><a href="<?= ADMIN ?>/<?= $ctrl ?>"><?= $menuName ?></a></li>
		<li class="active">Редактирование</li>
	</ol>
</section>

<section class="content">
	
	<div class="col-md-6">
		<div class="box">
			<form action="<?= ADMIN ?>/<?= $ctrl ?>/edit/<?= $item->id ?>" method="post" data-toggle="validator">
				
				<div class="box-body">
					
					<input type="hidden" name="position" value="<?= $position ?>">
					
					<div class="form-group has-feedback">
						<label>Название</label>
						<input type="text" name="title" class="form-control" value="<?= htmlspecialchars($item->title) ?>" required>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					
					<div class="form-group has-feedback">
						<label>Ссылка</label>
						<input type="text" name="link" class="form-control" value="<?= htmlspecialchars($item->link) ?>">
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					
					<div class="form-group">
						<label>Родитель</label>
						<select name="id_parent" class="form-control">
							<option value="0" <?= $item->id_parent == 0 ? 'selected' : '' ?>>Корень</option>
							
							<?php foreach ($parents as $p): ?>
								<?php if ($p->id != $item->id): // нельзя выбрать самого себя ?>
									<option value="<?= $p->id ?>" <?= $item->id_parent == $p->id ? 'selected' : '' ?>>
										<?= str_repeat('— ', $p->depth) . htmlspecialchars($p->title) ?>
									</option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					
					
					<div class="form-group">
						<label>Порядок</label>
						<input type="number" name="num" class="form-control" value="<?= $item->num ?>">
					</div>
					
					<div class="form-group">
						<label>Открывать в</label>
						<select name="target" class="form-control">
							<option value="_self" <?= $item->target == '_self' ? 'selected' : '' ?>>В этой вкладке</option>
							<option value="_blank" <?= $item->target == '_blank' ? 'selected' : '' ?>>В новой вкладке</option>
						</select>
					</div>
					
					<div class="form-group">
						<label>
							Отображать на сайте
							<input type="checkbox" name="visibility" <?= $item->visibility ? 'checked' : '' ?>>
						</label>
					</div>
					
					<div class="form-group">
						<label>
							Закрыть от индексации
							<input type="checkbox" name="noindex" <?= $item->noindex ? 'checked' : '' ?>>
						</label>
					</div>
				
				</div>
				
				<div class="box-footer">
					<button class="btn btn-success">Сохранить</button>
					<a href="<?= ADMIN ?>/<?= $ctrl ?>" class="btn btn-default">Вернуться назад</a>
				</div>
			
			</form>
		</div>
	</div>

</section>