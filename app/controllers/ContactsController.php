<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Product;
use ishop\App;

class ContactsController extends AppController {

    public function indexAction(){

		$meta_title = "Контакты интернет-магазина строительных материалов Smesi.by";
		$meta_desc = "Контакты интернет-магазина Smesi.by: номера телефонов и электронная почта, по которым с нами можно связаться, а также адреса офисов в Минске.";

        $this->setMeta($meta_title, $meta_desc, $meta_title, $meta_desc);
    }

}
