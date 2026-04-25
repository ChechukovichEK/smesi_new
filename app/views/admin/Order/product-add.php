<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Добавить товар в заказ № <?=$id;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/order">Заказы</a></li>
        <li class="active">Добавить товар</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                    <form method="post" data-toggle="validator">
                        <div class="box-body">
                          <div class="form-group">
                            <label for="product">Выберите товар</label>
                            <select name="product_id" class="form-control select2"></select>
                          </div>

                            <div class="form-group has-feedback">
                                <label for="qty">Количество</label>
                                <input type="text" name="qty" class="form-control" placeholder="Количество" value="1">
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
