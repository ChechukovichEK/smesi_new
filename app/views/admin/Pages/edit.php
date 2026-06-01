<section class="content-header">
    <h1>Редактирование <?= $page->title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i>Главная</a></li>
        <li><a href="<?= ADMIN ?>/pages">Страницы</a></li>
        <li class="active">Редактирование страницы</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?= ADMIN; ?>/pages/edit" method="post" data-toggle="validator">
                    <div class="box-body">

                        <div class="form-group has-feedback">
                            <label for="title">Название</label>
                            <input type="text" name="title" class="form-control" id="title"
                                   placeholder="Название новости" required value="<?= h($page->title); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
						
						<div class="form-group">
							<label for="alias">ЧПУ</label>
							<input type="text" class="form-control" id="alias"
								   value="<?= h($page->alias); ?>" disabled>
						</div>

                        <div class="form-group has-feedback">
                            <label for="position">Позиция</label>
                            <input type="text" name="position" class="form-control" id="position"
                                   placeholder="Позиция страницы" value="<?= h($page->position); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="meta_title">Meta-title</label>
                            <input type="text" name="meta_title" class="form-control" id="meta_title"
                                   placeholder="Meta-title"
                                   maxlength="500"
                                   value="<?= h($page->meta_title); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="meta_desc">Meta-description</label>
                            <input type="text" name="meta_desc" class="form-control" id="meta_desc"
                                   placeholder="Meta-description"
                                   maxlength="500"
                                   value="<?= h($page->meta_desc); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Контент</label>
                            <textarea name="content" id="editor1" rows="10" cols="80"><?= $page->content; ?></textarea>
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?= $page->id; ?>">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
