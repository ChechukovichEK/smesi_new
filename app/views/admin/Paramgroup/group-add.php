<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Новая группа параметров
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/paramgroup/groups-view">Группы товаров</a></li>
        <li class="active">Новая группа</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/paramgroup/group-add" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Тип параметров</label>
                            <input type="text" name="title" class="form-control" placeholder="Тип параметров" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="prod_desc">Название группы</label>
                            <input type="text" name="prod_desc" class="form-control" placeholder="Наименование группы">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group" id="dop_cats">
                          <label for="params">Добавить параметры</label>
                          <select name="params[]" class="form-control selectattrs" multiple></select>
                        </div>

                        <div class="form-group" id="dop_cats">
                          <label for="param_products">Добавить товары</label>
                          <select name="param_products[]" class="form-control select2" multiple></select>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
