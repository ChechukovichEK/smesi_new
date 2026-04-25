<?php
$sorce_url = 'https://mc.yandex.ru/metrika/tag.js';
$filename = 'tag.js';
if (file_exists($filename)) {
	echo file_get_contents($filename);
	$current_datetime = new DateTime();
	$files_datetime = new DateTime(date("F d Y H:i:s.", filectime($filename)));
	$difference = $current_datetime->diff($files_datetime);
	if ($difference->i > 50 || $difference->h > 0) {
		get_tag_js($sorce_url, $filename);
	}
}else{
	echo get_tag_js($sorce_url, $filename);
}

//Выкачиваем tag.js, отображаем его содержимое и кладём в папку
function get_tag_js($sorce_url, $filename) {
	$sorce_data = file_get_contents($sorce_url);
	if ($sorce_data != '') {
		file_put_contents($filename, $sorce_data);
		return $sorce_data;
	}else{
		return 'console.log("Не удаётся получить содержимое файла tag.php");';
	}
}