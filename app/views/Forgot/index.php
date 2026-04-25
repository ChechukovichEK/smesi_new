<!--start-breadcrumbs-->
<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
        <li><a href="<?= PATH ?>">Главная</a></li>
        <li>Вспомнить пароль</li>
      </ol>
    </div>
  </div>
</div>
<!--end-breadcrumbs-->

<div class="enter-wrap">
  <div id="forgot" class="enter-content">
    <form method="post" action="forgot" id="forgot-form" data-toggle="validator">
      <div class="form-group has-feedback">
        <input type="email" name="reg-mail" class="form-control" placeholder="e-mail регистрации" required>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        <div class="help-block with-errors"></div>
      </div>
      <button type="submit" name="fpass" id="forgot-diz" class="btn btn-login hover">Выслать пароль</button>
    </form>
    <a href="user/login" id="enter-link" class="hover">Вход на сайт</a>
  </div>
</div>
