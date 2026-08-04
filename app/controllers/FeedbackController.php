<?php

namespace app\controllers;

use ishop\App;
use ishop\base\Controller;

class FeedbackController extends AppController
{
	
	public function sendAction()
	{
		define('NO_LAYOUT', true);
		// Полное отключение ошибок и рендера
		error_reporting(0);
		ini_set('display_errors', 0);
		http_response_code(200);
		
		$this->layout = false;
		$this->view = false;
		
		// Отключаем ErrorController iShop
		App::$app->setProperty('error', false);
		define('IS_AJAX', true);
		
		header('Content-Type: application/json; charset=utf-8');
		
		// CSRF
		if (!isset($_POST['csrf']) || $_POST['csrf'] !== ($_SESSION['csrf'] ?? null)) {
			echo json_encode(['error' => true, 'message' => 'Ошибка безопасности']);
			return;
		}
		
		// Honeypot
		if (!empty($_POST['surname_cent'])) {
			echo json_encode(['error' => false]);
			return;
		}
		
		$name = trim($_POST['name_cent'] ?? '');
		$phone = trim($_POST['tel_cent'] ?? '');
		$product = trim($_POST['prod_title'] ?? '');
		
		// Валидация
		if ($name === '' || $phone === '') {
			echo json_encode(['error' => true, 'message' => 'Заполните все поля']);
			return;
		}
		
		// Валидация телефона под маску +375 (29) 123-45-67
		if (!preg_match('/^\+375\s?\(\d{2}\)\s?\d{3}\-\d{2}\-\d{2}$/', $phone)) {
			echo json_encode(['error' => true, 'message' => 'Некорректный телефон']);
			return;
		}
		
		$type = $product ? 'Заказ в один клик' : 'Обратный звонок';
		
		$this->addFeedback($type, $name, $phone, $product);
		$this->sendEmail($type, $name, $phone, $product);
		$this->sendTelegram($type, $name, $phone, $product);
		
		echo json_encode(['error' => false]);
		exit;
	}
	
	private function addFeedback($type, $name, $phone, $text)
	{
		$feedback = \R::dispense('feedback');
		$feedback->type = $type;
		$feedback->name = $name;
		$feedback->phone = $phone;
		$feedback->text = $text;
		$feedback->created_at = date('Y-m-d H:i:s');
		\R::store($feedback);
	}
	
	private function sendEmail($type, $name, $phone, $product)
	{
		$subject = "Smesi.by — {$type}";
		$body = "Имя: {$name}\nТелефон: {$phone}\n";
		if ($product) {
			$body .= "Товар: {$product}\n";
		}
		
		@mail("vershina@smesi.by", $subject, $body);
		//@mail("vershina_stroi@mail.ru", $subject, $body);
	}
	
	private function sendTelegram($type, $name, $phone, $product)
	{
		if (!defined('TELEGRAM_TOKEN') || !defined('TELEGRAM_CHAT')) {
			return;
		}
		
		$token = TELEGRAM_TOKEN;
		$chat_id = TELEGRAM_CHAT;
		
		$text = "<b>{$type}</b>%0A";
		$text .= "<i>Имя:</i> <b>{$name}</b>%0A";
		$text .= "<i>Телефон:</i> <b>{$phone}</b>%0A";
		if ($product) {
			$text .= "<i>Товар:</i> <b>{$product}</b>";
		}
		
		$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}";
		
		file_get_contents($url);
	}
	
	public function requestAction()
	{
		define('NO_LAYOUT', true);
		error_reporting(0);
		ini_set('display_errors', 0);
		http_response_code(200);
		
		$this->layout = false;
		$this->view = false;
		
		App::$app->setProperty('error', false);
		define('IS_AJAX', true);
		
		header('Content-Type: application/json; charset=utf-8');
		
		// CSRF
		if (!isset($_POST['csrf']) || $_POST['csrf'] !== ($_SESSION['csrf'] ?? null)) {
			echo json_encode(['error' => true, 'message' => 'Ошибка безопасности']);
			return;
		}
		
		function fixEncoding($str) {
			return mb_convert_encoding($str, 'UTF-8', 'UTF-8');
		}
		
		// Данные
		$surname = fixEncoding(trim($_POST['sur_name_cent'] ?? ''));
		$name = fixEncoding(trim($_POST['name_cent'] ?? ''));
		$phone = fixEncoding(trim($_POST['tel_cent'] ?? ''));
		$email = fixEncoding(trim($_POST['email_cent'] ?? ''));
		$address = fixEncoding(trim($_POST['address_cent'] ?? ''));
		$message = fixEncoding(trim($_POST['message_cent'] ?? ''));
		
		// Валидация
		if ($surname === '' || $name === '' || $phone === '' || $email === '') {
			echo json_encode(['error' => true, 'message' => 'Заполните обязательные поля']);
			return;
		}
		
		// Валидация телефона
		if (!preg_match('/^\+375\s?\(\d{2}\)\s?\d{3}\-\d{2}\-\d{2}$/', $phone)) {
			echo json_encode(['error' => true, 'message' => 'Некорректный телефон']);
			return;
		}
		
		// Файл
		$fileName = null;
		
		if (!empty($_FILES['file']['name'])) {
			
			// Ограничение размера
			if ($_FILES['file']['size'] > 10 * 1024 * 1024) {
				echo json_encode(['error' => true, 'message' => 'Файл превышает 10 МБ']);
				return;
			}
			
			// Ограничение форматов
			$allowed = ['image/jpeg', 'image/png', 'application/pdf'];
			if (!in_array($_FILES['file']['type'], $allowed)) {
				echo json_encode(['error' => true, 'message' => 'Недопустимый формат файла']);
				return;
			}
			
			$uploadDir = WWW . '/uploads/requests/';
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0777, true);
			}
			
			$fileName = uniqid() . '_' . $_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fileName);
		}
		
		
		// Сохранение
		$req = \R::dispense('requests');
		$req->surname = $surname;
		$req->name = $name;
		$req->phone = $phone;
		$req->email = $email;
		$req->address = $address;
		$req->message = $message;
		$req->file = $fileName;
		$req->created_at = date('Y-m-d H:i:s');
		\R::store($req);
		
		echo json_encode(['error' => false, 'message' => 'Обращение отправлено']);
		exit;
	}
	
}