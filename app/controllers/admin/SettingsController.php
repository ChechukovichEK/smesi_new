<?php

namespace app\controllers\admin;

use app\models\admin\Setting;

class SettingsController extends AppController
{
	public function indexAction()
	{
		$_settings = \R::findAll('settings');
		$settings = [];
		
		foreach ($_settings as $setting) {
			$settings[$setting->name] = $setting->value;
		}
		
		$this->setMeta('Настройки');
		$this->set(compact('settings'));
	}
	
	public function editAction()
	{
		// === GET: показать форму ===
		if (empty($_POST)) {
			
			$_settings = \R::findAll('settings');
			$settings = [];
			
			foreach ($_settings as $setting) {
				$settings[$setting->name] = $setting->value;
			}
			
			$this->setMeta('Редактирование настроек');
			$this->set(compact('settings'));
			return;
		}
		
		// === POST: сохранить ===
		$fields = [
			'legal_entity',
			'header_scripts',
			'footer_scripts',
			'body_scripts',
			'phone',
			'email',
			'address_store',
			'address_office',
			'schedule',
			'additional_phones',
		];
		
		foreach ($fields as $name) {
			$value = $_POST[$name] ?? '';
			
			$row = \R::findOne('settings', 'name = ?', [$name]);
			if ($row) {
				$row->value = $value;
				\R::store($row);
			}
		}
		
		$_SESSION['success'] = 'Настройки обновлены';
		redirect(ADMIN . '/settings');
	}
	
	public function sitemapAction()
	{
		$file = WWW . '/sitemap.xml';
		
		// Получаем страницы
		$pages = \R::getAll("SELECT alias FROM pages");
		
		// Текущее время в ISO 8601
		$now = date('Y-m-d\TH:i:sP');
		
		$xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
		$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
		
		// Главная
		$xml .= '<url>';
		$xml .= '<loc>' . PATH . '</loc>';
		$xml .= '<lastmod>' . $now . '</lastmod>';
		$xml .= '<priority>1.0</priority>';
		$xml .= '</url>' . PHP_EOL;
		
		// Страницы
		foreach ($pages as $p) {
			$xml .= '<url>';
			$xml .= '<loc>' . PATH . '/page/' . $p['alias'] . '</loc>';
			$xml .= '<lastmod>' . $now . '</lastmod>';
			$xml .= '<priority>0.7</priority>';
			$xml .= '</url>' . PHP_EOL;
		}
		
		// Категории
		$categories = \R::getAll("SELECT alias FROM category WHERE show_cat = 1");
		
		foreach ($categories as $cat) {
			$xml .= '<url>';
			$xml .= '<loc>' . PATH . '/category/' . $cat['alias'] . '</loc>';
			$xml .= '<lastmod>' . $now . '</lastmod>';
			$xml .= '<priority>0.8</priority>';
			$xml .= '</url>' . PHP_EOL;
		}
		
		// Посадочные страницы
		$landings = \R::getAll("SELECT alias FROM landing_pages");
		
		foreach ($landings as $lp) {
			$xml .= '<url>';
			$xml .= '<loc>' . PATH . '/category/' . $lp['alias'] . '</loc>';
			$xml .= '<lastmod>' . $now . '</lastmod>';
			$xml .= '<priority>0.9</priority>';
			$xml .= '</url>' . PHP_EOL;
		}
		
		$xml .= '</urlset>';
		
		file_put_contents($file, $xml);
		
		$_SESSION['success'] = 'Файл sitemap.xml успешно сгенерирован';
		redirect(ADMIN . '/settings');
	}
}