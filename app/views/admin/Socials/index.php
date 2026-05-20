<section class="content-header">
	<h2>Социальные сети</h2>
	<ol class="breadcrumb">
		<li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active">Социальные сети</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<a href="<?= ADMIN ?>/socials/add" class="btn btn-success">
				<i class="fa fa-plus"></i> Добавить
			</a>
		</div>
		<div class="box-body">
			
			<table class="table table-bordered table-hover">
				<thead>
				<tr>
					<th>#</th>
					<th></th>
					<th>Ссылка</th>
					<th>Сортировка</th>
					
					<th></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($socials as $item): ?>
					<tr>
						<td style="width: 50px;"><?= $item->sort ?></td>
						<td style="width: 80px;">
							<img src="<?= PATH ?>/socials/<?= $item->key ?>.svg" class="img-circle">
						</td>
						
						<td>
							<a href="<?= $item->link ?>" target="_blank" class="btn btn-default">
								<i class="fa fa-fw fa-external-link"></i> <?= $item->link ?>
							</a>
						</td>
						
						
						<td style="width: 50px;">
							<?php if ($item->is_published): ?>
								<i class="fa fa-fw fa-eye" style="color: #00a65a;"></i>
							<?php else: ?>
								<i class="fa fa-fw fa-eye-slash" style="color: #f56954;"></i>
							<?php endif; ?>
						</td>
						
						<td style="width: 110px;">
							<a href="<?= ADMIN ?>/socials/edit?id=<?= $item->id ?>" class="btn btn-success">
								<i class="fa fa-pencil"></i>
							</a>
							<a href="<?= ADMIN ?>/socials/delete?id=<?= $item->id ?>" class="btn btn-danger"
							   onclick="return confirm('Удалить пункт <?= $item->key ?>?')">
								<i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>