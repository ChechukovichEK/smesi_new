<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Category;
use ishop\App;
use ishop\libs\Pagination;

class CategoryController extends AppController
{
	public function viewAction()
	{
		$alias = $this->route['alias'];
		
		/* --- 1. Категория или лендинг --- */
		$category = \R::findOne('category', 'alias = ?', [$alias]);
		$landing = null;
		$_filter = null;
		$landing_pages_checker = false;
		
		if (!$category) {
			$landing = \R::findOne('landing_pages', 'alias = ?', [$alias]);
			if (!$landing) {
				throw new \Exception('Страница не найдена', 404);
			}
			
			$landing_pages_checker = true;
			$category = \R::findOne('category', 'alias = ?', [$landing->category_alias]);
			
			if (!$category) {
				throw new \Exception('Страница не найдена', 404);
			}
			
			foreach (['title', 'content', 'meta_title', 'meta_desc', 'short_text'] as $f) {
				$category->$f = $landing->$f;
			}
			
			$_filter = $landing->filter;
		} else {
			
			// Редирект на лендинг только при первом заходе (без реферера)
			if (!empty($_GET['filter']) && !$this->isAjax() && empty($_SERVER['HTTP_REFERER'])) {
				
				$getFilter = $_GET['filter'];
				if (is_array($getFilter)) {
					$getFilter = implode(',', $getFilter);
				}
				
				$landing = \R::findOne(
					'landing_pages',
					'category_alias = ? AND filter = ?',
					[$alias, $getFilter]
				);
				
				if ($landing) {
					header('HTTP/1.1 301 Moved Permanently');
					header('Location: ' . PATH . '/category/' . $landing->alias);
					exit;
				}
			}
		}
		
		
		/* --- 2. Хлебные крошки + дочерние категории --- */
		$children_cats = \R::find('category', "parent_id = ? AND show_cat = '1' ORDER BY position", [$category->id]);
		$breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id, $category->alias);
		
		/* --- 3. ID товаров категории --- */
		$cat_model = new Category();
		$ids = $cat_model->getIds($category->id);
		$ids = $ids ? $ids . $category->id : $category->id;
		
		$ids_products = \R::find('cat_product', "cat_id IN ($ids) GROUP BY prod_id");
		$ids_prod = $cat_model->getprodIds($ids_products);
		
		/* --- ДЕФОЛТНЫЕ ПЕРЕМЕННЫЕ --- */
		$products = [];
		$filter_group = [];
		$attrs = [];
		$cat_values = [];
		$groupes = [];
		$params_array = [];
		$unic_text = null;
		$filter_meta = null;
		$no_products_message = null;
		
		/* --- Cортировка --- */
		
		$sortList = [
			['title' => 'Цена ↑', 'value' => 'price_asc'],
			['title' => 'Цена ↓', 'value' => 'price_desc'],
			['title' => 'Сначала со скидкой', 'value' => 'discount_desc'],
			['title' => 'Популярные', 'value' => 'hit'],
			//['title' => 'Новинки', 'value' => 'new'],
			//['title' => 'В наличии', 'value' => 'have'],
			//['title' => 'По умолчанию', 'value' => ''],
		];
		
		/* --- 4. Если в категории нет товаров --- */
		if (empty($ids_prod)) {
			
			$no_products_message = "В данной категории товары отсутствуют";
			
			if ($this->isAjax()) {
				$this->layout = false;
				$this->loadView('sort', compact(
					'products',
					'no_products_message',
					'breadcrumbs',
					'category',
					'children_cats',
					'filter_group',
					'attrs',
					'cat_values',
					'groupes',
					'params_array',
					'unic_text',
					'landing_pages_checker',
					'sortList'
				));
				return;
			}
			
			$this->set(compact(
				'products',
				'no_products_message',
				'breadcrumbs',
				'category',
				'children_cats',
				'filter_group',
				'attrs',
				'cat_values',
				'groupes',
				'params_array',
				'unic_text',
				'landing_pages_checker',
				'sortList'
			));
			return;
		}
		
