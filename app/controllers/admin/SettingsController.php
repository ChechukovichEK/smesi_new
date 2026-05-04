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
			'name_site',
			'description_site',
			'address_street',
			'address_locality',
			'postal_code',
			'name_organization',
			'phone_store_1',
			'phone_store_2',
			'phone_manager_1',
			'phone_manager_2',
			'phone_office',
			'phone_general',
			'copyright',
		];
		
		// === Обработка логотипов ===
		$uploadDir = WWW . '/img/';
		
		if (!empty($_FILES['logo_header']['name'])) {
			$name = uniqid() . '_' . $_FILES['logo_header']['name'];
			move_uploaded_file($_FILES['logo_header']['tmp_name'], $uploadDir . $name);
			
			$row = \R::findOne('settings', 'name = ?', ['logo_header']);
			if ($row) {
				$row->value = $name;
				\R::store($row);
			}
		}
		
		if (!empty($_FILES['logo_footer']['name'])) {
			$name = uniqid() . '_' . $_FILES['logo_footer']['name'];
			move_uploaded_file($_FILES['logo_footer']['tmp_name'], $uploadDir . $name);
			
			$row = \R::findOne('settings', 'name = ?', ['logo_footer']);
			if ($row) {
				$row->value = $name;
				\R::store($row);
			}
		}
		
		foreach ($fields as $name) {
			
			$uploadDir = WWW . '/img/';

			// === logo_header ===
			if (!empty($_FILES['logo_header']['name'])) {
				$name = $_FILES['logo_header']['name'];
				move_uploaded_file($_FILES['logo_header']['tmp_name'], $uploadDir . $name);
				
				$row = \R::findOne('settings', 'name = ?', ['logo_header']);
				if ($row) {
					$row->value = $name;
					\R::store($row);
				}
			} else {
				// если файл не загружен — оставить старый
				$row = \R::findOne('settings', 'name = ?', ['logo_header']);
				if ($row) {
					$row->value = $_POST['logo_header_old'];
					\R::store($row);
				}
			}

			// === logo_footer ===
			if (!empty($_FILES['logo_footer']['name'])) {
				$name = $_FILES['logo_footer']['name'];
				move_uploaded_file($_FILES['logo_footer']['tmp_name'], $uploadDir . $name);
				
				$row = \R::findOne('settings', 'name = ?', ['logo_footer']);
				if ($row) {
					$row->value = $name;
					\R::store($row);
				}
			} else {
				$row = \R::findOne('settings', 'name = ?', ['logo_footer']);
				if ($row) {
					$row->value = $_POST['logo_footer_old'];
					\R::store($row);
				}
			}
			
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
		
		$xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
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