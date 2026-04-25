<?php if ((isset($_SESSION['user'])) && ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'manager-admin')): ?>
  <section class="content-header">
      <h1>
          Редактирование пользователя
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="<?=ADMIN;?>/user"> Список пользователей</a></li>
          <li class="active">Редактирование пользователя</li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          <div class="col-md-12">
              <div class="box">
                  <form action="<?=ADMIN;?>/user/edit" method="post" data-toggle="validator">
                      <div class="box-body">
                          <div class="form-group has-feedback">
                              <label for="login">Логин</label>
                              <input type="text" class="form-control" name="login" id="login" value="<?=h($user->login);?>" required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          </div>

                          <div class="form-group">
                              <label>Статус</label>
                              <select class="form-control" name="status">
                                  <option value="client"<?php if($user->status == 'client') echo ' selected'; ?>>Клиент</option>
                                  <option value="master"<?php if($user->status == 'master') echo ' selected'; ?>>Мастер</option>
                                  <option value="opt"<?php if($user->status == 'opt') echo ' selected'; ?>>Оптовик</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="password">Пароль</label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль, если хотите его изменить">
                          </div>
                          <div class="form-group has-feedback">
                              <label for="name">Имя</label>
                              <input type="text" class="form-control" name="name" id="name" value="<?=h($user->name);?>" required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          </div>

                          <div class="form-group has-feedback">
                              <label for="name">Телефон</label>
                              <input type="text" class="form-control" name="phone" id="phone" value="<?=h($user->phone);?>">
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          </div>

                          <div class="form-group has-feedback">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" name="email" id="email" value="<?=h($user->email);?>" required>
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          </div>
                          <div class="form-group">
                              <label for="address">Адрес</label>
                              <input type="text" class="form-control" name="address" id="address" value="<?=h($user->address);?>">
                              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          </div>
                          <div class="form-group">
                              <label>Роль</label>
                              <select name="role" id="role" class="form-control">
                                  <option value="admin"<?php if($user->role == 'admin') echo ' selected'; ?>>Администратор</option>
                                  <option value="manager"<?php if($user->role == 'manager') echo ' selected'; ?>>Менеджер</option>
                                  <option value="manager-admin"<?php if($user->role == 'manager-admin') echo ' selected'; ?>>Менеджер-админ</option>
                                  <option value="user"<?php if($user->role == 'user') echo ' selected'; ?>>Пользователь</option>
                              </select>
                          </div>
                      </div>
                      <div class="box-footer">
                          <input type="hidden" name="id" value="<?=$user->id;?>">
                          <button type="submit" class="btn btn-primary">Сохранить</button>
                      </div>
                  </form>
              </div>

              <h3>Заказы пользователя</h3>
              <div class="box">
                  <div class="box-body">
                      <?php if($orders): ?>
                          <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                  <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Статус</th>
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
                                    ?>
                                      <tr class="<?=$class;?>">
                                          <td><?=$order['id'];?></td>
                                          <td><?=$order['status'];?></td>
                                          <td><?=$order['sum'];?> руб</td>
                                          <?php if ($order['sum'] >= DISCOUNT): ?>
                                            <td><?=$order['sum_discount'];?> руб</td>
                                          <?php else: ?>
                                            <td>-</td>
                                          <?php endif; ?>
                                          <td><?=$order['date'];?></td>
                                          <td><?=$order['update_at'];?></td>
                                          <td><a href="<?=ADMIN;?>/order/view?id=<?=$order['id'];?>"><i class="fa fa-fw fa-eye"></i></a></td>
                                      </tr>
                                  <?php endforeach; ?>
                                  </tbody>
                              </table>
                          </div>
                      <?php else: ?>
                          <p class="text-danger">Пользователь пока ничего не заказывал...</p>
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div>

  </section>
<?php else: ?>

  <section class="content">
      <div class="row">
          <div class="col-md-12">
              <div class="box">
                      <div class="box-body">
                          <div class="form-group has-feedback">
                              <label for="login">Логин</label>
                              <p><?=h($user->login);?></p>
                          </div>

                          <div class="form-group">
                              <label>Статус</label>
                              <p><?=$user->status;?></p>
                          </div>

                          <div class="form-group has-feedback">
                            <label>Имя</label>
                            <p><?=h($user->name);?></p>
                          </div>

                          <div class="form-group has-feedback">
                              <label for="name">Телефон</label>
                              <p><?=h($user->phone);?></p>
                          </div>

                          <div class="form-group has-feedback">
                              <label for="email">Email</label>
                              <p><?=h($user->email);?></p>
                          </div>
                          <div class="form-group">
                              <label for="address">Адрес</label>
                              <p><?=h($user->address);?></p>
                          </div>
                          <div class="form-group">
                              <label>Роль</label>
                              <p><?=$user->role;?></p>
                          </div>
                      </div>
              </div>

              <h3>Заказы пользователя</h3>
              <div class="box">
                  <div class="box-body">
                      <?php if($orders): ?>
                          <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                  <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Статус</th>
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
                                    ?>
                                      <tr class="<?=$class;?>">
                                          <td><?=$order['id'];?></td>
                                          <td><?=$order['status'];?></td>
                                          <td><?=$order['sum'];?> руб</td>
                                          <?php if ($order['sum'] >= DISCOUNT): ?>
                                            <td><?=$order['sum_discount'];?> руб</td>
                                          <?php else: ?>
                                            <td>-</td>
                                          <?php endif; ?>
                                          <td><?=$order['date'];?></td>
                                          <td><?=$order['update_at'];?></td>
                                          <td><a href="<?=ADMIN;?>/order/view?id=<?=$order['id'];?>"><i class="fa fa-fw fa-eye"></i></a></td>
                                      </tr>
                                  <?php endforeach; ?>
                                  </tbody>
                              </table>
                          </div>
                      <?php else: ?>
                          <p class="text-danger">Пользователь пока ничего не заказывал...</p>
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div>

  </section>
<?php endif; ?>
