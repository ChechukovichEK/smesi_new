<section class="content-header">
	<h1>FAQ для статьи</h1>
	<ol class="breadcrumb">
		<li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i>Главная</a></li>
		<li class="active">Список FAQ для статей</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	
	<div class="page-links" style="margin-bottom: 20px;">
		<a href="<?= ADMIN ?>/article/edit?id=<?= $id_article ?>" class="btn btn-primary">
			Редактирование статьи
		</a>
		
		<a href="<?= ADMIN ?>/article-faq/index?id=<?= $id_article ?>" class="btn btn-default">
			FAQ для статьи
		</a>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			
			<div class="box">
				<div class="box-body">
					
					<?php if (!empty($faq)): ?>
						<table class="table table-bordered">
							<thead>
							<tr>
								<th>№</th>
								<th>Вопрос</th>
								<th>Видимость</th>
								<th>Действия</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($faq as $item): ?>
								<tr>
									<td style="width: 40px;"><?= $item->num ?></td>
									<td><?= $item->title ?></td>
									<td style="width: 50px;">
										<?php if ($item->visibility): ?>
											<i class="fa fa-fw fa-eye" style="color: #00a65a;"></i>
										<?php else: ?>
											<i class="fa fa-fw fa-eye-slash" style="color: #f56954;"></i>
										<?php endif; ?>
									</td>
									<td style="width: 110px;">
										<div class="btn-group">
											<a href="/admin/article-faq/edit?id=<?= $item->id ?>"
											   class="btn btn-success"><i class="fa fa-fw fa-pencil"></i></a>
											<a href="/admin/article-faq/delete?id=<?= $item->id ?>"
											   class="btn btn-danger" onclick="return confirm('Удалить?')"><i
														class="fa fa-fw fa-trash"></i></a>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					<?php else: ?>
						<p>FAQ пока нет.</p>
					<?php endif; ?>
					
					<a href="/admin/article-faq/add?id=<?= $id_article ?>" class="btn btn-success"
					   style="margin-top: 20px;">
						Добавить вопрос
					</a>
				
				</div>
			</div>
		
		</div>
</section>
<!-- /.content -->


