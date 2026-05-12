<?php

namespace app\controllers;

use app\models\AppModel;
use app\models\Navigation;
use app\widgets\currency\Currency;
use ishop\App;
use ishop\base\Controller;
use ishop\Cache;

class AppController extends Controller {
	
	public function __construct($route) {
		parent::__construct($route);
		
		new AppModel();
		
		App::$app->setProperty('cats', self::cacheCategory());
		App::$app->setProperty('pages', self::cachePages());
		
		if (!empty($_SESSION['user'])) {
			App::$app->setProperty('cart_qtytop', self::cartQty());
		}
		
		self::getSettings();
		
		$this->loadNavigation();
	}
	
	/**
	 * Загружает настройки сайта из таблицы settings
	 */
	private function getSettings() {
		$_settings = \R::findAll('settings');
		$settings = [];
		
		foreach ($_settings as $setting) {
			$settings[$setting->name] = $setting->value;
		}
		
		// Формируем телефоны
		$this->preparePhones($settings);
		
		// Сохраняем настройки в контейнер
		App::$app->setProperty('settings', $settings);
	}
	
	/**
	 * Обрабатывает основной и дополнительные телефоны
	 */
	private function preparePhones(array $settings) {
		// Основной телефон
		if (!empty($settings['phone'])) {
			$phone = [
				'text' => $settings['phone'],
				'link' => $this->cleanPhone($settings['phone']),
			];
			App::$app->setProperty('phone', $phone);
		}
		
		// Дополнительные телефоны (после переделки удалить!!!!)
		if (!empty($settings['additional_phones'])) {
			$phones = explode('|', $settings['additional_phones']);
			$additional = [];
			
			foreach ($phones as $p) {
				$additional[] = [
					'text' => $p,
					'link' => $this->cleanPhone($p),
				];
			}
			
			App::$app->setProperty('additional_phones', $additional);
		}
	}
	
	/**
	 * Убирает пробелы, скобки, дефисы — готовит номер для tel:
	 */
	private function cleanPhone(string $phone): string {
		return str_replace([' ', '-', '(', ')'], '', $phone);
	}
	
	/**
	 * Количество товаров в корзине пользователя
	 */
	public static function cartQty() {
		if (empty($_SESSION['user'])) {
			return 0;
		}
		
		$user_id = $_SESSION['user']['id'];
		
		$cart_products = \R::getAll("
            SELECT * FROM cart
            JOIN product ON product.id = cart.product_id
            WHERE cart.user_id = ? AND product.status = '1'
        ", [$user_id]);
		
		$cart_qtytop = 0;
		
		foreach ($cart_products as $item) {
			$cart_qtytop += $item['qty'];
		}
		
		return $cart_qtytop;
	}
	
	/**
	 * Кеширование категорий
	 */
	public static function cacheCategory() {
		$cache = Cache::instance();
		$cats = $cache->get('cats');
		
		if (!$cats) {
			$cats = \R::getAssoc("SELECT * FROM category WHERE show_cat = '1' ORDER BY position");
			$cache->set('cats', $cats);
		}
		
		return $cats;
	}
	
	/**
	 * Кеширование страниц
	 */
	public static function cachePages() {
		$cache = Cache::instance();
		$pages = $cache->get('pages');
		
		if (!$pages) {
			$pages = \R::getAssoc("SELECT * FROM pages ORDER BY position");
			$cache->set('pages', $pages);
		}
		
		return $pages;
	}
	
	/**
	 * Получение ID из GET или POST
	 */
	public function getRequestID($get = true, $id = 'id') {
		$data = $get ? $_GET : $_POST;
		
		$id = !empty($data[$id]) ? (int)$data[$id] : null;
		
		if (!$id) {
			throw new \Exception('Страница не найдена', 404);
		}
		
		return $id;
	}
	
	private function loadNavigation()
	{
		$nav = new \app\models\Navigation();
		
		$header = $nav->getAll('top');
		$footer = $nav->getAll('bottom');
		$mobile = $nav->getAll('mobile');
		//$terms  = $nav->getAll('terms');
		
		App::$app->setProperty('nav_header', $this->buildTree($header));
		App::$app->setProperty('nav_footer', $this->buildTree($footer));
		App::$app->setProperty('nav_mobile', $this->buildTree($mobile));
		//App::$app->setProperty('nav_terms',  $this->buildTree($terms));
	}
	
	private function buildTree($items)
	{
		$tree = [];
		$refs = [];
		
		foreach ($items as $item) {
			$item->children = [];
			$refs[$item->id] = $item;
			
			if ($item->id_parent == 0) {
				$tree[$item->id] = $item;
			}
		}
		
		foreach ($items as $item) {
			if ($item->id_parent != 0 && isset($refs[$item->id_parent])) {
				$refs[$item->id_parent]->children[$item->id] = $item;
			}
		}
		
		return $tree;
	}
	
}