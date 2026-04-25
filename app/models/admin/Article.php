<?php

namespace app\models\admin;

use app\models\AppModel;

class Article extends AppModel
{

	public $attributes = [
		'title' => '',
		'position' => '',
		'pre_content' => '',
		'date' => '',
		'content' => '',
		'meta_title' => '',
		'meta_desc' => '',
		'alias' => '',
	];

	public $rules = [
		'required' => [
			['title'],
		]
	];

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
			if ($name == 'newsimg') {
				$_SESSION['newsimg'] = $new_name;
			}
			//self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
			$res = array("file" => $new_name);
			exit(json_encode($res));
		}
	}

}
