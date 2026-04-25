<?php
namespace app\controllers;
use ishop\App;

class SchoolController extends AppController {

    public function indexAction(){
      $schools = \R::findAll('articles', 'ORDER BY position');
      $this->setMeta('Smesi.by - школа ремонта', '[Smesi.by - школа ремонта] ➨ Доставка. Официальная гарантия. Самые низкие цены ➨ Заходите!');
    }

    public function viewAction(){
    $alias = $this->route['alias'];
    $school  = \R::findOne( 'articles', ' alias = ? ', [$alias]);
    $this->setMeta($school->title . ' - Smesi.by', $school->title . ' школа ремонта Smesi.by', $school->title, $school->img);
    $this->set(compact('school'));
  }
}
?>
