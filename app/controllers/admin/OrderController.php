<?php

namespace app\controllers\admin;

use app\models\Order;
use ishop\libs\Pagination;

class OrderController extends AppController {

    public function indexAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 20;
        $count = \R::count('order');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.* FROM `order`
          JOIN `order_product` ON `order`.`id` = `order_product`.`order_id` GROUP BY `order`.`id` ORDER BY `order`.`date` DESC LIMIT $start, $perpage");

        $this->setMeta('Список заказов');
        $this->set(compact('orders', 'pagination', 'count'));
    }

    public function viewAction(){
        $order_id = $this->getRequestID();
        $order = \R::getRow("SELECT `order`.* FROM `order`
  JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
  WHERE `order`.`id` = ?
  GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT 1", [$order_id]);
        if(!$order){
            throw new \Exception('Страница не найдена', 404);
        }
        if(!empty($order['user_id'])){
          $user = \R::findOne('user', "id = ?", [$order['user_id']]);
        }
        $order_products = \R::findAll('order_product', "order_id = ?", [$order_id]);
        $admins = \R::findAll('user', "role = 'admin'");
        $order_sum = Order::getSum($order_id);
        $order_sum_dis = Order::getSumDis($order_id);
        $order_sum_master = Order::getSumMaster($order_id);
        $order_sum_opt = Order::getSumOpt($order_id);
        $order_qty = Order::getQty($order_id);
        $this->setMeta("Заказ №{$order_id}");
        $this->set(compact('order', 'order_products', 'user', 'order_sum', 'order_qty', 'admins', 'order_sum_dis', 'order_sum_master', 'order_sum_opt'));
    }

    public function changeAction(){
        $order_id = $this->getRequestID();
        if(!empty($_GET['status'])){
          if($_GET['status'] == 'end'){
          $status = 'завершен';
          }
          if($_GET['status'] == 'process'){
          $status = 'в процессе';
          }
          if($_GET['status'] == 'shiped'){
          $status = 'отгружен';
          }
          if($_GET['status'] == 'new'){
          $status = 'новый';
          }

        }
        $order = \R::load('order', $order_id);
        if(!$order){
            throw new \Exception('Страница не найдена', 404);
        }
        $order->status = $status;
        $order->update_at = date("Y-m-d H:i:s");
        \R::store($order);
        $_SESSION['success'] = 'Изменения сохранены';
        redirect();
    }

    public function productAddAction(){
      $id = $this->getRequestID();
      if(!empty($_POST)){
        $prod_id = h($_POST['product_id']);
        $qty = h($_POST['qty']);
        $product = \R::findOne('product', 'id = ?', [$prod_id]);
        $articul = $product->articul;
        $title = $product->title;
        $alias = $product->alias;
        $discount = $product->discount;
        if(!($product->discount)){
          $price = $product->price;
        } else{
          $price = round(($product->price)*((100 - $product->discount)/100), 2);
        }
        $price_dis = $product->price_dis;
        $price_master = $product->price_master;
        $price_opt = $product->price_opt;

        if(\R::exec("INSERT INTO order_product (order_id, product_id, articul, qty, title, alias, price, price_dis, price_master, price_opt, discount) VALUES ($id, $prod_id, '$articul', $qty, '$title', '$alias', $price, $price_dis, $price_master, $price_opt, $discount)")){
            $_SESSION['success'] = 'Товар добавлен';
        }
        redirect();
        }
        $this->setMeta('Новый товар');
        $this->set(compact('id'));

    }

    public function addqtyAction(){
      if(!empty($_POST)){
        $prod_id = $this->getRequestID();
        $qty = $_POST['quantity'];
        $order_product = \R::load('order_product', $prod_id);
        $order_product->qty = $qty;
        \R::store($order_product);
            $_SESSION['success'] = 'Изменения сохранены';
            redirect();
      }
  }


    public function editAction(){
      if(!empty($_POST)){
          $id = $this->getRequestID(false);
          $order = new Order();
          $data = $_POST;
          $order->load($data);
          $order->attributes['samovivoz'] = $order->attributes['samovivoz'] ? '1' : '0';
          if($order->update('order', $id)){
              $_SESSION['success'] = 'Изменения сохранены';
              redirect();
          }
      }
    }


    public function deleteProdAction(){
    $id = $this->getRequestID();
    $order_product = \R::load('order_product', $id);
    \R::trash($order_product);
    $_SESSION['success'] = 'Товар удален';
    redirect();
  }

    public function deleteAction(){
        $order_id = $this->getRequestID();
        $order = \R::load('order', $order_id);
        $products_del = \R::findAll('order_product', "order_id = ?", [$order_id]);
        \R::trash($order);
        foreach ($products_del as $product_del) {
          \R::load('order_product', $product_del);
          \R::trash($product_del);
        }
        $_SESSION['success'] = 'Заказ удален';
        redirect(ADMIN . '/order');
    }

}
