<?php
namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Category;

//use app\widgets\filter\Filter;
use ishop\App;
use ishop\libs\Pagination;

class PageController extends AppController
{

    public function viewAction()
    {
        $alias = $this->route['alias'];
        $page = \R::findOne('pages', 'alias = ?', [$alias]);

        if (empty($page->meta_title)) {
            $title = 'Smesi.by - ' . $page->title;
        } else {
            $title = $page->meta_title;
        }

        if (empty($page->meta_desc)) {
            $desc = 'Smesi.by - ' . $page->title;
        } else {
            $desc = $page->meta_desc;
        }

        if ($alias === 'opt') {
            $this->view = 'wholesale';
        }

        $this->setMeta($title, $desc, $title, 'og_pages.jpg');
        $this->set(compact('page'));

    }
}

?>
