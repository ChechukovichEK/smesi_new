<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Редактирование производителя <?=$brand->title;?>
	</h1>
	<p> ID - <?=$brand->id;?></p>
	<ol class="breadcrumb">
		<li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li><a href="<?=ADMIN;?>/brand">Список производителей</a></li>
		<li class="active">Редактирование</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<form action="<?=ADMIN;?>/brand/edit" method="post" data-toggle="validator">
                    <div class="box-body">

                        <div class="form-group has-feedback">
                            <label for="title">Наименование</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование" value="<?=h($brand->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="alias">ЧПУ</label>
                            <input type="text" name="alias" class="form-control" id="alias" placeholder="ЧПУ" value="<?=h($brand->alias);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="title">Приоритет</label>
                            <input type="text" name="sort" class="form-control" id="sort" placeholder="Приоритет" value="<?=h($brand->sort);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
						
						<div class="form-group">
							<label>
								<input type="checkbox" name="is_home" <?= h($brand->is_home) ? ' checked' : null;?>> Показывать на главной
							</label>
						</div>

                        <div class="form-group has-feedback">
                            <label for="meta_title">Meta-title</label>
                            <input type="text" name="meta_title" class="form-control" id="meta_title"
                                   placeholder="Meta-title"
                                   maxlength="500"
                                   value="<?= h($brand->meta_title); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="meta_desc">Meta-description</label>
                            <input type="text" name="meta_desc" class="form-control" id="meta_desc"
                                   placeholder="Meta-description"
                                   maxlength="500"
                                   value="<?= h($brand->meta_desc); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Описание</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?= h($brand->content); ?></textarea>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="box box-primary box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Изображение</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="brandsimg" class="btn btn-success" data-url="/brand/add-image"
                                             data-name="brandsimg">Выбрать файл
                                        </div>
                                        <p><small>Рекомендуемые размеры: 300*200</small></p>
                                        <div class="brandsimg">
                                            <img src="<?= PATH; ?>/brands/<?= $brand->img ?>" style="max-height:150px;"
                                                 data-id="<?= $brand->id; ?>" data-src="<?= $brand->img; ?>"
                                                 class="del-item-brands">
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
                        <input type="hidden" name="id" value="<?=$brand->id;?>">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        <a class="btn btn-danger delete" href="<?=ADMIN;?>/brand/delete?id=<?=$brand['id'];?>">Удалить производителя</a>
                    </div>

				</form>
			</div>
		</div>
	</div>
</section>