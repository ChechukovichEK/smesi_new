<?php
namespace app\controllers;
use ishop\App;

class SaleController extends AppController {

    public function indexAction(){
      $sales = \R::find('product', "sale = '1' ORDER BY sale_position");
      $this->setMeta('Скидки и акции на строительные материалы в Минске - smesi.by', '[Smesi.by - акции и скидки] ➨ Доставка. Официальная гарантия. Самые низкие цены ➨ Заходите!');
      $this->set(compact('sales'));
    }
}
?>
