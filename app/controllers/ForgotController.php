<?php

namespace app\controllers;

use app\models\Forgot;

class ForgotController extends AppController {

public function indexAction(){
  if(isset($_POST['reg-mail'])){
    Forgot::forgot();
    redirect();
  }
  elseif(isset($_GET['forgot'])){
    access_change();
  }
  $this->setMeta('Вспомнить пароль');
}

public function changeAction(){
if(isset($_GET['forgot'])){
    Forgot::access_change();
  }
  $this->setMeta('Восстановление пароля');
}

public function changepassAction(){
  if(isset($_POST['new-pass'])){
    Forgot::change_pass();
    redirect(PATH);
  }
}
}
