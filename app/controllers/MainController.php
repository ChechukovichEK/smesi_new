<?php

namespace app\controllers;

use ishop\Cache;

class MainController extends AppController {

    public function indexAction(){
        $hits = \R::find('product', "hit = '1' AND status = '1' ORDER BY hit_position LIMIT 12");
		$sales = \R::find('product', "sale = '1' AND status = '1' ORDER BY sale_position");
		$brands = \R::find('brands', "is_home = '1' ORDER BY sort DESC");
        $slider = \R::findAll('slider', 'ORDER BY position');

		$title = "Интернет-магазин строительных, отделочных материалов, купить с доставкой в Минске и РБ";
		$desc = "Большой ассортимент товаров для строительства и ремонта. Самовывоз со склада в Минске. Доставка по РБ. Оптом и в розницу. Наличный и безналичный расчет. Низкие цены. Акции. Скидки. Распродажи.";

        $this->setMeta($title, $desc, $title, 'logo-map.jpg');
        $this->set(compact('hits', 'sales', 'slider', 'brands'));
    }

}
