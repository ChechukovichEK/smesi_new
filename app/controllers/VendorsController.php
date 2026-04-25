<?php

namespace app\controllers;

use ishop\libs\Pagination;

class VendorsController extends AppController
{

	public function IndexAction()
	{
		$brands = \R::getAssoc("SELECT * FROM brands ORDER BY sort DESC");

		$title = "Каталог брендов товаров строительного интернет-магазина smesi.by";
		$desc = "В этом разделе вы можете ознакомиться с поставщиками строительных материалов, с которыми мы сотрудничаем";

		$this->setMeta($title, $desc, $title);

		$this->set(compact('brands'));
	}

	public function ViewAction(){
		$alias = $this->route['alias'];
		$brand  = \R::findOne( 'brands', ' alias = ? ', [$alias]);
		$brand_title = $brand->title;

		if (empty($brand->meta_title)) {
			$title = $brand->title . ' - каталог товаров для строительства и ремонта на smesi.by';
		} else {
			$title = $brand->meta_title;
		}

		if (empty($brand->meta_desc)) {
			$desc = 'Smesi.by - ' . $brand->title;
		} else {
			$desc = $brand->meta_desc;
		}

		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = 20;
		$count = \R::count('product', 'manufacturer = ?', [$brand->title]);
		$pagination = new Pagination($page, $perpage, $count);
		$start = $pagination->getStart();

		$products = \R::getAll("SELECT * FROM product WHERE manufacturer = '$brand_title' AND status = '1' ORDER BY title LIMIT $start, $perpage");


		$this->setMeta($title, $desc);
		$this->set(compact('brand', 'products', 'pagination', 'count'));
	}

}