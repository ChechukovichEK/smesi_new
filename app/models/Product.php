<?php

namespace app\models;

class Product extends AppModel {

    public function setRecentlyViewed($id){
        $recentlyViewed = $this->getAllRecentlyViewed();
        if(!$recentlyViewed){
            setcookie('recentlyViewed', $id, time() + 3600*24, '/');
        }else{
            $recentlyViewed = explode('.', $recentlyViewed);
            if(!in_array($id, $recentlyViewed)){
                $recentlyViewed[] = $id;
                $recentlyViewed = implode('.', $recentlyViewed);
                setcookie('recentlyViewed', $recentlyViewed, time() + 3600*24, '/');
            }
        }
    }

    public function getRecentlyViewed(){
        if(!empty($_COOKIE['recentlyViewed'])){
            $recentlyViewed = $_COOKIE['recentlyViewed'];
            $recentlyViewed = explode('.', $recentlyViewed);
            return array_slice($recentlyViewed, -5);
        }
        return false;
    }

    public function getAllRecentlyViewed(){
        if(!empty($_COOKIE['recentlyViewed'])){
            return $_COOKIE['recentlyViewed'];
        }
        return false;
    }

    public function getParamInfo($param_groups){
      $param_info = [];
      foreach ($param_groups as $group) {
        //id группы
        $id = $group['group_id'];
        $group = \R::findOne('params_group_info', "id = ?", [$id]);
        $group_title = $group['title'];
        //параметры группы
        $params = \R::getAll("SELECT * FROM param_group JOIN attribute_value ON attribute_value.id = param_group.param_id WHERE param_group.group_id = ?", [$id]);
        //товары, принадлежащие к данной группе
        $products = \R::getAll("SELECT prod_id FROM paramgroup_product WHERE group_id =?", [$id]);
        //формируем массив
        foreach ($params as $param) {
          $param_id = $param['param_id'];
          foreach ($products as $value) {
            $prod_info = \R::findOne('attribute_product', 'product_id = ? AND attr_id = ?', [$value['prod_id'], $param_id]);
            if($prod_info){
              $product = \R::findOne('product', 'id = ?', [$prod_info['product_id']]);
              $prod_alias = $product['alias'];
              $prod_id = $product['id'];
              if (isset($product['id']) && isset($prod_alias)) {
                $param_info[$group_title][] = [
                  'param_title' => $param['value'],
                  'param_color' => $param['color'],
                  'product_id' => $product['id'],
                  'product_alias' => $prod_alias,
                ];
              } else{
                $param_info[$group_title][] = [
                  'param_title' => $param['value'],
                ];
              }
            } else{
              continue;
            }
          }
        }
      }
      return $param_info;
    }
	
	public static function getPopularRandom($limit = 12) {
		$sql = "SELECT * FROM product
            WHERE hit = 1 AND status = 1
            ORDER BY RAND()
            LIMIT {$limit}";
		return \R::getAll($sql);
	}
	
}
