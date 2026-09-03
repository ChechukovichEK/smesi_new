<?php

namespace app\controllers;

use ishop\libs\Pagination;

class VendorsController extends AppController
{

	public function IndexAction()
	{
        $search = $_GET['search'] ?? '';
		$brands = \R::getAssoc("SELECT * FROM brands WHERE title LIKE '%".$search."%' ORDER BY sort DESC");

		$title = "Каталог брендов товаров строительного интернет-магазина smesi.by";
		$desc = "В этом разделе вы можете ознакомиться с поставщиками строительных материалов, с которыми мы сотрудничаем";

		$this->setMeta($title, $desc, $title);

		$this->set(compact('brands'));
	}

	public function ViewAction(){
		$alias = $this->route['alias'];
		$brand  = \R::findOne( 'brands', ' alias = ? ', [$alias]);
		if (!$brand) {
			throw new \Exception('Бренд не найден', 404);
		}
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
		$count = \R::count('product', 'manufacturer = ? AND status = ?', [$brand->title, 1]);
		$pagination = new Pagination($page, $perpage, $count);
		$start = $pagination->getStart();



		$products = \R::getAll("SELECT * FROM product WHERE manufacturer = '$brand_title' AND status = '1' ORDER BY title LIMIT $start, $perpage");

        $category_ids = \R::getAll("SELECT category_id FROM product WHERE manufacturer = '$brand_title' AND status = '1' ORDER BY category_id");
        $category_ids = $category_ids ? array_column($category_ids, 'category_id') : [];
        if (!empty($category_ids)) {
            $category_ids = array_unique($category_ids);
            $categories = \R::getAll("SELECT category.*, COUNT(product.id) AS product_count FROM category LEFT JOIN product ON product.category_id = category.id AND product.manufacturer = ? AND product.status = '1' WHERE category.id IN (".implode(',', $category_ids).") GROUP BY category.id", [$brand_title]);
        } else {
            $categories = [];
        }

        if ($_GET['category']) {
            $category_id = (int)$_GET['category'];
            $category_count = \R::count('product', 'manufacturer = ? AND category_id = ?', [$brand_title, $category_id]);
            $pagination = new Pagination($page, $perpage, $category_count);
            $start = $pagination->getStart();

            $products = \R::getAll("SELECT * FROM product WHERE manufacturer = '$brand_title' AND category_id = '$category_id' AND status = '1' ORDER BY title LIMIT $start, $perpage");
        }
		
		/*if ($this->isAjax()) {
			$this->layout = false;
			$this->loadView('Vendors/components/ajcont', compact('products','pagination'));
			return;
		}*/
		
		if ($this->isAjax()) {
			$this->layout = false;
			$this->loadView('components/ajcont', compact('products','pagination','category_id'));
			return;
		}
		
		
		$this->setMeta($title, $desc);
		$this->set(compact('brand', 'products', 'pagination', 'count', 'categories'));
	}
	
	public function checkAction() {
		header('Content-Type: application/json; charset=utf-8');
		
		$url = $_POST['url'] ?? '';
		$path = trim(parse_url($url, PHP_URL_PATH), '/');
		$query = parse_url($url, PHP_URL_QUERY);
		
		$uri = $path;
		if ($query) {
			$uri .= '?' . $query;
		}
		
		$redirect = \R::findOne('redirects', 'url_from = ?', [$uri]);
		
		if ($redirect) {
			echo json_encode(['redirect' => '/' . ltrim($redirect->url_to, '/')]);
		} else {
			echo json_encode(['redirect' => null]);
		}
		exit;
	}
}