<section class="content-header">
    <h1>Добавление посадочной страницы</h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i>Главная</a></li>
        <li><a href="<?= ADMIN ?>/landing">Страницы</a></li>
        <li class="active">Добавление посадочной страницы</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?= ADMIN; ?>/landing/add" method="post" data-toggle="validator">
                    <div class="box-body">

                        <div class="form-group has-feedback">
                            <label for="title">Наименование</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование" value="<?php isset ($_SESSION['pages_data']['title']) ? h($_SESSION['pages_data']['title']) : null; ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="alias">ЧПУ</label>
                            <input type="text" name="alias" class="form-control" id="alias" placeholder="ЧПУ" value="<?php isset ($_SESSION['pages_data']['alias']) ? h($_SESSION['pages_data']['alias']) : null; ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="alias">ЧПУ раздела</label>
                            <input type="text" name="category_alias" class="form-control" id="category_alias" placeholder="ЧПУ раздела" value="<?php isset ($_SESSION['pages_data']['category_alias']) ? h($_SESSION['pages_data']['category_alias']) : null; ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="alias">Фильтр</label>
                            <input type="text" name="filter" class="form-control" id="filter" placeholder="Фильтр" value="<?php isset ($_SESSION['pages_data']['filter']) ? h($_SESSION['pages_data']['filter']) : null; ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="meta_title">Meta-title</label>
                            <input type="text" name="meta_title" class="form-control" id="meta_title"
                                   placeholder="Meta-title"
                                   maxlength="500"
                                   value="<?php isset ($_SESSION['pages_data']['meta_title']) ? h($_SESSION['pages_data']['meta_title']) : null; ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="meta_desc">Meta-description</label>
                            <input type="text" name="meta_desc" class="form-control" id="meta_desc"
                                   placeholder="Meta-description"
                                   maxlength="500"
                                   value="<?php isset ($_SESSION['pages_data']['meta_desc']) ? h($_SESSION['pages_data']['meta_desc']) : null; ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="short_text">Краткое описание</label>
                            <input type="text" name="short_text" class="form-control" id="short_text"
                                   placeholder="Краткое описание"
                                   value="<?php isset ($_SESSION['pages_data']['short_text']) ? h($_SESSION['pages_data']['short_text']) : null; ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Описание</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?php if (isset($_SESSION['pages_data']['content'])) {echo $_SESSION['pages_data']['content'];}?></textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                </form>
                <?php if (isset ($_SESSION['pages_data'])) unset ($_SESSION['pages_data']); ?>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->