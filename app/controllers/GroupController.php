<?php
namespace app\controllers;
use ishop\App;

class GroupController extends AppController {

    public function viewAction(){
      $alias = $this->route['alias'];
      $groupe = \R::findOne('groupes', 'alias = ?', [$alias]);
      $category = \R::findOne('category', 'id = ?', [$groupe->category_id]);
      $product_ids = \R::find('groupe_product', 'groupe_id = ?', [$groupe->id]);
      if($product_ids){
      $ids = $this -> getproductids($product_ids);
      $groupe_products = \R::find('product', "id IN ($ids)");
      $this->set(compact('groupe', 'groupe_products', 'category'));
    } else{
      $this->set(compact('groupe','category'));
    }
      $this->setMeta('Smesi.by - акции и скидки', '[Smesi.by - акции и скидки] ➨ Доставка. Официальная гарантия. Самые низкие цены ➨ Заходите!');
    }
    public function getproductids($product_ids){
      $ids = null;
      foreach ($product_ids as $key => $value) {
        $ids .= $value['product_id'] . ',';
      }
      $ids = trim($ids, ',');
      return $ids;
    }

}
?>
