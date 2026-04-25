<?php
namespace app\models;
use ishop\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Forgot extends AppModel {

public static function forgot(){
    $email = h($_POST['reg-mail']);
    if(empty($email)){
      $_SESSION['error'] = 'Поле не может быть пустым!';
    }else{
      if($query = \R::exec("SELECT id FROM user WHERE email = '$email' LIMIT 1")){
        $expire = time() + 3600;
        $hash = md5($expire . $email);
        $last_ch = \R::exec("INSERT INTO forgot (hash, expire, email) VALUES ('$hash', $expire, '$email')");
        if($last_ch){
          $link = PATH . "/forgot/change?forgot={$hash}";
          $subject = "Запрос на восстановление пароля на сайте " . PATH;
          self::mailForgot($email, $subject, $link);
          $_SESSION['success'] = 'На Ваш e-mail выслана инструкция по восстановлению пароля';
        }else{
          $_SESSION['error'] = 'Ошибка';
        }
      }else{
        $_SESSION['error'] = 'Пользователь с таким e-mail не найден!';
      }
    }
}

public static function access_change(){
  $hash = h($_GET['forgot']);
  if(empty($hash)){
    $_SESSION['error'] = "Некорректная ссылка!";
    return;
  }
  $query = \R::findOne('forgot',  "hash = '$hash'");
  //если не найден хэш
  if(!$query){
    $_SESSION['error'] = "Ссылка устарела или некорректная ссылка!";
    return;
  }
  $now = time();
  //если ссылка устарела
  if($query['expire'] - $now < 0 ){
    $_SESSION['error'] = "Ссылка устарела!";
    return;
  }
}

//смена пароля
public static function change_pass(){
  $hash = h($_POST['hash']);
  $password = trim($_POST['new-pass']);
  if(empty($password)){
    $_SESSION['forgot'] = 'Не введён пароль!';
    return;
  }
  $query = \R::findOne('forgot',  "hash = '$hash'");
  //если не найден хэш
  if(!$query){
    return;
  }
  $now = time();
  //если ссылка устарела
  if($query['expire'] - $now < 0 ){
    \R::exec("DELETE FROM forgot WHERE expire < $now");
    return;
  }
  $password = password_hash($password, PASSWORD_DEFAULT);
  \R::exec("UPDATE user SET password = '$password' WHERE email = '{$query['email']}'");
  \R::exec("DELETE FROM forgot WHERE email = '{$query['email']}'");
  $_SESSION['success'] = 'Пароль успешно изменён!';


}

public static function mailForgot($email, $subject, $link){
    // Create the Transport
    $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
        ->setUsername(App::$app->getProperty('smtp_login'))
        ->setPassword(App::$app->getProperty('smtp_password'))
    ;

    // Create a message
    ob_start();
    require APP . '/views/mail/mail_forgot.php';
    $body = ob_get_clean();

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    $message_client = (new Swift_Message($subject))
        ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
        ->setTo($email)
        ->setBody($body, 'text/html')
    ;

    // Send the message
      $result = $mailer->send($message_client);
    $_SESSION['success'] = 'Вы успешно зарегистрированы на сайте Smesi.by! Теперь Вам доступна наша программа лояльности!';
}



}
