<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список заказов
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список заказов</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Менеджер</th>
                                    <th>Покупатель</th>
                                    <th>Статус заказа</th>
                                    <th>Сумма</th>
                                    <th>Сумма со скидкой</th>
                                    <th>Дата создания</th>
                                    <th>Дата изменения</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($orders as $order): ?>
                                <?php
                                if($order['status'] == 'новый'){
                                  $class = '';
                                }
                                if($order['status'] == 'в процессе'){
                                  $class = 'info';
                                }
                                if($order['status'] == 'завершен'){
                                  $class = 'success';
                                }
                                if($order['status'] == 'отгружен'){
                                  $class = 'bg-yellow';
                                }
                                ?>
                                <tr class="<?=$class;?>">
                                    <td><?=$order['id'];?></td>
                                    <td><?php if (!empty($order['manager'])): ?>
                                      <?=$order['manager'];?>
                                    <?php else: ?>
                                      менеджер не назначен
                                    <?php endif; ?></td>

                                    <?php if($order['user_id']): ?>
                                      <td><a href="<?=ADMIN;?>/user/edit?id=<?=$order['user_id'];?>"><?=$order['name'];?>
                                        <?php if($order['user_status'] == 'client'): ?>
                                          (клиент)
                                        <?php endif; ?>
                                        <?php if($order['user_status'] == 'master'): ?>
                                          (мастер)
                                        <?php endif; ?>
                                        <?php if($order['user_status'] == 'opt'): ?>
                                          (оптовик)
                                        <?php endif; ?>
                                      </a>
                                      </td>
                                    <?php else: ?>
                                      <td><?=$order['name'];?>(н/з)
                                    <?php endif; ?>


                                    <td><?=$order['status'];?></td>
                                    <td><?=$order['sum'];?> руб</td>

                                    <?php if ($order['user_status'] == 'client'): ?>
                                      <?php if ($order['sum'] >= DISCOUNT): ?>
                                        <td><?=$order['sum_discount'];?> руб (от <?=DISCOUNT?> руб)</td>
                                      <?php else:?>
                                        <td>-</td>
                                      <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($order['user_status'] == 'master'): ?>
                                        <td><?=$order['sum_master'];?> руб (мастер)</td>
                                    <?php endif; ?>

                                    <?php if ($order['user_status'] == 'opt'): ?>
                                        <td><?=$order['sum_opt'];?> руб (опт)</td>
                                    <?php endif; ?>

                                    <td><?=$order['date'];?></td>
                                    <td><?=$order['update_at'];?></td>
                                    <td><a href="<?=ADMIN;?>/order/view?id=<?=$order['id'];?>"><i class="fa fa-fw fa-eye"></i></a>
                                    <a class="delete" href="<?=ADMIN;?>/order/delete?id=<?=$order['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
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
