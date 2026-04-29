<?php

namespace app\models\admin;

use app\models\AppModel;

class Article_faq extends AppModel
{
	
	public $attributes = [
		'id_article' => '',
		'title' => '',
		'text' => '',
		'visibility' => 1,
		'num' => 0,
	];
	
	public $rules = [
		'required' => [
			['title'],
			['text'],
		]
	];
	
	public function beforeSave()
	{
		// нормализация чисел
		$this->attributes['num'] = (int)$this->attributes['num'];
		$this->attributes['visibility'] = (int)$this->attributes['visibility'];
		$this->attributes['id_article'] = (int)$this->attributes['id_article'];
	}

}