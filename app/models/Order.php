<?php

namespace app\models;

use ishop\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Order extends AppModel {

  public $attributes = [
      'name' => '',
      'manager' => '',
      'email' => '',
      'phone' => '',
      'address' => '',
      'samovivoz' => '',
      'pay' => '',
      'note' => '',
];

    public static function saveOrder($data){
        $order = \R::dispense('order');
        $order->user_id = $data['user_id'];
        if(isset($data['user_status'])){
          $order->user_status = $data['user_status'];
        } else {
          $order->user_status = 'client';
        }
        $order->phone = $data['phone'];
        $order->name= $data['name'];
        $order->address = $data['address'];
        $order->note = $data['note'];
        $order->samovivoz = $data['samovivoz'];
        $order->pay = $data['pay'];
        $order_id = \R::store($order);
        self::saveOrderProduct($order_id);
        $p = \R::load('order', $order_id);
        $p->sum = self::getSum($order_id);
        $p->sum_discount = self::getSumDis($order_id);
        $p->sum_master = self::getSumMaster($order_id);
        $p->sum_opt = self::getSumOpt($order_id);
        \R::store($p);
        return $order_id;
    }

    public static function getOrderProduct($order_id){
      $order_products = \R::findAll('order_product', 'order_id = ?', [$order_id]);
      return $order_products;
    }

    public static function getQty($order_id){
      $order_products = self::getOrderProduct($order_id);
      $order_qty = 0;
      foreach($order_products as $item){
        $order_qty += $item['qty'];
    }
    return $order_qty;
  }

    public static function getSum($order_id){
      $order_products = self::getOrderProduct($order_id);
      $order_sum = 0;
      foreach($order_products as $item){
        $prod_sum = $item['qty'] * $item['price'];
        $order_sum += $prod_sum;
    }
    return $order_sum;
    }

    public static function getSumDis($order_id){
      $order_products = self::getOrderProduct($order_id);
      $order_sum_dis = 0;
      foreach($order_products as $item){
        if($item['price_dis'] != 0){
          $prod_sum_dis = $item['qty'] * $item['price_dis'];
        } else{
          $prod_sum_dis = $item['qty'] * $item['price'];
        }
        $order_sum_dis += $prod_sum_dis;
    }
    return $order_sum_dis;
    }

    public static function getSumMaster($order_id){
      $order_products = self::getOrderProduct($order_id);
      $order_sum_master = 0;
      foreach($order_products as $item){
        if($item['price_master'] != 0){
          $prod_sum_master = $item['qty'] * $item['price_master'];
        } else{
          $prod_sum_master = $item['qty'] * $item['price'];
        }
        $order_sum_master += $prod_sum_master;
    }
    return $order_sum_master;
    }

    public static function getSumOpt($order_id){
      $order_products = self::getOrderProduct($order_id);
      $order_sum_opt = 0;
      foreach($order_products as $item){
        if($item['price_opt'] != 0){
          $prod_sum_opt = $item['qty'] * $item['price_opt'];
        } else{
          $prod_sum_opt = $item['qty'] * $item['price'];
        }
        $order_sum_opt += $prod_sum_opt;
    }
    return $order_sum_opt;
    }


    public static function saveOrderProduct($order_id){
        $sql_part = '';
        if(!isset($_SESSION['user'])){
          if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
          foreach($_SESSION['cart'] as $product_id => $product){
              $product_id = (int)$product_id;
              $sql_part .= "($order_id, $product_id, {$product['qty']}, '{$product['title']}', {$product['price']}, {$product['price_dis']}, {$product['price_master']}, {$product['price_opt']}, '{$product['articul']}', '{$product['alias']}',
               {$product['discount']}, '{$product['units']}'),";
          }
          $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO order_product (order_id, product_id, qty, title, price, price_dis, price_master, price_opt, articul, alias, discount, units) VALUES $sql_part");
        }
      }
      if(!empty($_SESSION['user'])){
        $user_id = $_SESSION['user']['id'];
        $user_cart = \R::findAll('cart', 'user_id = ?', [$user_id]);
        foreach($user_cart as $cart_item){
          $product_id = $cart_item->product_id;
          $cart_product = \R::findOne('product', 'id = ?', [$product_id]);
          if(($cart_product->is_have == '0') || ($cart_product->is_have == '-')) { // пропуск отсутствующих позиций
        continue;
        }
          $order_alias = $cart_product->alias;
          $order_articul = $cart_product->articul;
          $order_title = $cart_product->title;
          $order_discount = $cart_product->discount;
          $order_price_dis = $cart_product->price_dis;
          $order_price_master = $cart_product->price_master;
          $order_price_opt = $cart_product->price_opt;
          $units = $cart_product->units;
          if(!($cart_product->discount)){
            $order_price = $cart_product->price;
          } else{
            $order_price = round(($cart_product->price)*((100 - $cart_product->discount)/100), 2);
          }
          $qty = $cart_item->qty;
          \R::exec("INSERT INTO order_product (order_id, product_id, qty, title, price, price_dis, price_master, price_opt, articul, alias, discount, units) VALUES ($order_id, $product_id, $qty, '$order_title', $order_price, $order_price_dis, $order_price_master, $order_price_opt, '$order_articul', '$order_alias', $order_discount, '$units')");
        }
      }
    }

    public static function mailOrder($order_id, $user_email, $user_name, $user_status, $user_phone, $user_address, $note, $order_products, $order_qty, $order_sum, $samovivoz, $pay, $order_sum_dis, $order_sum_master, $order_sum_opt){
        // Create the Transport

        $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
            ->setUsername(App::$app->getProperty('smtp_login'))
            ->setPassword(App::$app->getProperty('smtp_password'))
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        ob_start();
        require APP . '/views/mail/mail_order.php';
        $body = ob_get_clean();

        if(!empty($user_email)){
        $message_client = (new Swift_Message("Заказ №{$order_id} оформлен на сайте " . App::$app->getProperty('shop_name')))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo($user_email)
            ->setBody($body, 'text/html');
        }

        $message_admin = (new Swift_Message("Сделан заказ №{$order_id}, {$user_name},  {$user_status}, {$user_phone}"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo(['vershina_stroi@mail.ru'])
            ->setBody($body, 'text/html')
        ;

        // Send the message
        if(isset($message_client)){
		  $result = $mailer->send($message_client);
        }

        $result = $mailer->send($message_admin);
        $_SESSION['success'] = "<p id='order_success'>Спасибо за Ваш заказ. В ближайшее время с Вами свяжется менеджер для согласования заказа</p>";
    }

    public static function mailBill($order_id, $user_email, $user_name, $user_status, $user_phone, $user_address, $note, $order_products, $order_qty, $order_sum, $samovivoz, $pay){
        // Create the Transport
        $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
            ->setUsername(App::$app->getProperty('smtp_login'))
            ->setPassword(App::$app->getProperty('smtp_password'))
        ;
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        ob_start();
        require APP . '/views/mail/mail_bill.php';
        $body = ob_get_clean();

        $message_admin = (new Swift_Message("Сделан заказ №{$order_id}, {$user_name},  {$user_status}, {$user_phone}"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo(['bill.smesi.by@yandex.ru', 'vershina_stroi@mail.ru'])
            ->setBody($body, 'text/html')
        ;

        // Send the message
        $result = $mailer->send($message_admin, $errors);

        $_SESSION['success'] = "<p id='order_success'>Спасибо за Ваш заказ. В ближайшее время с Вами свяжется менеджер для согласования заказа</p>";
    }

    public static function mailRegistration($user_email, $user_name, $user_login, $pass){
        // Create the Transport
        $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
            ->setUsername(App::$app->getProperty('smtp_login'))
            ->setPassword(App::$app->getProperty('smtp_password'))
        ;
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        ob_start();
        require APP . '/views/mail/mail_reg.php';
        $body = ob_get_clean();

        if(!empty($user_email)){
        $message_client = (new Swift_Message("Здравствуйте {$user_name}! Мы создали для Вас личный кабинет на сайте Smesi.by"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo($user_email)
            ->setBody($body, 'text/html')
        ;
        }

        $message_admin = (new Swift_Message("Добавлен новый пользователь - {$user_name}, логин - {$user_login}"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo(['vershina_stroi@mail.ru'])
            ->setBody($body, 'text/html')
        ;

        // Send the message
        if(isset($message_client)){
          $result = $mailer->send($message_client);
        }
        $result = $mailer->send($message_admin);
        $_SESSION['success'] = "<p id='reg_success'>Вы успешно зарегистрированы на сайте Smesi.by! Теперь Вам доступна наша программа лояльности!</p>";
    }

    public static function signupRegistration($user_email, $user_name, $user_login){
        // Create the Transport
        $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
            ->setUsername(App::$app->getProperty('smtp_login'))
            ->setPassword(App::$app->getProperty('smtp_password'))
        ;
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        ob_start();
        require APP . '/views/mail/signup_reg.php';
        $body = ob_get_clean();

        if(!empty($user_email)){
        $message_client = (new Swift_Message("Здравствуйте {$user_name}! Мы создали для Вас личный кабинет на сайте Smesi.by"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo($user_email)
            ->setBody($body, 'text/html')
        ;
        }

        $message_admin = (new Swift_Message("Добавлен новый пользователь - {$user_name}, логин - {$user_login}"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo(['vershina_stroi@mail.ru'])
            ->setBody($body, 'text/html')
        ;

        // Send the message
        if(isset($message_client)){
          $result = $mailer->send($message_client);
        }
        $result = $mailer->send($message_admin);
        $_SESSION['success'] = "<p id='reg_success'>Вы успешно зарегистрированы на сайте Smesi.by! Теперь Вам доступна наша программа лояльности!</p>";
    }

}
