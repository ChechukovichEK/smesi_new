<?php
namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Category;
use ishop\App;
use ishop\libs\Pagination;

class CatalogController extends AppController {

    public function indexAction(){
        $title = "Интернет каталог строительных материалов. Выгодные цены";
        $desc = "Обширный каталог качественных товаров для ремонта и строительства с подробными описаниями и техническими характеристиками. Удобная навигация и фильтры помогут быстро найти нужный продукт.";
        $this->setMeta($title, $desc);
    }
}
?>
