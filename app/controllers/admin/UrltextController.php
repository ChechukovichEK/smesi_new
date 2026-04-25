<?php
namespace app\controllers\admin;

use app\models\admin\Urltext;
use app\models\AppModel;
use stroy\App;

class UrltextController extends AppController{

  public function indexAction(){
    $url_text = \R::findAll('url_text');
    $this->setMeta('Уникальный текст для страниц');
    $this->set(compact('url_text'));
  }

  public function editAction(){
    if(!empty($_POST)){
      $id = $this->getRequestID(false);
      $url = new Urltext();
      $_POST['url'] = trim($_POST['url'], ',\%2C');
      $data = $_POST;
      $url->load($data);
      if(!$url->validate($data)){
        $url->getErrors();
        redirect();
      }
      if($url->update('url_text', $id)){
        $_SESSION['success'] = 'Изменения сохранены';
        redirect();
      }
    }
      $id = $this->getRequestID();
      $url = \R::load('url_text', $id);
      $this->setMeta("Редактирование уникального текста для страницы {$url->url}");
      $this->set(compact('url'));
  }

  public function addAction(){
    if(!empty($_POST)){
      $url = new Urltext();
      $_POST['url'] = trim($_POST['url'], ',\%2C');
      $data = $_POST;
      $url->load($data);
      if(!$url->validate($data)){
        $url->getErrors();
        $_SESSION['url-data'] = $data;
        redirect();
      }
      if($id = $url->save('url_text', false)){
        $_SESSION['success'] = 'Позиция добавлена';
      }
      redirect();
    }
    $this->setMeta("Добавление уникального текста для страницы");
  }

  public function deleteAction(){
    $id = $this->getRequestID();
    $url = \R::load('url_text', $id);
    \R::trash($url);
    $_SESSION['success'] = 'Позиция удалена';
    redirect();
  }

}
