  <section class="content-header">
      <h1>
          Список пользователей
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Список пользователей</li>
      </ol>
  </section>

  <div class="search">
    <form action="<?=ADMIN;?>/searchuser" class="search-form" method="get" autocomplete="off">
      <p>
        <input type="text" class="typeahead" id="typeahead_user" name="s" placeholder="Поиск">
        <input type="submit" class="search-bg" value=" ">
      </p>
    </form>
  </div>

  <section class="content">
      <div class="row">
          <div class="col-md-12">
              <div class="box">
                  <div class="box-body">
                      <div class="table-responsive">

                        <div class="prod_state_buttons" style="display:flex; align-items:center; margin-bottom:10px;">
                          <p style="margin-right: 20px;" class="btn btn-default">Все пользователи</p>
                          <a style="margin-right: 20px;" href="<?=ADMIN;?>/user/opt" class="btn btn-primary">Оптовики</a>
                          <a style="margin-right: 20px;" href="<?=ADMIN;?>/user/master" class="btn btn-primary">Мастера</a>
                          <a style="margin-right: 20px;" href="<?=ADMIN;?>/user/client" class="btn btn-primary">Клиенты</a>
                        </div>

                          <table class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Логин</th>
                                  <th>Статус</th>
                                  <th>Email</th>
                                  <th>Телефон</th>
                                  <th>Имя</th>
                                  <th>Роль</th>
                                  <th>Действия</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php foreach($users as $user): ?>
                                      <td><?=$user->id;?></td>
                                      <td><?=$user->login;?></td>
                                      <td>
                                        <?php if ($user->status == 'master'): ?>
                                          Мастер
                                        <?php endif; ?>
                                        <?php if($user->status == 'opt') :?>
                                          Оптовик
                                        <?php endif; ?>
                                        <?php if($user->status == 'client') :?>
                                          Клиент
                                        <?php endif; ?>
                                      </td>

                                      <td><?=$user->email;?></td>
                                      <td><?=$user->phone;?></td>
                                      <td><?=$user->name;?></td>
                                      <td><?=$user->role;?></td>

                                      <td><a href="<?=ADMIN;?>/user/edit?id=<?=$user->id;?>"><i class="fa fa-fw fa-eye"></i></a>
                                        <?php if ((isset($_SESSION['user'])) && ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'manager-admin')): ?>
                                        <a class="delete" href="<?=ADMIN;?>/user/delete?id=<?=$user->id;?>"><i class="fa fa-fw fa-close text-danger"></i></a>
                                        <?php endif; ?>
                                      </td>

                                  </tr>
                              <?php endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                      <div class="text-center">
                          <p>(<?=count($users);?> пользователей из <?=$count;?>)</p>
                          <?php if($pagination->countPages > 1): ?>
                              <?=$pagination;?>
                          <?php endif; ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
