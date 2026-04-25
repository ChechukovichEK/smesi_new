<?php
namespace app\controllers\admin;

use app\models\admin\Pages;
use app\models\AppModel;
use ishop\App;

class PagesController extends AppController{

  public function indexAction(){
    $pages = \R::findAll('pages', 'ORDER BY position');
    $this->setMeta('Страницы');
    $this->set(compact('pages'));
  }

  public function editAction(){
    if(!empty($_POST)){
      $id = $this->getRequestID(false);
      $page = new Pages();
      $data = $_POST;
      $page->load($data);
      if(!$page->validate($data)){
        $page->getErrors();
        redirect();
      }
      if($page->update('pages', $id)){
        $_SESSION['success'] = 'Изменения сохранены';
        redirect();
      }
    }
      $id = $this->getRequestID();
      $page = \R::load('pages', $id);
      $this->setMeta("Редактирование страницы {$page->title}");
      $this->set(compact('page'));
  }

  public function addAction(){
    if(!empty($_POST)){
      $page = new Pages();
      $data = $_POST;
      $page->load($data);
      if(!$page->validate($data)){
        $page->getErrors();
        $_SESSION['pages-data'] = $data;
        redirect();
      }
      if($id = $page->save('pages')){
        $alias = AppModel::createAlias('pages', 'alias', $data['title'], $id);
        $p = \R::load('pages', $id);
        $p->alias = $alias;
        \R::store($p);
        $_SESSION['success'] = 'Страница добавлена';
      }
      redirect();
    }
    $this->setMeta("Добавление страницы");
  }

  public function deleteAction(){
    $id = $this->getRequestID();
    $page = \R::load('pages', $id);
    \R::trash($page);
    $_SESSION['success'] = 'Страница удалена';
    redirect();
  }

}
