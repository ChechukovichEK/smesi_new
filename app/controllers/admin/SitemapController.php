<?php

namespace app\controllers\admin;

use app\models\AppModel;
use ishop\App;

class SitemapController extends AppController{

  public function generateAction(){
      $uploaddir = WWW;
      $dom = new \DOMDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
      $dom->formatOutput=true;
      $root = $dom->createElement("urlset"); // Создаём корневой элемент
      $xmlns = $dom->createAttribute('xmlns');
      $xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
      $dom->appendChild($root);
      $root->appendChild($xmlns);

      //главная
      $url = $dom->createElement("url"); // Создаём узел "url"
      $alias = $dom->createElement("loc", PATH.'/'); // Создаём узел "loc" с url
      $date = $dom->createElement("lastmod", date('c')); // Создаём узел "lastmod" с текущим временем
      $prior = $dom->createElement("priority", '1'); // Создаём узел "priority" со значением приоритета
      $url->appendChild($alias); // Добавляем в узел "user" узел "login"
      $url->appendChild($date);
      $url->appendChild($prior);
      $root->appendChild($url); // Добавляем в корневой узел "urlset" узел "user"

	  //контакты
	  $url = $dom->createElement("url"); // Создаём узел "url"
	  $alias = $dom->createElement("loc", PATH.'/contacts'); // Создаём узел "loc" с url
	  $date = $dom->createElement("lastmod", date('c')); // Создаём узел "lastmod" с текущим временем
	  $prior = $dom->createElement("priority", '0.8'); // Создаём узел "priority" со значением приоритета
	  $url->appendChild($alias); // Добавляем в узел "user" узел "login"
	  $url->appendChild($date);
	  $url->appendChild($prior);
	  $root->appendChild($url); // Добавляем в корневой узел "urlset" узел "user"

	  //бренды
	  $url = $dom->createElement("url"); // Создаём узел "url"
	  $alias = $dom->createElement("loc", PATH.'/vendors'); // Создаём узел "loc" с url
	  $date = $dom->createElement("lastmod", date('c')); // Создаём узел "lastmod" с текущим временем
	  $prior = $dom->createElement("priority", '0.8'); // Создаём узел "priority" со значением приоритета
	  $url->appendChild($alias); // Добавляем в узел "user" узел "login"
	  $url->appendChild($date);
	  $url->appendChild($prior);
	  $root->appendChild($url); // Добавляем в корневой узел "urlset" узел "user"

	  //посадочные страницы
	  $pages = \R::findAll('landing_pages');
	  foreach ($pages as $page) {
		  $url = $dom->createElement("url"); // Создаём узел "url"
		  $alias = $dom->createElement("loc", PATH.'/category/'.$page['alias']); // Создаём узел "loc" с url
		  $date = $dom->createElement("lastmod", date('c')); // Создаём узел "lastmod" с текущим временем
		  $prior = $dom->createElement("priority", '0.8'); // Создаём узел "priority" со значением приоритета
		  $url->appendChild($alias); // Добавляем в узел "user" узел "login"
		  $url->appendChild($date);
		  $url->appendChild($prior);
		  $root->appendChild($url); // Добавляем в корневой узел "urlset" узел "user"
	  }

      //страницы
      $pages = \R::findAll('pages');
      foreach ($pages as $page) {
        $url = $dom->createElement("url"); // Создаём узел "url"
        $alias = $dom->createElement("loc", PATH.'/page/'.$page['alias']); // Создаём узел "loc" с url
        $date = $dom->createElement("lastmod", date('c')); // Создаём узел "lastmod" с текущим временем
        $prior = $dom->createElement("priority", '0.8'); // Создаём узел "priority" со значением приоритета
        $url->appendChild($alias); // Добавляем в узел "user" узел "login"
        $url->appendChild($date);
        $url->appendChild($prior);
        $root->appendChild($url); // Добавляем в корневой узел "urlset" узел "user"
      }

      //категории
      $cats = \R::findAll('category');
      foreach ($cats as $item) {
        $url = $dom->createElement("url"); // Создаём узел "url"
        $alias = $dom->createElement("loc", PATH.'/category/'.$item['alias']); // Создаём узел "loc" с url
        $date = $dom->createElement("lastmod", date('c')); // Создаём узел "lastmod" с текущим временем
        $prior = $dom->createElement("priority", '0.8'); // Создаём узел "priority" со значением приоритета
        $url->appendChild($alias); // Добавляем в узел "user" узел "login"
        $url->appendChild($date);
        $url->appendChild($prior);
        $root->appendChild($url); // Добавляем в корневой узел "urlset" узел "user"
      }

      //товары
      $product = \R::findAll('product');
      foreach ($product as $item) {
        $url = $dom->createElement("url"); // Создаём узел "url"
        $alias = $dom->createElement("loc", PATH.'/product/'.$item['alias']); // Создаём узел "loc" с url
        $date = $dom->createElement("lastmod", date('c')); // Создаём узел "lastmod" с текущим временем
        $prior = $dom->createElement("priority", '0.8'); // Создаём узел "priority" со значением приоритета
        $url->appendChild($alias); // Добавляем в узел "user" узел "login"
        $url->appendChild($date);
        $url->appendChild($prior);
        $root->appendChild($url); // Добавляем в корневой узел "urlset" узел "user"
      }

      //статьи
      $url = $dom->createElement("url"); // Создаём узел "url"
      $alias = $dom->createElement("loc", PATH.'/article'); // Создаём узел "loc" с url
      $date = $dom->createElement("lastmod", date('c')); // Создаём узел "lastmod" с текущим временем
      $prior = $dom->createElement("priority", '0.8'); // Создаём узел "priority" со значением приоритета
      $url->appendChild($alias); // Добавляем в узел "user" узел "login"
      $url->appendChild($date);
      $url->appendChild($prior);
      $root->appendChild($url); // Добавляем в корневой узел "urlset" узел "user"
      $articles = \R::findAll('articles');
      foreach ($articles as $item) {
        $url = $dom->createElement("url"); // Создаём узел "url"
        $alias = $dom->createElement("loc", PATH.'/article/'.$item['alias']); // Создаём узел "loc" с url
        $date = $dom->createElement("lastmod", date('c')); // Создаём узел "lastmod" с текущим временем
        $prior = $dom->createElement("priority", '0.8'); // Создаём узел "priority" со значением приоритета
        $url->appendChild($alias); // Добавляем в узел "user" узел "login"
        $url->appendChild($date);
        $url->appendChild($prior);
        $root->appendChild($url); // Добавляем в корневой узел "urlset" узел "user"
      }
//
    $dom->save($uploaddir.'/sitemap.xml');
    $_SESSION['success'] = 'Файл sitemap.xml успешно сгенерирован!';
    redirect(ADMIN);

  }
}
