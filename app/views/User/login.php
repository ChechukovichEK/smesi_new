<!--start-breadcrumbs-->
<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
        <li><a href="<?= PATH ?>">Главная</a></li>
        <li>Вход</li>
      </ol>
    </div>
  </div>
</div>
<!--end-breadcrumbs-->

<div class="enter-wrap">
  <div class="enter-content">
    <div class="register-top login">
      <h2>Вход</h2>
    </div>
    <form method="post" action="user/login" id="login" role="form" data-toggle="validator">
      <div class="form-group has-feedback">
        <input type="text" name="login" class="form-control" placeholder="Логин" required>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" id="pasword" placeholder="Пароль" required>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        <div class="help-block with-errors"></div>

      </div>
      <button type="submit" class="btn btn-login hover">Войти</button>
    </form>
    <a href="forgot" id="forgot-link" class="hover">Забыли пароль?</a>
  </div>
</div>
