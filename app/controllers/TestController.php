<?php

namespace app\controllers;

use ishop\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class TestController extends AppController
{
	public function IndexAction()
	{

		$transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
			->setUsername(App::$app->getProperty('smtp_login'))
			->setPassword(App::$app->getProperty('smtp_password'))
		;

		$mailer = new Swift_Mailer($transport);

		$message_admin = (new Swift_Message("TEST"))
			->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
			->setTo(['web.narisuemvse@gmail.com'])
			->setBody("TEST", 'text/html')
		;

		if(!$mailer->send($message_admin, $errors)) {
			var_dump($errors);
			die();
		}

		var_dump('TEST');
		die();
	}
}