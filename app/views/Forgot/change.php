<?php if (!isset($_SESSION['error'])): ?>
<!--start-breadcrumbs-->
<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
        <li><a href="<?= PATH ?>">Главная</a></li>
        <li>Восстановление пароля</li>
      </ol>
    </div>
  </div>
</div>
<!--end-breadcrumbs-->
 <?php if (isset($_SESSION['forgot'])): ?>
   <div class="sessions">
     <div class="sessions-content">
       <div class="ses-item">
           <div class="alert alert-danger" id="error">
             <?php echo $_SESSION['forgot']; unset($_SESSION['forgot']); ?>
           </div>
       </div>
     </div>
   </div>
 <?php endif; ?>
  <div class="enter-wrap">
    <div id="forgot" class="enter-content">
      <form method="post" action="forgot/changepass" data-toggle="validator">
        <div class="form-group has-feedback">
          <input type="text" name="new-pass" class="form-control" placeholder="новый пароль" required>
          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
          <div class="help-block with-errors"></div>
        </div>
        <input type="hidden" name="hash" value="<?=$_GET['forgot']?>">
        <button type="submit" class="btn btn-login hover">Сменить пароль</button>
      </form>
      <a href="user/login" id="enter-link" class="hover">Вход на сайт</a>
    </div>
  </div>

<?php endif; ?>
