<section class="content-header">
	<h1>Список новостей</h1>
	<ol class="breadcrumb">
		<li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i>Главная</a></li>
		<li class="active">Список статей</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>Дата</th>
							<th>Название статьи</th>
							<th>FAQ</th>
							<th>Количество статей: <?= count($news) ?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($news as $item): ?>
							<tr>
								<td style="width: 100px;"><?= $published = $item['date'] ? date('d.m.Y', strtotime($item['date'])) : '—';
									?></td>
								<td><?= $item['title']; ?></td>
								<td style="width: 100px;">
									<div class="hidden"><?= $faq_count = \R::count('articlefaq', 'id_article = ?', [$item['id']]);?></div>
									<?= $faq_count > 0 ? 'Да' : 'Нет'; ?>
								</td>
								<td style="width: 200px;">
									<a href="<?= ADMIN; ?>/article/edit?id=<?= $item['id']; ?>"
									   class="btn btn-primary btn-sm">Редактировать</a>
									<a href="<?= ADMIN; ?>/article/delete?id=<?= $item['id']; ?>"
									   class="btn btn-danger btn-sm" onclick="return confirm('Удалить?')">Удалить</a>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		
		</div>
</section>
<!-- /.content -->
