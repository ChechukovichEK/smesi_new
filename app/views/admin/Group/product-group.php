<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       Категории товаров
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Категории товаров</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <a href="<?=ADMIN;?>/group/productgroup-add" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Добавить категорию</a>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Наименование</th>
                                <th>Родительская группа</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($product_group as $item): ?>
                            <tr>
                                <td><?=$item['title'];?></td>
                                <td><?=$item['cat'];?></td>
                                <td>
                                    <a href="<?=ADMIN;?>/group/productgroup-edit?id=<?=$item['id'];?>"><i class="fa fa-fw fa-pencil"></i></a>
                                    <a class="delete text-danger" href="<?=ADMIN;?>/group/group-delete?id=<?=$item['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
