<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\currency\Currency;
use ishop\App;
use ishop\base\Controller;
use ishop\Cache;

class AppController extends Controller{

    public function __construct($route){
        parent::__construct($route);
        new AppModel();
        App::$app->setProperty('cats', self::cacheCategory());
        App::$app->setProperty('pages', self::cachePages());
        if(!empty($_SESSION['user'])){
          App::$app->setProperty('cart_qtytop', self::cartQty());
        }
		self::getSettings();
    }

	private function getSettings()
	{
		$_settings = \R::findAll('settings');
		$settings = [];
		foreach ($_settings as $setting) {
			$settings[$setting->name] = $setting->value;
		}
		
		self::getPhones($settings);
		unlink($settings['phone']);
		unlink($settings['additional_phones']);

		App::$app->setProperty('settings', $settings);
	}

	private function getPhones($settings)
	{
		$phone = [
			'text' => $settings['phone'],
			'link' => str_replace(')', '', str_replace('(', '', str_replace('-', '', str_replace(' ', '', $settings['phone'])))),
		];
		App::$app->setProperty('phone', $phone);
		self::getAdditionalPhones($settings);
	}

	private function getAdditionalPhones($settings) {

		$phones = explode('|', $settings['additional_phones']);
		$additional_phones = [];

		foreach ($phones as $phone) {
			$additional_phones[] = [
				'text' => $phone,
				'link' => str_replace(')', '', str_replace('(', '', str_replace('-', '', str_replace(' ', '', $phone)))),
			];
		}

		App::$app->setProperty('additional_phones', $additional_phones);
	}

    public static function cartQty(){
        if(!empty($_SESSION['user'])){
          $user_id = $_SESSION['user']['id'];
          $cart_products = \R::getAll("SELECT * FROM cart JOIN product ON product.id = cart.product_id WHERE cart.user_id = ? AND product.status = '1'", [$user_id]);
          $cart_qtytop = 0;
            foreach($cart_products as $id => $item){
              $cart_qtytop += $item['qty'];
            }
        }
        return $cart_qtytop;
    }

    public static function cacheCategory(){
        $cache = Cache::instance();
        $cats = $cache->get('cats');
        if(!$cats){
            $cats = \R::getAssoc("SELECT * FROM category WHERE show_cat = '1' ORDER BY position");
            $cache->set('cats', $cats);
        }
        return $cats;
    }

    public static function cachePages(){
        $cache = Cache::instance();
        $pages = $cache->get('pages');
        if(!$pages){
            $pages = \R::getAssoc("SELECT * FROM pages ORDER BY position");
            $cache->set('pages', $pages);
        }
        return $pages;
    }

    public function getRequestID($get = true, $id = 'id'){
        if($get){
            $data = $_GET;
        }else{
            $data = $_POST;
        }
        $id = !empty($data[$id]) ? (int)$data[$id] : null;
        if(!$id){
            throw new \Exception('Страница не найдена', 404);
        }
        return $id;
    }

}