		/* --- 5. Фильтры --- */
		
		// getFilter() теперь возвращает МАССИВ ID или null
		$filterIds = $cat_model->getFilter($_filter);          // array|null
		$filterCsv = $filterIds ? implode(',', $filterIds) : ''; // строка "1,2,3" или ""
		
		$sql_filter = '';
		$sql_filter_total = '';
		$filter = $filterIds; // для передачи во view (как есть, массив)
		
		if (!empty($filterIds)) {
			
			$cnt = $cat_model->getCountGroups($filterIds);
			
			$sql_filter = "AND id IN (
                SELECT product_id FROM attribute_product
                WHERE attr_id IN ($filterCsv)
                GROUP BY product_id
                HAVING COUNT(product_id) >= $cnt
            )";
			
			$sql_filter_total = "AND prod_id IN (
                SELECT product_id FROM attribute_product
                WHERE attr_id IN ($filterCsv)
                GROUP BY product_id
                HAVING COUNT(product_id) >= $cnt
            )";
			
			if (!$landing_pages_checker) {
				$filter_names = \R::find('attribute_value', "id IN ($filterCsv)");
				$filter_meta = $cat_model->getFilterValues($filter_names);
			}
		}
		
		/* --- 6. Пагинация --- */
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = App::$app->getProperty('pagination_new');
		
		$total = count(\R::find(
			'cat_product',
			"cat_id IN ($ids) $sql_filter_total AND prod_id IN (SELECT id FROM product WHERE status = 1) GROUP BY prod_id"
		));
		
		$pagination = new Pagination($page, $perpage, $total);
		$start = $pagination->getStart();
		
		/* --- 7. Сортировка --- */
		$sort = $cat_model->getSort();
		if ($sort === 'price' || $sort === 'discount') {
			$_SESSION['sort'] = $sort;
		}
		
		$order_sql = $this->getSortSQL($sort, $category);
		
		/* --- 8. Получение товаров --- */
		$products = \R::find(
			'product',
			"status = '1' AND id IN ($ids_prod) $sql_filter $order_sql LIMIT $start, $perpage"
		);
		
		$products_flt = \R::find(
			'product',
			"status = '1' AND id IN ($ids_prod) $sql_filter $order_sql"
		);
		
		/* --- 9. Если фильтры дали пустой результат --- */
		if (empty($products)) {
			
			$no_products_message = "По выбранным фильтрам товаров не найдено";
			
			$filter_group = $cat_model->getGroups($category->id);
			$cat_values = $cat_model->getCatValues($filter_group);
			$attrs = $cat_model->getAttrs();
			$groupes = \R::find('groupes', 'category_id = ?', [$category->id]);
			
			if ($this->isAjax()) {
				$this->layout = false;
				$this->loadView('sort', compact(
					'products',
					'no_products_message',
					'breadcrumbs',
					'category',
					'children_cats',
					'pagination',
					'filter_meta',
					'filter_group',
					'attrs',
					'cat_values',
					'groupes',
					'params_array',
					'unic_text',
					'landing_pages_checker',
					'filter',
					'sortList'
				));
				return;
			}
			
			$this->set(compact(
				'products',
				'no_products_message',
				'breadcrumbs',
				'category',
				'children_cats',
				'pagination',
				'filter_meta',
				'filter_group',
				'attrs',
				'cat_values',
				'groupes',
				'params_array',
				'unic_text',
				'landing_pages_checker',
				'filter',
				'sortList'
			));
			return;
		}
		
		/* --- 10. Параметры фильтров --- */
		$ids_prods = array_column($products_flt, 'id');
		if ($ids_prods) {
			$ids_str = implode(',', $ids_prods);
			$prods_params = \R::getAll("SELECT attr_id FROM attribute_product WHERE product_id IN ($ids_str)");
			foreach ($prods_params as $v) {
				$params_array[] = $v['attr_id'];
			}
			$params_array = array_unique($params_array);
		}
		
		$filter_group = $cat_model->getGroups($category->id);
		$cat_values = $cat_model->getCatValues($filter_group);
		$attrs = $cat_model->getAttrs();
		$groupes = \R::find('groupes', 'category_id = ?', [$category->id]);
		
		/* --- 11. AJAX: фильтры --- */
		if ($this->isAjax() && !empty($filterIds) && !isset($_GET['sort'])) {
			$this->layout = false;
			$this->loadView('filter', compact(
				'products',
				'pagination',
				'total',
				'params_array',
				'filter_meta',
				'category',
				'filter_group',
				'attrs',
				'cat_values',
				'children_cats',
				'landing_pages_checker',
				'unic_text',
				'filter',
				'sortList'
			));
			return;
		}
		
		/* --- 12. AJAX: сортировка --- */
		if ($this->isAjax() && array_key_exists('sort', $_GET)) {
			$this->layout = false;
			$this->loadView('sort', compact(
				'products',
				'breadcrumbs',
				'pagination',
				'total',
				'category',
				'filter_group',
				'attrs',
				'filter',
				'filter_meta',
				'cat_values',
				'children_cats',
				'groupes',
				'params_array',
				'landing_pages_checker',
				'unic_text',
				'sortList'
			));
			return;
		}
		
		/* --- 12. Глобальная AJAX-ветка --- */
		if ($this->isAjax()) {
			$this->layout = false;
			$this->loadView('components/ajcont', compact(
				'products',
				'breadcrumbs',
				'pagination',
				'total',
				'category',
				'filter_group',
				'attrs',
				'filter',
				'filter_meta',
				'cat_values',
				'children_cats',
				'groupes',
				'params_array',
				'landing_pages_checker',
				'unic_text',
				'no_products_message',
				'sortList'
			));
			return;
		}
		
		
		/* --- 13. Meta --- */
		if (!empty($filterIds) && !$landing_pages_checker) {
			$this->setMeta(
				$category->title . ' ' . $filter_meta . ' купить в Минске - ' . App::$app->getProperty('shop_name'),
				'Купить ' . $category->title . ' ' . $filter_meta . ' в Минске и по всей Беларуси. Бесплатная доставка, официальная гарантия',
				$category->title . ' ' . $filter_meta,
				$category->img
			);
		} else {
			$title = empty($category->meta_title)
				? $category->title . ' купить в Минске - ' . App::$app->getProperty('shop_name')
				: $category->meta_title;
			
			$desc = empty($category->meta_desc)
				? 'Купить ' . $category->title . ' в Минске и по всей Беларуси. Бесплатная доставка, официальная гарантия'
				: $category->meta_desc;
			
			$this->setMeta($title, $desc, $title, $category->img);
		}
		
		/* --- 14. Вывод --- */
		$this->set(compact(
			'products',
			'breadcrumbs',
			'pagination',
			'total',
			'category',
			'filter_group',
			'attrs',
			'filter',
			'filter_meta',
			'cat_values',
			'children_cats',
			'groupes',
			'params_array',
			'landing_pages_checker',
			'unic_text',
			'no_products_message',
			'sortList'
		));
	}
	
	private function getSortSQL($sort, $category)
	{
		switch ($sort) {
			
			case 'price_asc':
				return "ORDER BY price ASC";
			
			case 'price_desc':
				return "ORDER BY price DESC";
			
			case 'discount':
			case 'discount_desc':
				return "ORDER BY discount DESC, price ASC";
			
			case 'new':
				return "ORDER BY new DESC, position ASC";
			
			case 'hit':
				return "ORDER BY hit DESC, position ASC";
			
			case 'have':
				return "ORDER BY is_have DESC, position ASC";
			
			case 'position':
				return "ORDER BY position ASC";
		}
		
		if ($category->parent_id == 0) {
			return "ORDER BY all_position ASC";
		}
		
		return "ORDER BY position ASC";
	}
}