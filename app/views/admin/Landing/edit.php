<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование <?=$page->title;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/landing">Список посадочных страниц</a></li>
        <li class="active"><?=$page->title;?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/landing/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование" value="<?=h($page->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="alias">ЧПУ</label>
                            <input type="text" name="alias" class="form-control" id="alias" placeholder="ЧПУ" value="<?=h($page->alias);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="alias">ЧПУ раздела</label>
                            <input type="text" name="category_alias" class="form-control" id="category_alias" placeholder="ЧПУ раздела" value="<?=h($page->category_alias);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="alias">Фильтр</label>
                            <input type="text" name="filter" class="form-control" id="filter" placeholder="Фильтр" value="<?=h($page->filter);?>" required>
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
                            <label for="short_text">Краткое описание</label>
                            <input type="text" name="short_text" class="form-control" id="short_text"
                                   placeholder="Краткое описание"
                                   value="<?= h($page->short_text); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Описание</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?=$page->content;?></textarea>
                        </div>

                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$page->id;?>">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
