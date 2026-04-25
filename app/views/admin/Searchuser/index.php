
<!-- Content Header (Page header) -->
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
                                    <td><?=$user['id'];?></td>
                                    <td><?=$user['login'];?></td>
                                    <td>
                                      <?php if ($user['status'] == 'master'): ?>
                                        Мастер
                                      <?php endif; ?>
                                      <?php if($user['status'] == 'opt') :?>
                                        Оптовик
                                      <?php endif; ?>
                                      <?php if($user['status'] == 'client') :?>
                                        Клиент
                                      <?php endif; ?>
                                    </td>

                                    <td><?=$user['email'];?></td>
                                    <td><?=$user['phone'];?></td>
                                    <td><?=$user['name'];?></td>
                                    <td><?=$user['role'];?></td>
                                    <td><a href="<?=ADMIN;?>/user/edit?id=<?=$user['id'];?>"><i class="fa fa-fw fa-eye"></i></a>
                                      <a class="delete" href="<?=ADMIN;?>/user/delete?id=<?=$user['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a>
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
