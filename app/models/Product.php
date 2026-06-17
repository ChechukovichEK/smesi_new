<?php

namespace app\models;

class Product extends AppModel {
	
	private string $cookieName = 'recentlyViewed';
	private int $cookieDays = 30;
	private int $maxItems = 20;
	
	/**
	 * Добавляет товар в список просмотренных
	 */
	public function setRecentlyViewed(int $id): void
	{
		$items = $this->getAllRecentlyViewed();
		
		// если пусто — создаём массив
		if (!$items) {
			$items = [];
		}
		
		// удаляем дубликат, если есть
		$items = array_diff($items, [$id]);
		
		// добавляем в конец (последний просмотренный)
		$items[] = $id;
		
		// ограничиваем длину
		if (count($items) > $this->maxItems) {
			$items = array_slice($items, -$this->maxItems);
		}
		
		// сохраняем
		setcookie(
			$this->cookieName,
			json_encode($items),
			time() + 86400 * $this->cookieDays,
			'/'
		);
	}
	
	/**
	 * Возвращает последние N просмотренных товаров (по умолчанию 5)
	 */
	public function getRecentlyViewed(int $limit = 5)
	{
		$items = $this->getAllRecentlyViewed();
		if (!$items) {
			return false;
		}
		
		return array_slice($items, -$limit);
	}
	
	/**
	 * Возвращает весь список просмотренных товаров
	 */
	public function getAllRecentlyViewed()
	{
		if (empty($_COOKIE[$this->cookieName])) {
			return false;
		}
		
		$json = json_decode($_COOKIE[$this->cookieName], true);
		
		if (!is_array($json)) {
			return false;
		}
		
		// фильтруем мусор
		return array_values(array_filter($json, fn($v) => is_numeric($v)));
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
