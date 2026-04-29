<section class="content-header">
	<h1>Редактирование новости <?= $new->title ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i>Главная</a></li>
		<li><a href="<?= ADMIN ?>/article">Список новостей</a></li>
		<li class="active">Редактирование новости</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab">Статья</a></li>
			<li><a href="#tab_2" data-toggle="tab">FAQ для статьи</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_1">
				
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<form action="<?= ADMIN; ?>/article/edit" method="post" data-toggle="validator">
								<div class="box-body">
									
									<div class="form-group has-feedback">
										<label for="title">Название</label>
										<input type="text" name="title" class="form-control" id="title"
											   placeholder="Название новости" required value="<?= h($new->title); ?>">
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
									
									<div class="form-group">
										<label for="date">Дата публикации</label>
										<input type="date" name="date" class="form-control" id="title"
											   placeholder="Название новости" value="<?= $new->date; ?>">
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
									
									<div class="form-group">
										<label for="published_at">Дата обновления</label>
										<input type="datetime-local"
											   name="published_at"
											   class="form-control"
											   value="<?= $new->published_at ? date('Y-m-d\TH:i', strtotime($new->published_at)) : '' ?>">
									</div>
									
									
									<div class="form-group">
										<label for="description">Вступительный текст</label>
										<input type="text" name="pre_content" class="form-control" id="pre_content"
											   placeholder="Описание" value="<?= h($new->pre_content); ?>">
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
									
									<div class="form-group has-feedback">
										<label for="meta_title">Meta-title</label>
										<input type="text" name="meta_title" class="form-control" id="meta_title"
											   placeholder="Meta-title"
											   maxlength="500"
											   value="<?= h($new->meta_title); ?>">
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
									
									<div class="form-group has-feedback">
										<label for="meta_desc">Meta-description</label>
										<input type="text" name="meta_desc" class="form-control" id="meta_desc"
											   placeholder="Meta-description"
											   maxlength="500"
											   value="<?= h($new->meta_desc); ?>">
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
									
									<div class="form-group has-feedback">
										<label for="meta_desc">ЧПУ</label>
										<input type="text" name="alias" class="form-control" id="alias"
											   placeholder="ЧПУ"
											   maxlength="255"
											   value="<?= h($new->alias); ?>">
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
									
									<div class="form-group has-feedback">
										<label for="content">Основное содержание</label>
										<textarea name="content" id="editor1" rows="10"
												  cols="80"><?= $new->content; ?></textarea>
										<div class="help-block with-errors"></div>
									</div>
									
									<div class="form-group">
										<label for="faq_title">Заголовок FAQ</label>
										<input type="text" name="faq_title" class="form-control"
											   value="<?= h($new->faq_title); ?>">
									</div>
									
									
									<div class="form-group">
										<div class="col-md-4">
											<div class="box box-primary box-solid file-upload">
												<div class="box-header">
													<h3 class="box-title">Изображение</h3>
												</div>
												<div class="box-body">
													<div id="newsimg" class="btn btn-success"
														 data-url="/article/add-image"
														 data-name="newsimg">Выбрать файл
													</div>
													<p><small>Рекомендуемые размеры: 300*200</small></p>
													<div class="newsimg">
														<img src="<?= PATH; ?>/images/<?= $new->img ?>"
															 style="max-height:150px;"
															 data-id="<?= $new->id; ?>" data-src="<?= $new->img; ?>"
															 class="del-item">
													</div>
												</div>
												<div class="overlay">
													<i class="fa fa-refresh fa-spin"></i>
												</div>
											</div>
										</div>
									</div>
								
								</div>
								<div class="box-footer">
									<input type="hidden" name="id" value="<?= $new->id; ?>">
									<input type="hidden" name="img" value="<?= $new->img ?>">
									
									<button type="submit" class="btn btn-success">Сохранить</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			
			</div>
			<!-- /.tab-pane -->
			<div class="tab-pane" id="tab_2">
				
				<h3>FAQ для статьи</h3>
				
				<a href="/admin/article-faq/add?id=<?= $new->id ?>" class="btn btn-success">
					Добавить вопрос
				</a>
				
				<hr>
				
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
								<td style="width: 80px;"><?= $item->visibility ? 'Да' : 'Нет' ?></td>
								<td style="width: 200px;">
									<a href="/admin/article-faq/edit?id=<?= $item->id ?>"
									   class="btn btn-primary btn-sm">Редактировать</a>
									<a href="/admin/article-faq/delete?id=<?= $item->id ?>"
									   class="btn btn-danger btn-sm" onclick="return confirm('Удалить?')">Удалить</a>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				<?php else: ?>
					<p>FAQ пока нет.</p>
				<?php endif; ?>
			
			
			</div>
			<!-- /.tab-pane -->
			<!-- /.tab-pane -->
		</div>
		<!-- /.tab-content -->
	</div>

</section>
<!-- /.content -->
