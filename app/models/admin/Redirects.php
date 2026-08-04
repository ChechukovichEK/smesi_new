<?php
namespace app\models\admin;

use app\models\AppModel;

class Redirects extends AppModel {
	
	public $attributes = [
		'url_from' => '',
		'url_to'   => '',
		'comment'  => '',
	];
	
	public $rules = [
		'required' => ['url_from', 'url_to'],
	];
}

