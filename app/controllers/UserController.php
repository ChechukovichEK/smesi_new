<?php

namespace app\controllers;

use app\models\User;
use app\models\Order;

class UserController extends AppController {

    public function signupAction(){
        if(!empty($_POST) && empty($_POST['sur'])){
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if(!$user->validate($data) || !$user->checkUnique()){
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            }else{
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                if($id = $user->save('user')){
                  if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
                    $_SESSION['success'] = 'Новый клиент успешно добавлен!';
                    redirect();
                  } else{
                    $_SESSION['success'] = "<p id='reg_success'>Регистрация прошла успешно!</p>";
                    $_SESSION['user']['id'] = $id;
                    $_SESSION['user']['name'] = $data['name'];
                    $user_name = $data['name'];
                    $_SESSION['user']['login'] = $data['login'];
                    $_SESSION['user']['email'] = $data['email'];
                    $user_email = $data['email'];
                    $_SESSION['user']['address'] = $data['address'];
                    $_SESSION['user']['phone'] = $data['phone'];
                    $_SESSION['user']['status'] = 'client';
                    $_SESSION['user']['role'] = 'user';
                    $user_login = $data['login'];
                    if(isset($_SESSION['cart'])){
                      foreach($_SESSION['cart'] as $prod_id => $item){
                        $qty = $item['qty'];
                        \R::exec("INSERT INTO cart (user_id, product_id, qty) VALUES ($id, $prod_id, $qty)");
                      }
                    }
                    Order::signupRegistration($user_email, $user_name, $user_login);
                    redirect(PATH);
                  }
                }
                else{
                    $_SESSION['error'] = 'Ошибка!';
                }

            }
            redirect();
        }
        $this->setMeta('Регистрация');
    }

    public function loginAction(){
        if(!empty($_POST)){
            $user = new User();
            if($user->login()){
                $_SESSION['success'] = 'Вы успешно авторизованы';
                $id = $_SESSION['user']['id'];
                if(isset($_SESSION['cart'])){
                  foreach($_SESSION['cart'] as $prod_id => $item){
                    $qty = $item['qty'];
                    \R::exec("INSERT INTO cart (user_id, product_id, qty) VALUES ($id, $prod_id, $qty)");
                  }
                }
                redirect(PATH);
            }else{
                $_SESSION['error'] = 'Логин/пароль введены неверно';
            }
            redirect();
        }
        $this->setMeta('Вход');
    }

    public function logoutAction(){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect(PATH);
    }

    public function cabinetAction(){
      if(!User::checkAuth()){
        redirect();
      }
      $this->setMeta('Личный кабинет');
    }

    public function editAction(){
      if(!User::checkAuth()){
        redirect('/user/login');
      }
      if(!empty($_POST)){
        $user = new \app\models\admin\User();
        $data = $_POST;
        $data['id'] = $_SESSION['user']['id'];
        $data['role'] = $_SESSION['user']['role'];
        $data['status'] = $_SESSION['user']['status'];
        $user->load($data);
        if(!$user->attributes['password']){
            unset($user->attributes['password']);
        }else{
            $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
        }
        if(!$user->validate($data) || !$user->checkUnique()){
            $user->getErrors();
            redirect();
        }
        if($user->update('user', $_SESSION['user']['id'])){
          foreach($user->attributes as $k => $v){
              if($k != 'password') $_SESSION['user'][$k] = $v;
          }
          $_SESSION['success'] = 'изменения сохранены';
        }
        redirect();
      }
      $this->setMeta('Редактирование личных данных');
    }

    public function ordersAction(){
      if(!User::checkAuth()){
        redirect('/user/login');
      }
      $us = $_SESSION['user']['id'];
      $orders = \R::getAll("SELECT `order`.* FROM `order`
JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
WHERE user_id = {$us} GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id`");
      //$orders = \R::findAll('order', 'user_id = ?', [$_SESSION['user']['id']]);
      $this->setMeta('История заказов');
      $this->set(compact('orders'));
    }

    public function deleteAction(){
        $user_id = $this->getRequestID();
        $user = \R::load('user', $user_id);
        \R::trash($user);
        $_SESSION['success'] = 'Пользователь удален';
        redirect(ADMIN . '/user');
    }

}
