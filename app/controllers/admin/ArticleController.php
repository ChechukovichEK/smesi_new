<?php
namespace app\controllers\admin;

use app\models\admin\Article;
use app\models\AppModel;
use stroy\App;

class ArticleController extends AppController{

  public function indexAction(){
    $news = \R::findAll('articles');
    $this->setMeta('Статьи');
    $this->set(compact('news'));
  }

  public function editAction(){
    if(!empty($_POST)){
      $id = $this->getRequestID(false);
      $new = new Article();
      $data = $_POST;
      $new->load($data);
      $new->getImg();
      if(!$new->validate($data)){
        $new->getErrors();
        redirect();
      }
      if($new->update('articles', $id)){
        $_SESSION['success'] = 'Изменения сохранены';
        redirect();
      }
    }
      $id = $this->getRequestID();
      $new = \R::load('articles', $id);
      $this->setMeta("Редактирование статьи {$new->title}");
      $this->set(compact('new'));
  }

  public function addAction(){
    if(!empty($_POST)){
      $new = new Article();
      $data = $_POST;
      $new->load($data);
      $new->getImg();
      if(!$new->validate($data)){
        $new->getErrors();
        $_SESSION['news-data'] = $data;
        redirect();
      }
      if($id = $new->save('articles')){
        $alias = AppModel::createAlias('articles', 'alias', $data['title'], $id);
        $p = \R::load('articles', $id);
        $p->alias = $alias;
        \R::store($p);
        $_SESSION['success'] = 'Новость добавлена';
      }
      redirect();
    }
    $this->setMeta("Добавление новости");
  }

  public function deleteAction(){
    $id = $this->getRequestID();
    $new = \R::load('articles', $id);
    \R::trash($new);
    $_SESSION['success'] = 'Новость удалена';
    redirect();
  }

  public function addImageAction(){
    if(isset($_GET['upload'])){
        $name = $_POST['name'];
        $new = new Article();
        $new->uploadImg($name);
      }
  }
}
