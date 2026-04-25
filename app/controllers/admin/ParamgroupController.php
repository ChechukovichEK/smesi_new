<?php

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\admin\ParamsGroup;
use ishop\App;
use ishop\libs\Pagination;

class ParamgroupController extends AppController{

  public function groupsViewAction(){
    $param_groups = \R::find('params_group_info');
    $this->set(compact('param_groups'));
      $this->setMeta('Группы параметров');
  }

  public function groupAddAction(){
    if(!empty($_POST)){
      $param = new ParamsGroup();
      $data = $_POST;
      $param->load($data);
      if(!$param->validate($data)){
          $param->getErrors();
          redirect();
      }
      if($id = $param->save('params_group_info', false)){
          $param->editGroupParams($id, $data);
          $param->editParamProds($id, $data);
          $_SESSION['success'] = 'Группа параметров добавлена';
          redirect(ADMIN . '/paramgroup/group-edit?id=' . $id);
      }
    }
    $this->setMeta('Новая группа параметров');
  }

    public function groupEditAction(){
        if(!empty($_POST)){
          $id = $this->getRequestID(false);
          $color = new ParamsGroup();
          $data = $_POST;
          $color->load($data);
          if(!$color->validate($data)){
              $color->getErrors();
              redirect();
          }
          if($color->update('params_group_info', $id)){
              $color->editGroupParams($id, $data);
              $color->editParamProds($id, $data);
              $_SESSION['success'] = 'Изменения сохранены!';
              redirect();
          }
      }
        $id = $this->getRequestID();
        $group_inf = \R::load('params_group_info', $id);
        $dop_params = \R::getAll("SELECT param_group.param_id, attribute_value.* FROM param_group JOIN attribute_value ON param_group.param_id = attribute_value.id WHERE param_group.group_id = ?", [$id]);
        $dop_prods = \R::getAll("SELECT paramgroup_product.prod_id, product.title FROM paramgroup_product JOIN product ON paramgroup_product.prod_id = product.id WHERE paramgroup_product.group_id = ?", [$id]);
        $this->setMeta("Редактирование группы параметров {$group_inf->title}");
        $this->set(compact('group_inf', 'dop_params', 'dop_prods'));
    }

    public function deleteGroupAction(){
    $id = $this->getRequestID();
    $errors = '';
    $group_params = \R::getCol('SELECT * FROM param_group WHERE group_id = ?', [$id]);
    $param_products = \R::getCol('SELECT * FROM paramgroup_product WHERE group_id = ?', [$id]);
    if(!empty($group_params || !empty($param_products))){
      $errors .= '<li>Удаление невозможно, т. к. в группе есть товары либо параметры</li>';
    }
    if($errors){
        $_SESSION['error'] = "<ul>$errors</ul>";
        redirect();
    }
    $param = \R::load('params_group_info', $id);
    \R::trash($param);
    $_SESSION['success'] = 'Группа удалена';
    redirect(ADMIN . '/paramgroup/groups-view');
    }

}
