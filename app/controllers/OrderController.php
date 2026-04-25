<?php

namespace app\controllers;

use ishop\App;
use ishop\libs\Pagination;

class OrderController extends AppController {

  public function viewAction(){
      $order_id = $this->getRequestID();
      $order = \R::getRow("SELECT `order`.* FROM `order`
  JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
  WHERE `order`.`id` = ?
  GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT 1", [$order_id]);
      if(!$order){
          throw new \Exception('Страница не найдена', 404);
      }
      $order_products = \R::findAll('order_product', "order_id = ?", [$order_id]);
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $perpage = App::$app->getProperty('pagination');
      $total = \R::count('order_product', "order_id = ?", [$order_id]);
      $pagination = new Pagination($page, $perpage, $total);
      $start = $pagination->getStart();
      $this->setMeta("Заказ №{$order_id}");
      $this->set(compact('order', 'order_products', 'total', 'pagination'));
  }
}
