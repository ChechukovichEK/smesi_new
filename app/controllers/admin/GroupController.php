<?php
namespace app\controllers\admin;
use app\models\admin\ProdGroup;
use app\models\AppModel;
use ishop\App;

class GroupController extends AppController {

  public function productGroupAction(){
      $product_group = \R::getAll('SELECT groupes.*, category.title AS cat FROM groupes JOIN category ON category.id = groupes.category_id');
      $this->set(compact('product_group'));
      $this->setMeta('Доп категории для групп');
  }

  public function productgroupEditAction(){
      if(!empty($_POST)){
          $id = $this->getRequestID(false);
          $group = new ProdGroup();
          $data = $_POST;
          $group->load($data);
          if(!$group->validate($data)){
              $group->getErrors();
              redirect();
          }
          if($group->update('groupes', $id)){
              $alias = AppModel::createAlias('groupes', 'alias', $data['title'], $id);
              $group = \R::load('groupes', $id);
              $group->alias = $alias;
              \R::store($group);
              $_SESSION['success'] = 'Изменения сохранены';
              redirect();
          }
      }
      $id = $this->getRequestID();
      $group = \R::load('groupes', $id);
      $this->setMeta("Редактирование группы {$group->title}");
      App::$app->setProperty('catgroup_id', $group->category_id);
      $this->set(compact('group'));
  }

  public function productgroupAddAction(){
      if(!empty($_POST)){
          $group = new ProdGroup();
          $data = $_POST;
          $group->load($data);
          if(!$group->validate($data)){
              $group->getErrors();
              redirect();
          }
          if($id = $group->save('groupes', false)){
            $alias = AppModel::createAlias('groupes', 'alias', $data['title'], $id);
            $group = \R::load('groupes', $id);
            $group->alias = $alias;
            \R::store($group);
              $_SESSION['success'] = 'Группа добавлена';
              redirect();
          }
      }
      $this->setMeta('Новая группа продуктов');
  }

  public function groupDeleteAction(){
      $id = $this->getRequestID();
      \R::exec('DELETE FROM groupes WHERE id = ?', [$id]);
      if($group_prod = \R::exec('SELECT * FROM groupe_product WHERE groupe_id = ?', [$id])){
        \R::exec('DELETE FROM groupe_product WHERE groupe_id = ?', [$id]);
      }
      $_SESSION['success'] = 'Удалено';
      redirect();
  }
}
?>
