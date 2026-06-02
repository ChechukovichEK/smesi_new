<?php

namespace app\controllers;

class Page404Controller extends AppController {
	
	public $layout = 'smesi';
	
	public function indexAction() {
		http_response_code(404);
		$this->setMeta('Страница не найдена');
		
		// Получаем 8 случайных популярных товаров
		$popular =  \app\models\Product::getPopularRandom(12);
		
		$this->set(compact('popular'));
	}
}