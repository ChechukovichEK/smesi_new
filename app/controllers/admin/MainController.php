<?php

namespace app\controllers\admin;

class MainController extends AppController {

    public function indexAction(){
        $countNewOrders = \R::count('order', "status = 'новый'");
        $countUsers = \R::count('user');
        $countProducts = \R::count('product');
        $countCategories = \R::count('category');
        $countPages = \R::count('pages');
        $this->setMeta('Панель управления');
        $this->set(compact('countNewOrders', 'countCategories', 'countProducts', 'countUsers', 'countPages'));
    }

}
