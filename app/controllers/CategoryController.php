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
		$curpath = trim(CURPATH, ',\%2C');
		//debug($curpath);
		$unic_text = \R::findOne('url_text', 'url = ?', [$curpath]);
		$alias = $this->route['alias'];
		$category = \R::findOne('category', 'alias = ?', [$alias]);
		$_filter = null;
		$landing_pages_checker = false;
		if (!$category) {
			$landing_pages = \R::findOne('landing_pages', 'alias = ?', [$alias]);
			if (!$landing_pages) {
				throw new \Exception('Страница не найдена', 404);
			} else {
				$landing_pages_checker = true;
				$category = \R::findOne('category', 'alias = ?', [$landing_pages->category_alias]);
				$category->title = $landing_pages->title;
				$category->content = $landing_pages->content;
				$category->meta_title = $landing_pages->meta_title;
				$category->meta_desc = $landing_pages->meta_desc;
				$category->short_text = $landing_pages->short_text;
				$_filter = $landing_pages->filter;
				if (!$category) {
					throw new \Exception('Страница не найдена', 404);
				}
			}
		} else {
			if(!empty($_GET['filter'])){
				$landing_pages = \R::findOne('landing_pages', 'category_alias = ? AND filter = ?', [$alias, $_GET['filter']]);
				if ($landing_pages) {
					header('HTTP/1.1 301 Moved Permanently');
					header('Location: ' . PATH . '/category/' . $landing_pages->alias);
					exit;
				}
			}
		}

		//категории - прямые потомки
		$children_cats = \R::find('category', "parent_id = ? AND show_cat = '1' ORDER BY position", [$category->id]);
		$breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id, $category->alias);

		$cat_model = new Category();
		$ids = $cat_model->getIds($category->id);
		$ids = !$ids ? $category->id : $ids . $category->id;

		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = App::$app->getProperty('pagination_new');
		$sql_part = '';
		$sql_part_tot = '';
		$filter = $cat_model->getFilter($_filter);
		$sort = $cat_model->getSort();
		if ($sort == 'price' || $sort == 'discount') {
			$_SESSION['sort'] = $sort;
		}
		if ($filter) {
			$cnt = $cat_model->getCountGroups($filter);
			$sql_part .= "AND id IN (SELECT product_id FROM attribute_product WHERE attr_id IN ($filter) GROUP BY product_id HAVING COUNT(product_id) >= $cnt)";
			$sql_part_tot .= "AND prod_id IN (SELECT product_id FROM attribute_product WHERE attr_id IN ($filter) GROUP BY product_id HAVING COUNT(product_id) >= $cnt)";
			$filter_names = \R::find('attribute_value', "id IN ($filter)");
			$filter_meta = $cat_model->getFilterValues($filter_names);
			if ($landing_pages_checker) {
				$filter_meta = null;
			}
		}
//        $total = count(\R::find('cat_product', "cat_id IN ($ids) $sql_part_tot GROUP BY prod_id"));
		$total = count(\R::find('cat_product', "cat_id IN ($ids) $sql_part_tot AND prod_id IN (SELECT id FROM product WHERE status = 1) GROUP BY prod_id"));
