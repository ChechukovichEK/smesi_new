<?php

namespace app\controllers;

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
		$products = [];
		if($query){
			// Сначала пробуем FULLTEXT
			$products = \R::getAll("SELECT product.*, category.title AS cat
            FROM product
            JOIN category ON category.id = product.category_id
            WHERE MATCH(product.title, product.alias, product.articul)
            AGAINST (? IN BOOLEAN MODE)
            AND product.status = 1", ["+$query*"]);
			
			// Если ничего не нашли — fallback на LIKE
			if(!$products){
				$products = \R::getAll("SELECT product.*, category.title AS cat
                FROM product
                JOIN category ON category.id = product.category_id
                WHERE product.title LIKE ?
                AND product.status = 1", ["%{$query}%"]);
			}
		}
		$this->setMeta('Поиск по: ' . h($query));
		$this->set(compact('products', 'query'));
	}
	
	
	/*public function indexAction(){
        $query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;
        if($query){
            $products = \R::find('product', "MATCH (title, alias, articul) AGAINST ('+$query*') AND status = '1'");
        }
        $this->setMeta('Поиск по: ' . h($query));
        $this->set(compact('products', 'query'));
    }*/

}
