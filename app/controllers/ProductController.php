<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Product;
use ishop\App;

class ProductController extends AppController {

    public function viewAction(){
        $alias = $this->route['alias'];
        $product = \R::findOne('product', "alias = ?", [$alias]);
        $prod_id = $product->id;
        if(!$product){
            throw new \Exception('Страница не найдена', 404);
        }

        // хлебные крошки
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->alias, $product->title);

        // связанные товары
        $related = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ? AND product.status = '1'", [$product->id]);

        // запись в куки запрошенного товара
        $p_model = new Product();
        $p_model->setRecentlyViewed($product->id);

        // просмотренные товары
        $r_viewed = $p_model->getRecentlyViewed();
        $recentlyViewed = null;
        if($r_viewed){
            $recentlyViewed = \R::find('product', 'id IN (' . \R::genSlots($r_viewed) . ') GROUP BY id LIMIT 4', $r_viewed);
        }

        // галерея
        $gallery = \R::findAll('gallery', 'product_id = ?', [$product->id]);

        $categoryProducts = \R::find('product',
            "category_id = ? AND status = '1' AND id != ? ORDER BY RAND() LIMIT 4",
            [$product->category_id, $product->id]
        );

        //группы параметров
        $param_groups = \R::find('paramgroup_product', "prod_id = ?", [$prod_id]);
        $param_info = $p_model->getParamInfo($param_groups);

		$meta_title = $product->title . ' купить в Минске - '.App::$app->getProperty('shop_name');
		$meta_desc = $product->title . ' по лучшей цене. Доставка по Беларуси. Склад в Минске. Опт и розница.  Акции.';

		if (!empty($product->meta_title)) {
			$meta_title = $product->meta_title;
		}

		if (!empty($product->meta_desc)) {
			$meta_desc = $product->meta_desc;
		}

		$brand = \R::findOne('brands', 'title = ?', [$product->manufacturer]);

        $this->setMeta($meta_title, $meta_desc, $product->title, $product->img);
        $this->set(compact('product', 'related', 'gallery', 'categoryProducts', 'recentlyViewed', 'breadcrumbs', 'brand'));
    }

}
