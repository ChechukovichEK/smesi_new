<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
          <li><a href="<?= PATH ?>">Главная</a></li>
          <li><a href="<?= PATH ?>/user/cabinet">Личный кабинет</a></li>
          <li>Редактирование личных данных</li>
      </ol>
    </div>
  </div>
</div>
<!--end-breadcrumbs-->

<div class="enter-wrap">
  <div class="enter-content" id="cabinet">
    <div class="box" id="edit-cab">
        <form action="user/edit" method="post" data-toggle="validator">
            <div class="box-body">
                <div class="form-group has-feedback">
                    <label for="login">Логин</label>
                    <input type="text" class="form-control" name="login" value="<?=h($_SESSION['user']['login']);?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль, если хотите его изменить">
                </div>
                <div class="form-group has-feedback">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?=h(($_SESSION['user']['name']));?>" required>
                </div>
                <div class="form-group has-feedback">
                    <label for="name">Телефон</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="<?=h(($_SESSION['user']['phone']));?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?=h(($_SESSION['user']['email']));?>">
                </div>
                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?=h(($_SESSION['user']['address']));?>">
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn hover">Сохранить</button>
            </div>
        </form>
    </div>
  </div>
</div>
