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
	<h1>Добавить пункт: <?= $menuName ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li><a href="<?= ADMIN ?>/<?= $ctrl ?>"><?= $menuName ?></a></li>
		<li class="active">Добавление</li>
	</ol>
</section>

<section class="content">
	
	<div class="col-md-6">
		<div class="box">
			<form action="<?= ADMIN ?>/<?= $ctrl ?>/add" method="post" data-toggle="validator">
				
				<div class="box-body">
					
					<input type="hidden" name="position" value="<?= $position ?>">
					
					<div class="form-group has-feedback">
						<label for="title">Название</label>
						<input type="text" name="title" class="form-control" required>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					
					<div class="form-group has-feedback">
						<label>Ссылка</label>
						<input type="text" name="link" class="form-control" placeholder="/category/smesi">
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					
					<div class="form-group">
						<label>Родитель</label>
						<select name="id_parent" class="form-control">
							<option value="0">Корень</option>
							
							<?php foreach ($parents as $p): ?>
								<option value="<?= $p->id ?>">
									<?= str_repeat('— ', $p->depth) . htmlspecialchars($p->title) ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					
					
					<div class="form-group">
						<label>Порядок</label>
						<input type="number" name="num" class="form-control" value="1">
					</div>
					
					<div class="form-group">
						<label>Открывать в</label>
						<select name="target" class="form-control">
							<option value="_self">В этой вкладке</option>
							<option value="_blank">В новой вкладке</option>
						</select>
					</div>
					
					<div class="form-group">
						<label>
							Отображать на сайте
							<input type="checkbox" name="visibility" checked>
						</label>
					</div>
					
					<div class="form-group">
						<label>
							Закрыть от индексации
							<input type="checkbox" name="noindex">
						</label>
					</div>
				
				</div>
				
				<div class="box-footer">
					<button class="btn btn-success">Добавить</button>
					<a href="<?= ADMIN ?>/<?= $ctrl ?>" class="btn btn-default">Вернуться назад</a>
				</div>
			
			</form>
		</div>
	</div>

</section>