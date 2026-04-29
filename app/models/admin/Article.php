<?php

namespace app\models\admin;

use app\models\AppModel;

class Article extends AppModel
{
	public $attributes = [
		'title' => '',
		'position' => 0,
		'pre_content' => '',
		'date' => '',
		'content' => '',
		'meta_title' => '',
		'meta_desc' => '',
		'alias' => '',
		'img' => '',
		'faq_title' => '',
		'published_at' => '',
	];
	
	public $rules = [
		'required' => [
			['title'],
		]
	];
	
	public function beforeSave()
	{
		// position
		if ($this->attributes['position'] === '') {
			$this->attributes['position'] = 0;
		}
		
		// date (дата создания статьи)
		if ($this->attributes['date'] === '') {
			$this->attributes['date'] = date('Y-m-d');
		}
		
		// published_at (дата обновления)
		if ($this->attributes['published_at'] === '' || $this->attributes['published_at'] === null) {
			$this->attributes['published_at'] = null;
		} else {
			$ts = strtotime($this->attributes['published_at']);
			$this->attributes['published_at'] = $ts ? date('Y-m-d H:i:s', $ts) : null;
		}
		
		
		
	}
	
	public function getImg()
	{
		if (!empty($_SESSION['newsimg'])) {
			$this->attributes['img'] = $_SESSION['newsimg'];
			unset($_SESSION['newsimg']);
		}
	}
	
	public function uploadImg($name)
	{
		$uploaddir = WWW . '/images/';
		$ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name']));
		$types = ["image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"];
		
		if ($_FILES[$name]['size'] > 1048576) {
			exit(json_encode(["error" => "Ошибка! Максимальный вес файла - 1 Мб!"]));
		}
		
		if ($_FILES[$name]['error']) {
			exit(json_encode(["error" => "Ошибка! Возможно, файл слишком большой."]));
		}
		
		if (!in_array($_FILES[$name]['type'], $types)) {
			exit(json_encode(["error" => "Допустимые расширения - .gif, .jpg, .png"]));
		}
		
		$new_name = md5(time()) . ".$ext";
		$uploadfile = $uploaddir . $new_name;
		
		if (@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)) {
			if ($name == 'newsimg') {
				$_SESSION['newsimg'] = $new_name;
			}
			exit(json_encode(["file" => $new_name]));
		}
	}
}