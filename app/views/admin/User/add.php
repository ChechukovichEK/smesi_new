<?php if ((isset($_SESSION['user'])) && ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'manager-admin')): ?>
  <section class="content-header">
      <h1>
          Новый пользователь
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="<?= ADMIN ?>/user"> Список пользователей</a></li>
          <li class="active">Новый пользователь</li>
      </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <form method="post" action="<?= PATH ?>/user/signup" role="form" data-toggle="validator">
                    <div class="box-body">
                      <div class="form-group has-feedback">
                        <label for="login">Логин</label>
                        <input class="form-control" name="login" id="login" type="text" value="<?= isset($_SESSION['form_data']['login']) ? $_SESSION['form_data']['login'] : '' ?>" required>
                      </div>

                      <div class="form-group">
                        <label>Статус</label>
                        <select class="form-control" name="status">
                          <option value="client">Клиент</option>
                          <option value="master">Мастер</option>
                          <option value="opt">Оптовик</option>
                        </select>
                      </div>

                      <div class="form-group has-feedback">
                        <label for="password">Password</label>
                        <input class="form-control" name="password" id="password" type="password" data-minlength="6" data-error="Пароль должен включать не менее 6 символов" required>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group has-feedback">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" id="email" type="email" value="<?= isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '' ?>">
                      </div>
                      <div class="form-group has-feedback">
                        <label for="name">Имя</label>
                        <input class="form-control" name="name" id="name" type="text" value="<?= isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : '' ?>"  required>
                      </div>
                      <div class="form-group has-feedback">
                        <label for="address">Телефон</label>
                        <input class="form-control" name="phone" value="<?= isset($_SESSION['form_data']['phone']) ? $_SESSION['form_data']['phone'] : '' ?>">
                      </div>
                      <div class="form-group has-feedback">
                        <label for="address">Адрес</label>
                        <input class="form-control" name="address" id="address" value="<?= isset($_SESSION['form_data']['address']) ? $_SESSION['form_data']['address'] : '' ?>">
                      </div>
                    <div class="form-group">
                      <label>Роль</label>
                      <select class="form-control" name="role">
                        <option value="user">Пользователь</option>
                        <option value="admin">Администратор</option>
                      </select>
                    </div>
                  </div>
                      <!-- /.box-body -->

                      <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Добавить</button>
                      </div>
                  </form>
                  <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
              </div>
          </div>
      </div>
  </section>

<?php else: ?>
  <section class="content-header">
      <h1>
          У Вас нет доступа в данный раздел
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
      </ol>
  </section>
<?php endif; ?>
