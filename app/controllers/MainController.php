<?php

namespace app\controllers;

use ishop\Cache;

class MainController extends AppController {

    public function indexAction(){
        $hits = \R::find('product', "hit = '1' AND status = '1' ORDER BY hit_position LIMIT 12");
		$sales = \R::find('product', "sale = '1' AND status = '1' ORDER BY sale_position");
		$brands = \R::find('brands', "is_home = '1' ORDER BY sort DESC");
        $slider = \R::findAll('slider', 'ORDER BY position');

        $page_info = \R::getRow('SELECT * FROM `main_page` WHERE id = 1');

		$title = $page_info['title'];
		$desc = $page_info['description'];

        $this->setMeta($title, $desc, $title, 'logo-map.jpg');
        $this->set(compact('hits', 'sales', 'slider', 'brands'));
    }

}
