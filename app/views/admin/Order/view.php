<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Заказ №<?=$order['id'];?>
        <?php if($order['status'] == 'новый'):?>
            <a href="<?=ADMIN;?>/order/change?id=<?=$order['id'];?>&status=process" class="btn btn-primary btn-xs">В работу</a>
        <?php endif; ?>
        <?php if($order['status'] == 'в процессе'):?>
            <a href="<?=ADMIN;?>/order/change?id=<?=$order['id'];?>&status=new" class="btn btn-primary btn-xs">В работе</a>
        <?php endif; ?>
        <?php if(($order['status'] == 'в процессе') || ($order['status'] == 'новый')):?>
            <a href="<?=ADMIN;?>/order/change?id=<?=$order['id'];?>&status=shiped" class="btn btn-warning btn-xs">Отгрузить</a>
        <?php endif; ?>
        <?php if(($order['status'] == 'отгружен')):?>
            <a href="<?=ADMIN;?>/order/change?id=<?=$order['id'];?>&status=process" class="btn btn-warning btn-xs">Отгружен</a>
        <?php endif; ?>

        <?php if(($order['status'] == 'отгружен')||($order['status'] == 'в процессе')|| ($order['status'] == 'новый')): ?>
            <a href="<?=ADMIN;?>/order/change?id=<?=$order['id'];?>&status=end" class="btn btn-success btn-xs">Завершить</a>
        <?php else: ?>
            <a href="<?=ADMIN;?>/order/change?id=<?=$order['id'];?>&status=process" class="btn btn-default btn-xs">Вернуть на доработку</a>
        <?php endif; ?>

        <a href="<?=ADMIN;?>/order/delete?id=<?=$order['id'];?>" class="btn btn-danger btn-xs delete">Удалить</a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/order">Список заказов</a></li>
        <li class="active">Заказ №<?=$order['id'];?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
              <form action="<?=ADMIN;?>/order/edit" method="post">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>Менеджер</td>
                                    <td>
                                      <select class="" name="manager">
                                        <option value=""> Менеджер не назначен</option>
                                        <?php foreach ($admins as $admin): ?>
                                          <option value="<?=$admin->name?>"<?php if($order['manager'] == $_SESSION['user']['name'])
                                          {echo ' selected';}?>
                                          > <?=$admin->name?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Номер заказа</td>
                                    <td><?=$order['id'];?></td>
                                </tr>
                                <tr>
                                    <td>Дата заказа</td>
                                    <td><?=$order['date'];?></td>
                                </tr>
                                <tr>
                                    <td>Дата изменения статуса</td>
                                    <td><?=$order['update_at'];?></td>
                                </tr>
                                <tr>
                                    <td>Кол-во позиций в заказе</td>
                                    <td><?=count($order_products);?></td>
                                </tr>
                                <tr>
                                    <td>Сумма заказа</td>
                                    <td><?=$order['sum'];?> руб</td>
                                </tr>
                                <?php if ($order['user_status'] == 'client'): ?>
                                  <?php if ($order['sum'] >= DISCOUNT): ?>
                                    <tr>
                                        <td>Сумма co скидкой</td>
                                        <td><?=$order['sum_discount'];?> руб (от 500 руб)</td>
                                    </tr>
                                  <?php else: ?>
                                    <tr>
                                        <td>Сумма co скидкой</td>
                                        <td>-</td>
                                    </tr>
                                  <?php endif; ?>
                                <?php endif; ?>

                                <?php if ($order['user_status'] == 'master'): ?>
                                    <tr>
                                        <td>Сумма co скидкой</td>
                                        <td><?=$order['sum_master'];?> руб (мастер)</td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($order['user_status'] == 'opt'): ?>
                                    <tr>
                                        <td>Сумма co скидкой</td>
                                        <td><?=$order['sum_opt'];?> руб (опт)</td>
                                    </tr>
                                <?php endif; ?>

                                <tr>
                                    <td>Имя заказчика</td>
                                    <td><div class="form-group has-feedback">
                                        <input type="text" name="name" class="form-control" placeholder="Имя заказчика" value="<?=h($order['name']);?>">
                                        <?php if($order['user_id']): ?>
                                          <?php if($order['user_status'] == 'client'): ?>
                                            (клиент)
                                          <?php endif; ?>
                                          <?php if($order['user_status'] == 'master'): ?>
                                            (мастер)
                                          <?php endif; ?>
                                          <?php if($order['user_status'] == 'opt'): ?>
                                            (оптовик)
                                          <?php endif; ?>
                                        <?php else: ?>
                                          (н/з)
                                        <?php endif; ?>
                                    </div>
                                </tr>
                                <tr>
                                    <td>E-mail</td>
                                    <td>
                                      <div class="form-group has-feedback">
                                        <input type="text" name="email" class="form-control" placeholder="E-mail" value="<?php if(isset($user) && empty($order['email'])){
                                          echo h($user->email);
                                        } else{
                                          echo h($order['email']);
                                        } ?>">
                                      </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Телефон</td>
                                    <td>
                                      <div class="form-group has-feedback">
                                      <input type="text" name="phone" class="form-control" placeholder="Телефон" value="<?php if(isset($user) && empty($order['phone'])){
                                        echo h($user->phone);
                                      } else{
                                        echo h($order['phone']);
                                      } ?>">
                                    </div>
                                </tr>
                                <tr>
                                    <td>Адрес</td>
                                    <td>
                                      <div class="form-group has-feedback">
                                      <input type="text" name="address" class="form-control" placeholder="Адрес" value="<?php if(isset($user) && empty($order['address'])){
                                        echo h($user->address);
                                      } else{
                                        echo h($order['address']);
                                      } ?>">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                    <td>Самовывоз</td>
                                    <td>
                                      <div class="form-group">
                                          <label>
                                              <input type="checkbox" name="samovivoz"<?=$order['samovivoz'] ? ' checked' : null;?>> Самовывоз
                                          </label>
                                      </div>
                                  </td>
                                </tr>

                                <tr>
                                    <td>Способ оплаты</td>
                                    <td>
                                      <div class="form-group">
                                        <p><?=$order['pay']?></p>
                                        <label><input class="cash-pay" type="radio" name="pay" value="Наличные" <?=$order['pay'] == 'Наличные' ? ' checked' : null;?>> Наличные</label>
                                        <label><input class="card-pay" type="radio" name="pay" value="Оплата картой" <?=$order['pay'] == 'Оплата картой' ? ' checked' : null;?>> Оплата картой</label>
                                        <label><input class="virt" type="radio" name="pay" value="Безналичный расчёт" <?=$order['pay'] == 'Безналичный расчёт' ? ' checked' : null;?>> Безналичный расчёт</label>
                                      </div>
                                  </td>
                                </tr>

                                <tr>
                                    <td>Статус</td>
                                    <td><?=$order['status'];?></td>
                                </tr>
                                <tr>
                                    <td>Комментарий</td>
                                    <td>
                                      <div class="form-group">
                                          <label>
                                              <textarea name="note"> <?=h($order['note']);?> </textarea>
                                          </label>
                                      </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="box-footer">
                    <input type="hidden" name="id" value="<?=$order['id'];?>">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
              </form>
            </div>

            <h3>Состав заказа</h3>
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Кол-во</th>
                                <?php if ($order['user_status'] == 'client'): ?>
                                  <?php if ($order_sum >= DISCOUNT): ?>
                                    <th>Обычная цена</th>
                                    <th>Сумма</th>
                                    <th>Цена со скидкой</th>
                                    <th>Сумма со скидкой</th>
                                  <?php else: ?>
                                    <th>Цена</th>
                                    <th>Сумма</th>
                                  <?php endif; ?>
                                <?php endif; ?>

                                <?php if ($order['user_status'] == 'master'): ?>
                                  <th>Обычная цена</th>
                                  <th>Сумма</th>
                                  <th>Цена мастер</th>
                                  <th>Сумма мастер</th>
                                <?php endif; ?>

                                <?php if ($order['user_status'] == 'opt'): ?>
                                  <th>Обычная цена</th>
                                  <th>Сумма</th>
                                  <th>Цена опт</th>
                                  <th>Сумма опт</th>
                                <?php endif; ?>
                                <th>Скидка (%)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $qty = 0; foreach($order_products as $product): ?>
                                <tr>
                                    <td><?=$product->id;?></td>
                                    <td><a href="<?=PATH?>/product/<?=$product->alias;?>"><?=$product->title;?></td>
                                    <td>
                                      <form action="<?=ADMIN;?>/order/addqty?id=<?=$product->id;?>" method="post" class="admqty">
                                        <div class="order-qty">
                                          <input type="number" name="quantity" value="<?=$product->qty;?>" size="4" min="1" step="1">
                                        </div>
                                          <input type="hidden" name="id" value="<?=$product->id;?>">
                                          <button type="submit" class="btn btn-success">Сохранить</button>
                                      </form>
                                    </td>

                                    <?php if ($order['user_status'] == 'client'): ?>
                                      <?php if ($order_sum >= DISCOUNT): ?>
                                        <td><?=$product->price;?> руб.</td>
                                        <td><?=$product->price * $product->qty;?> руб.</td>
                                          <?php if ($product->price_dis != 0): ?>
                                            <td><?=$product->price_dis;?> руб.</td>
                                            <td><?=$product->price_dis * $product->qty;?> руб.</td>
                                          <?php else: ?>
                                            <td><?=$product->price;?> руб.</td>
                                            <td><?=$product->price * $product->qty;?> руб.</td>
                                          <?php endif; ?>
                                      <?php else: ?>
                                        <td><?=$product->price;?> руб.</td>
                                        <td><?=$product->price * $product->qty;?> руб.</td>
                                      <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($order['user_status'] == 'master'): ?>
                                        <td><?=$product->price;?> руб.</td>
                                        <td><?=$product->price * $product->qty;?> руб.</td>
                                          <?php if ($product->price_master != 0): ?>
                                            <td><?=$product->price_master;?> руб.</td>
                                            <td><?=$product->price_master * $product->qty;?> руб.</td>
                                          <?php else: ?>
                                            <td><?=$product->price;?> руб.</td>
                                            <td><?=$product->price * $product->qty;?> руб.</td>
                                          <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($order['user_status'] == 'opt'): ?>
                                        <td><?=$product->price;?> руб.</td>
                                        <td><?=$product->price * $product->qty;?> руб.</td>
                                          <?php if ($product->price_opt != 0): ?>
                                            <td><?=$product->price_opt;?> руб.</td>
                                            <td><?=$product->price_opt * $product->qty;?> руб.</td>
                                          <?php else: ?>
                                            <td><?=$product->price;?> руб.</td>
                                            <td><?=$product->price * $product->qty;?> руб.</td>
                                          <?php endif; ?>
                                    <?php endif; ?>

                                    <td><?=$product->discount;?></td>
                                    <td><a class="delete" href="<?=ADMIN;?>/order/delete-prod?id=<?=$product->id;?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                                <tr class="active">
                                    <td colspan="2">
                                        <b>Итого:</b>
                                    </td>
                                    <td><b><?=$order_qty;?></b></td>
                                    <td><b></b></td>
                                    <td><b><?=$order_sum;?> руб.</b></td>
                                    <?php if ($order['user_status'] == 'client'): ?>
                                      <?php if ($order_sum >= DISCOUNT): ?>
                                        <td><b></b></td>
                                        <td><b><?=$order_sum_dis;?> руб.</b></td>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($order['user_status'] == 'master'): ?>
                                      <td><b></b></td>
                                      <td><b><?=$order_sum_master;?> руб.</b></td>
                                    <?php endif; ?>
                                    <?php if ($order['user_status'] == 'opt'): ?>
                                      <td><b></b></td>
                                      <td><b><?=$order_sum_opt;?> руб.</b></td>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="<?=ADMIN;?>/order/product-add?id=<?=$order['id'];?>" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Добавить продукт</a>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