//        $total = count(\R::findMulti('cat_product, product', "SELECT * FROM `cat_product` LEFT JOIN product ON cat_product.prod_id = product.id WHERE `cat_id` IN ($ids) $sql_part_tot AND product.status = 1 GROUP BY `prod_id`;"));
		$pagination = new Pagination($page, $perpage, $total);
		$start = $pagination->getStart();
		$ids_products = \R::find('cat_product', "cat_id IN ($ids) GROUP BY prod_id");
		$ids_prod = $cat_model->getprodIds($ids_products);
		if ($ids_prod) {
			if (isset($sort) && !empty($sort)) {
				if ($sort == 'price') {
					$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY $sort LIMIT $start, $perpage");
					$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY $sort");
				} elseif ($sort == 'discount') {
					$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY $sort DESC, position LIMIT $start, $perpage");
					$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY $sort DESC, position");
				} else {
					if ($category->parent_id == 0) {
						$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY all_position LIMIT $start, $perpage");
						$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY all_position");
					} else {
						$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY position LIMIT $start, $perpage");
						$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY position");
					}
				}
			} elseif (!$sort) {
				if (isset($_SESSION['sort']) && !empty($_SESSION['sort'])) {
					$sort_ord = $_SESSION['sort'];
					if ($sort_ord == 'price') {
						$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY $sort_ord LIMIT $start, $perpage");
						$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY $sort_ord");
					} elseif ($sort_ord == 'discount') {
						$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY $sort_ord DESC, position LIMIT $start, $perpage");
						$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY $sort_ord DESC, position");
					} else {
						if ($category->parent_id == 0) {
							$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY all_position LIMIT $start, $perpage");
							$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY all_position");
						} else {
							$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY position LIMIT $start, $perpage");
							$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY position");
						}
					}
					unset($_SESSION['sort']);
				} else {
					if ($category->parent_id == 0) {
						$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY all_position LIMIT $start, $perpage");
						$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY all_position");
					} else {
						$products = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY position LIMIT $start, $perpage");
						$products_flt = \R::find('product', "status = '1' AND id IN ($ids_prod) $sql_part ORDER BY position");
					}
				}
			}

			/*неактивные фильтры - массив*/
			$ids_prods = [];
			foreach ($products_flt as $value) {
				$ids_prods[] = $value['id'];
			}
			$ids_prods = implode(',', $ids_prods);

			$params_array = [];
			$prods_params = \R::getAll("SELECT attr_id FROM attribute_product WHERE product_id IN ($ids_prods)");
			foreach ($prods_params as $value) {
				$params_array[] = $value['attr_id'];
			}
			$params_array = array_unique($params_array);
			/*неактивные фильтры - массив*/

		}


		if ($products && $filter) {
			foreach ($products as $key => $product) {
				$prod_id = $product['id'];
				$attr_ids = '';
				$prod = \R::find('attribute_product', "product_id = $prod_id AND attr_id IN ($filter)");
				foreach ($prod as $item) {
					$attr_ids .= $item['attr_id'] . ',';
				}
				$attr_ids = trim($attr_ids, ', ');
				$prod_gr = \R::find('attribute_value', "id IN ($attr_ids)");
				$groupes = [];
				foreach ($prod_gr as $item) {
					$groupes[] = $item['attr_group_id'];
				}
				$count_gr = count(array_unique($groupes));
				if ($count_gr < $cnt) {
					unset($products[$key]);
				}
			}
		}
		$filter_group = $cat_model->getGroups($category->id);
		$cat_values = $cat_model->getCatValues($filter_group);
		$attrs = $cat_model->getAttrs();
		$groupes = \R::find('groupes', 'category_id = ?', [$category->id]);

		if (($filter && $sort) || $filter && !$sort) {
			if ($this->isAjax()) {
				$this->loadView('filter', compact('unic_text', 'params_array', 'products', 'total', 'pagination', 'filter_meta', 'category', 'filter_group', 'attrs', 'cat_values', 'children_cats', 'sort', 'landing_pages_checker', '_filter'));
			}
		}

		if (!$filter) {
			if ($this->isAjax()) {
				$this->loadView('sort', compact('unic_text', 'params_array', 'products', 'breadcrumbs', 'pagination', 'total', 'category', 'filter_group', 'attrs', 'filter', 'cnt', 'filter_meta', 'cat_values', 'children_cats', 'groupes', 'landing_pages_checker', '_filter'));
			}
		}

		if (isset($_GET['filter']) && !$landing_pages_checker) {
			$this->setMeta($category->title . ' ' . $filter_meta . ' купить в Минске - ' . App::$app->getProperty('shop_name'), 'Купить ' . $category->title . ' ' . $filter_meta . ' в Минске и по всей Беларуси. Бесплатная доставка, официальная гарантия', $category->title . ' ' . $filter_meta, $category->img);
		} else {

			if (empty($category->meta_title) && !$landing_pages_checker) {
				$title = $category->title . ' купить в Минске - ' . App::$app->getProperty('shop_name');
			} else {
				$title = $category->meta_title;
			}

			if (empty($category->meta_desc)) {
				$desc = 'Купить ' . $category->title . ' в Минске и по всей Беларуси. Бесплатная доставка, официальная гарантия';
			} else {
				$desc = $category->meta_desc;
			}

			$this->setMeta($title, $desc, $title, $category->img);
		}
		$this->set(compact('unic_text', 'params_array', 'products', 'breadcrumbs', 'pagination', 'total', 'category', 'filter_group', 'attrs', 'filter', 'cnt', 'filter_meta', 'cat_values', 'children_cats', 'groupes', 'landing_pages_checker', '_filter'));
	}

}
