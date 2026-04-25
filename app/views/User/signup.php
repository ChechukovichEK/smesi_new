<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
        <li><a href="<?= PATH ?>">Главная</a></li>
        <li>Регистрация</li>
      </ol>
    </div>
  </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="enter-wrap">
  <div class="enter-content">
    <div class="register-top">
      <h2>Регистрация</h2>
    </div>

    <form method="post" action="user/signup" id="signup" role="form" data-toggle="validator" onsubmit="ym(98576053,'reachGoal','registration');gtag('event', 'registration'); return true;">
      <div class="form-group has-feedback">
        <input type="text" name="login" class="form-control" placeholder="Логин" value="<?=isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : '';?>" required>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" id="pasword" placeholder="Пароль" data-error="Пароль должен включать не менее 6 символов" data-minlength="6" value="<?=isset($_SESSION['form_data']['password']) ? h($_SESSION['form_data']['password']) : '';?>" required>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
          <input type="text" name="name" class="form-control" id="name" placeholder="Имя" value="<?=isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) : '';?>" required>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
          <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?=isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : '';?>" required>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
          <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
          <input type="text" name="address" class="form-control" id="address" placeholder="Адрес" value="<?=isset($_SESSION['form_data']['address']) ? h($_SESSION['form_data']['address']) : '';?>">
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
      <div class="form-group has-feedback">
          <input type="text" name="phone" class="form-control" id="phone" placeholder="Телефон" value="<?=isset($_SESSION['form_data']['phone']) ? h($_SESSION['form_data']['phone']) : '';?>" required>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
          <div class="help-block with-errors"></div>
      </div>
      <div class="sur">
          <input type="text" name="sur" class="form-control" placeholder="фамилия">
      </div>
      <button type="submit" class="btn btn-login">Зарегистрироваться</button>
    </form>
    <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
  </div>
</div>

<!--product-end-->
