<?php

namespace app\controllers;

class CookieController extends AppController
{
	public function agreeAction()
	{
		define('NO_LAYOUT', true); // <--- ВАЖНО
		
		$this->layout = false;
		$this->view = false;
		
		setcookie('cookieAgree', 'yes', time() + 86400, '/');
	
		echo json_encode(['error' => false]);
		exit;
	}
}
