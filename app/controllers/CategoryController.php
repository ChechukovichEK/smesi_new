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
		
		// 1. Категория / лендинг
		$category = \R::findOne('category', 'alias = ?', [$alias]);
		$landing = null;
		$landingFilter = null;
		$landingPagesChecker = false;
		
		if (!$category) {
			$landing = \R::findOne('landing_pages', 'alias = ?', [$alias]);
			if (!$landing) {
				throw new \Exception('Страница не найдена', 404);
			}
			
			$landingPagesChecker = true;
			
			$category = \R::findOne('category', 'alias = ?', [$landing->category_alias]);
			if (!$category) {
				throw new \Exception('Страница не найдена', 404);
			}
			
			// подменяем только отображаемые поля
			foreach (['title', 'content', 'meta_title', 'meta_desc', 'short_text'] as $f) {
				$category->$f = $landing->$f;
			}
			
			$landingFilter = $landing->filter;
		}
		
		// 2. Хлебные крошки + дочерние категории
		$children_cats = \R::find('category', "parent_id = ? AND show_cat = '1' ORDER BY position", [$category->id]);
		$breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id, $category->alias);
		
		// 3. ID товаров категории
		$catModel = new Category();
		$catIds = $catModel->getCategoryTreeIds((int)$category->id);
		$catIds[] = (int)$category->id;
		
		$prodIds = $catModel->getCategoryProductIds($catIds);
		
		// дефолты
		$products = [];
		$filter_group = [];
		$attrs = [];
		$cat_values = [];
		$groupes = [];
		$params_array = [];
		$unic_text = null;
		$filter_meta = null;
		$no_products_message = null;
		
		$sortList = $catModel->getSortList();
		$activeSort = $catModel->getActiveSort();
		
		// 4. если нет товаров вообще
		if (empty($prodIds)) {
			
			$no_products_message = "В данной категории товары отсутствуют";
			
			if ($this->isAjax()) {
				$this->layout = false;
				$this->loadView('/Category/components/ajcont', compact(
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
					'landingPagesChecker',
					'sortList',
					'activeSort',
					'pagination'
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
				'landingPagesChecker',
				'sortList',
				'activeSort'
			));
			return;
		}
		
		// 5. фильтры
		$filterIds = $catModel->normalizeFilter($landingFilter);
		[$sql_filter, $sql_filter_total] = $catModel->buildFilterSql($filterIds);
		$filter = $filterIds;
		
		if (!empty($filterIds) && !$landingPagesChecker) {
			$filter_meta = $catModel->getFilterMeta($filterIds);
		}
		
		// 6. пагинация
		$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
		$perpage = App::$app->getProperty('pagination_new');
		
		$placeholdersCat = implode(',', array_fill(0, count($catIds), '?'));
		
		$total = \R::getCell("
			SELECT COUNT(DISTINCT prod_id)
			FROM cat_product
			WHERE cat_id IN ($placeholdersCat)
			$sql_filter_total
			AND prod_id IN (SELECT id FROM product WHERE status = 1)
		", $catIds);
		
		$pagination = new Pagination($page, $perpage, (int)$total);
		$start = $pagination->getStart();
		
		// 7. сортировка
		$order_sql = $catModel->getSortSql($activeSort);
		
		// 8. товары
		$placeholdersProdIds = implode(',', array_fill(0, count($prodIds), '?'));
		
		$products = \R::find(
			'product',
			"status = '1'
         AND id IN ($placeholdersProdIds)
         $sql_filter
         $order_sql
         LIMIT $start, $perpage",
			$prodIds
		);
		
		$products_flt = \R::find(
			'product',
			"status = '1'
         AND id IN ($placeholdersProdIds)
         $sql_filter
         $order_sql",
			$prodIds
		);
		
		// 9. если фильтры дали пустой результат
		if (empty($products)) {
			
			$no_products_message = "По выбранным фильтрам товаров не найдено";
			
			$filter_group = $catModel->getGroups((int)$category->id);
			$cat_values = $catModel->getCatValues($filter_group);
			$attrs = $catModel::getAttrs();
			$groupes = \R::find('groupes', 'category_id = ?', [$category->id]);
			
			if ($this->isAjax()) {
				$this->layout = false;
				$this->loadView('/Category/components/ajcont', compact(
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
					'landingPagesChecker',
					'filter',
					'sortList',
					'activeSort'
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
				'landingPagesChecker',
				'filter',
				'sortList',
				'activeSort'
			));
			return;
		}
		
		// 10. параметры фильтров
		$ids_prods = array_column($products_flt, 'id');
		if ($ids_prods) {
			$ids_str = implode(',', array_map('intval', $ids_prods));
			$prods_params = \R::getAll("SELECT attr_id FROM attribute_product WHERE product_id IN ($ids_str)");
			foreach ($prods_params as $v) {
				$params_array[] = (int)$v['attr_id'];
			}
			$params_array = array_unique($params_array);
		}
		
		$filter_group = $catModel->getGroups((int)$category->id);
		$cat_values = $catModel->getCatValues($filter_group);
		$attrs = $catModel::getAttrs();
		$groupes = \R::find('groupes', 'category_id = ?', [$category->id]);
		
		// 11. AJAX — единая ветка
		if ($this->isAjax()) {
			$this->layout = false;
			$this->loadView('/Category/components/ajcont', compact(
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
				'landingPagesChecker',
				'unic_text',
				'no_products_message',
				'sortList',
				'activeSort'
			));
			return;
		}
		
		// 12. Meta
		if (!empty($filterIds) && !$landingPagesChecker && $filter_meta) {
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
		
		// 13. вывод полной страницы
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
			'landingPagesChecker',
			'unic_text',
			'no_products_message',
			'sortList',
			'activeSort'
		));
	}
	
	public function isAjax()
	{
		return (
				!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
				strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
			) ||
			(isset($_GET['ajax']) && $_GET['ajax'] == 1);
	}
	
	private function getSortSQL($sort, $category)
	{
		switch ($sort) {
			
			case 'price_asc':
				return "ORDER BY is_have DESC, price ASC";
			
			case 'price_desc':
				return "ORDER BY (is_have = 1) DESC, price DESC";
			
			case 'discount':
			case 'discount_desc':
				return "ORDER BY discount DESC, price ASC";
			
			case 'new':
				return "ORDER BY new DESC, position ASC";
			
			case 'hit':
				return "ORDER BY is_have DESC";
				
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