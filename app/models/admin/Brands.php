<?php

namespace app\models\admin;

use app\models\AppModel;

class Brands extends AppModel
{

	public $attributes = [
		'title' => '',
		'alias' => '',
		'content' => '',
		'img' => '',
		'meta_title' => '',
		'meta_desc' => '',
		'sort' => '',
		'is_home' => '',
	];

	public $rules = [
		'required' => [
			['title', 'alias'],
		]
	];

	public function getImg()
	{
		if (!empty($_SESSION['brandsimg'])) {
			$this->attributes['img'] = $_SESSION['brandsimg'];
			unset($_SESSION['brandsimg']);
		}
	}

	public function uploadImg($name): void
	{
		$uploaddir = WWW . '/brands/';
		$ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
		$types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
		if ($_FILES[$name]['size'] > 1048576) {
			$res = array("error" => "Ошибка! Максимальный вес файла - 1 Мб!");
			exit(json_encode($res));
		}
		if ($_FILES[$name]['error']) {
			$res = array("error" => "Ошибка! Возможно, файл слишком большой.");
			exit(json_encode($res));
		}
		if (!in_array($_FILES[$name]['type'], $types)) {
			$res = array("error" => "Допустимые расширения - .gif, .jpg, .png");
			exit(json_encode($res));
		}
		$new_name = md5(time()) . ".$ext";
		$uploadfile = $uploaddir . $new_name;
		if (@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)) {
			if ($name == 'brandsimg') {
				$_SESSION['brandsimg'] = $new_name;
			}
			$res = array("file" => $new_name);
			exit(json_encode($res));
		}
	}

}
