<?php

namespace app\controllers;
use app\models\Product;
use ishop\App;

class SearchController extends AppController{

    public function typeaheadAction(){
        if($this->isAjax()){
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if($query){
                $products = \R::getAll("SELECT id, title, alias, img FROM product WHERE title LIKE '%$query%' OR id LIKE '$query' OR articul LIKE '$query'");
                if (!$products) {
                  $products = \R::getAll("SELECT id, title, alias, img FROM product WHERE MATCH (title, alias, articul) AGAINST ('+$query*' IN BOOLEAN MODE) ");
                }
                echo json_encode($products);
            }
        }
        die;
    }

    public function indexAction(){
        $query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;
        if($query){
            $products = \R::find('product', "MATCH (title, alias, articul) AGAINST ('+$query*') AND status = '1'");
        }
		
		$products = [];
		if ($query) {
			$products = \R::getAll(
				"SELECT * FROM product
             WHERE status = 1
             AND (title LIKE ? OR articul LIKE ? OR alias LIKE ?)",
				["%$query%", "%$query%", "%$query%"]
			);
		}
		
		// Рекомендуемые товары (как на странице товара)
		$categoryProducts = \R::find(
			'product',
			"hit = '1' AND status = '1' ORDER BY hit_position LIMIT 4"
		);
		
		// Недавно просмотренные (как в ProductController)
		$recentlyViewed = null;
		$p_model = new \app\models\Product();
		$r_viewed = $p_model->getRecentlyViewed();
		
		if ($r_viewed) {
			$recentlyViewed = \R::find(
				'product',
				'id IN (' . \R::genSlots($r_viewed) . ') GROUP BY id LIMIT 4',
				$r_viewed
			);
		}
		
        $this->setMeta('Поиск по: ' . h($query));
		$this->set(compact('products', 'query', 'categoryProducts', 'recentlyViewed'));
    }

}
