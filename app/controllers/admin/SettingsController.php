<?php

namespace app\controllers\admin;

use app\models\admin\Setting;

class SettingsController extends AppController
{

	public function indexAction() {
		$_settings = \R::findAll('settings');
		$settings = [];
		foreach ($_settings as $setting) {
			$settings[$setting->name] = $setting->value;
		}

		$this->setMeta('Настройки');
		$this->set(compact('settings'));
	}

	public function editAction() {
		if(!empty($_POST)) {
			$fields = [
				'legal_entity' => $_POST['legal_entity'],
				'header_scripts' => $_POST['header_scripts'],
				'footer_scripts' => $_POST['footer_scripts'],
				'body_scripts' => $_POST['body_scripts'],
				'phone' => $_POST['phone'],
				'additional_phones' => $_POST['additional_phones'],
			];

			$settings = new Setting();

			foreach ($fields as $name => $value) {
				$_item = array_shift(\R::find('settings', 'name=:name', [':name' => $name]));
				$_item_id = $_item->id;
				$_item_data = [
					'id' => $_item_id,
					'name' => $name,
					'value' => $value,
				];
				$settings->load($_item_data);
				$settings->update('settings', $_item_id);
			}

			redirect();
		} else {
			redirect();
		}
	}

}