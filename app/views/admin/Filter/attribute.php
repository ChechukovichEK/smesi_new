<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Фильтры
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/filter/attribute-group"> Группы фильтров</a></li>
        <li class="active">Фильтры</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <a href="<?=ADMIN;?>/filter/attribute-add" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Добавить атрибут</a>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Наименование</th>
                                <th>Группа фильтров</th>
                                <th>Группа товаров</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php if ($attrs_self): ?>
                                <?php foreach($attrs_self as $id => $item): ?>
                                <tr>
                                    <td><?=$item['value'];?></td>
                                    <td> - </td>
                                    <td> - </td>
                                    <td>
                                        <a href="<?=ADMIN;?>/filter/attribute-edit?id=<?=$item['id'];?>"><i class="fa fa-fw fa-pencil"></i></a>
                                        <a class="delete text-danger" href="<?=ADMIN;?>/filter/attribute-delete?id=<?=$item['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            <?php foreach($attrs as $id => $item): ?>
                                <tr>
                                    <td><?=$item['value'];?></td>
                                    <td><?=$item['group_title'];?></td>
                                    <td><?=$item['cat'];?></td>
                                    <td>
                                        <a href="<?=ADMIN;?>/filter/attribute-edit?id=<?=$item['id'];?>"><i class="fa fa-fw fa-pencil"></i></a>
                                        <a class="delete text-danger" href="<?=ADMIN;?>/filter/attribute-delete?id=<?=$item['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a>
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
