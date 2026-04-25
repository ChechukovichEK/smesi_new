<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Скрытые товары
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список товаров</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                      <div class="prod_state_buttons" style="display:flex; align-items:center; margin-bottom:10px;">
                        <a style="margin-right: 20px;" href="<?=ADMIN;?>/product" class="btn btn-primary">Все товары</a>
                        <a style="margin-right: 20px;" href="<?=ADMIN;?>/product/hit" class="btn btn-primary">Хиты</a>
                        <a style="margin-right: 20px;" href="<?=ADMIN;?>/product/sale" class="btn btn-primary">Акция</a>
                        <p style="margin-right: 20px;" class="btn btn-default">Скрытые товары</p>
                        <a style="margin-right: 20px;" href="<?=ADMIN;?>/product/nothas" class="btn btn-primary">Нет в наличии</a>

                      </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Группа</th>
                                <th>Позиция</th>
                                <th>Наименование</th>
                                <th>Цена (BYN)</th>
                                <th>Статус(отображать на сайте)</th>
                                <th>Наличие</th>
                                <th>Акция</th>
                                <th>Хит</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($products as $product): ?>
                                <tr>
                                    <td><?=$product['id'];?></td>
                                    <td><?=$product['cat'];?></td>
                                    <td><?=$product['position'];?></td>
                                    <td><?=$product['title'];?></td>
                                    <td><?=$product['price'];?></td>
                                    <td>
                                      <form action="<?=ADMIN;?>/product/editstatus?id=<?=$product['id'];?>" method="post" class="admqty">
                                        <div class="order-qty">
                                          <input type="checkbox" name="status"<?=$product['status'] ? ' checked' : null;?>>
                                        </div>
                                        <input type="hidden" name="id" value="<?=$product['id'];?>">
                                        <button type="submit" class="btn btn-success">Сохранить</button>
                                      </form>
                                    </td>
                                    <td>
                                      <form action="<?=ADMIN;?>/product/edithave?id=<?=$product['id'];?>" method="post" class="admqty">
                                        <div class="order-qty">
                                          <input type="checkbox" name="is_have"<?=$product['is_have'] ? ' checked' : null;?>>
                                        </div>
                                        <input type="hidden" name="id" value="<?=$product['id'];?>">
                                        <button type="submit" class="btn btn-success">Сохранить</button>
                                      </form>
                                    </td>
                                    <td>
                                      <form action="<?=ADMIN;?>/product/editsale?id=<?=$product['id'];?>" method="post" class="admqty">
                                        <div class="order-qty">
                                          <input type="checkbox" name="sale"<?=$product['sale'] ? ' checked' : null;?>>
                                        </div>
                                        <input type="hidden" name="id" value="<?=$product['id'];?>">
                                        <button type="submit" class="btn btn-success">Сохранить</button>
                                      </form>
                                    </td>
                                    <td>
                                      <form action="<?=ADMIN;?>/product/edithit?id=<?=$product['id'];?>" method="post" class="admqty">
                                        <div class="order-qty">
                                          <input type="checkbox" name="hit"<?=$product['hit'] ? ' checked' : null;?>>
                                        </div>
                                        <input type="hidden" name="id" value="<?=$product['id'];?>">
                                        <button type="submit" class="btn btn-success">Сохранить</button>
                                      </form>
                                    </td>
                                    <td><a href="<?=ADMIN;?>/product/edit?id=<?=$product['id'];?>"><i class="fa fa-fw fa-eye"></i></a> <a class="delete" href="<?=ADMIN;?>/product/delete?id=<?=$product['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?=count($products);?> товаров из <?=$count;?>)</p>
                        <?php if($pagination->countPages > 1): ?>
                            <?=$pagination;?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
