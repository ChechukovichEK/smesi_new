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
							<th>Дата публикации</th>
							<th>Дата обновления</th>
							<th>Название статьи ( Количество статей: <?= count($news) ?> )</th>
							<th>FAQ</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($news as $item): ?>
							<tr>
								<td style="width: 100px;"><?= $published = $item['date'] ? date('d.m.Y', strtotime($item['date'])) : '—';
									?></td>
								<td style="width: 100px;">
									<?php
									$p = trim($item['published_at']);
									$ts = strtotime($p);
									
									echo ($ts && $p !== '0000-00-00 00:00:00')
										? date('d.m.Y', $ts)
										: '—';
									?>
								</td>
								<td><?= $item['title']; ?></td>
								<td style="width: 50px;">
									<div class="hidden"><?= $faq_count = \R::count('articlefaq', 'id_article = ?', [$item['id']]); ?></div>
									<?php if ($faq_count > 0): ?>
										<i class="fa fa-fw fa-eye" style="color: #00a65a;"></i>
									<?php else: ?>
										<i class="fa fa-fw fa-eye-slash" style="color: #f56954;"></i>
									<?php endif; ?>
								</td>
								<td style="width: 150px;">
									<div class="btn-group">
										<a href="<?= ADMIN; ?>/article/edit?id=<?= $item['id']; ?>"
										   class="btn btn-success"><i class="fa fa-fw fa-pencil"></i></a>
										<a href="<?= ADMIN; ?>/article-faq/index?id=<?= $item['id']; ?>"
										   class="btn btn-warning"><i class="fa fa-fw fa-question-circle"></i></a>
										<a href="<?= ADMIN; ?>/article/delete?id=<?= $item['id']; ?>"
										   class="btn btn-danger" onclick="return confirm('Удалить?')"><i
													class="fa fa-fw fa-trash"></i></a>
									</div>
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
