<?php

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\admin\FilterAttr;
use app\models\admin\FilterGroup;
use ishop\App;
use ishop\libs\Pagination;

class FilterController extends AppController{

    public function attributeAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 35;
        $count = \R::count('attribute_value');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $attrs = \R::getAll("SELECT attribute_value.*, attribute_group.title AS group_title, category.title AS cat FROM attribute_value JOIN attribute_group ON attribute_group.id = attribute_value.attr_group_id JOIN category ON category.id = attribute_group.parent_cat_id ORDER by category.title DESC");
        $attrs_self = \R::getAll("SELECT * FROM attribute_value WHERE attr_group_id = '0'");
        $this->setMeta('Фильтры/Параметры');
        $this->set(compact('attrs', 'attrs_self'));
    }

    public function groupDeleteAction(){
        $id = $this->getRequestID();
        $count = \R::count('attribute_value', 'attr_group_id = ?', [$id]);
        if($count){
            $_SESSION['error'] = 'Удаление невозможно, в группе есть атрибуты';
            redirect();
        }
        \R::exec('DELETE FROM attribute_group WHERE id = ?', [$id]);
        $_SESSION['success'] = 'Удалено';
        redirect();
    }

    public function attributeDeleteAction(){
        $id = $this->getRequestID();
        \R::exec("DELETE FROM attribute_product WHERE attr_id = ?", [$id]);
        \R::exec("DELETE FROM attribute_value WHERE id = ?", [$id]);
        $_SESSION['success'] = 'Удалено';
        redirect();
    }

    public function attributeEditAction(){
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $attr = new FilterAttr();
            $data = $_POST;
            $attr->load($data);
            if(!$attr->validate($data)){
                $attr->getErrors();
                redirect();
            }
            if($attr->update('attribute_value', $id)){
              $alias = AppModel::createAlias('attribute_value', 'alias', $data['value'], $id);
              $cat = \R::load('attribute_value', $id);
              $cat->alias = $alias;
              \R::store($cat);
                $_SESSION['success'] = 'Изменения сохранены';
                redirect();
            }
        }
        $id = $this->getRequestID();
        $attr = \R::load('attribute_value', $id);
        $attrs_group = \R::getAll('SELECT attribute_group.*, category.title AS cat FROM attribute_group JOIN category ON category.id = attribute_group.parent_cat_id');
        $this->setMeta('Редактирование атрибута/параметра');
        $this->set(compact('attr', 'attrs_group'));
    }

    public function attributeAddAction(){
        if(!empty($_POST)){
            $attr = new FilterAttr();
            $data = $_POST;
            $attr->load($data);
            if(!$attr->validate($data)){
                $attr->getErrors();
                redirect();
            }
            if($id = $attr->save('attribute_value', false)){
                $alias = AppModel::createAlias('attribute_value', 'alias', $data['value'], $id);
                $cat = \R::load('attribute_value', $id);
                $cat->alias = $alias;
                \R::store($cat);
                $_SESSION['success'] = 'Атрибут/Параметр добавлен';
                redirect();
            }
        }
        $group = \R::getAll('SELECT attribute_group.*, category.title AS cat FROM attribute_group JOIN category ON category.id = attribute_group.parent_cat_id');
        $this->setMeta('Новый фильтр');
        $this->set(compact('group'));
    }

    public function groupEditAction(){
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $group = new FilterGroup();
            $data = $_POST;
            $group->load($data);
            if(!$group->validate($data)){
                $group->getErrors();
                redirect();
            }
            if($group->update('attribute_group', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
                redirect();
            }
        }
        $id = $this->getRequestID();
        $group = \R::load('attribute_group', $id);
        $this->setMeta("Редактирование группы {$group->title}");
        App::$app->setProperty('parent_cat_id', $group->parent_cat_id);
        $this->set(compact('group'));
    }

    public function groupAddAction(){
        if(!empty($_POST)){
            $group = new FilterGroup();
            $data = $_POST;
            $group->load($data);
            if(!$group->validate($data)){
                $group->getErrors();
                redirect();
            }
            if($group->save('attribute_group', false)){
                $_SESSION['success'] = 'Группа добавлена';
                redirect();
            }
        }
        $this->setMeta('Новая группа фильтров');
    }

    public function attributeGroupAction(){
        $attrs_group = \R::getAll('SELECT attribute_group.*, category.title AS cat FROM attribute_group JOIN category ON category.id = attribute_group.parent_cat_id ORDER by category.title DESC');
        $this->set(compact('attrs_group'));
        $this->setMeta('Группы фильтров');
    }


    /*атрибуты для выпадающего списка*/
      public function FilterAction(){
        $q = isset($_GET['q']) ? $_GET['q'] : '';
        $data['items'] = [];
        $dop_prods = \R::getAssoc("SELECT attribute_value.*, attribute_group.title AS group_title, category.title AS cat FROM attribute_value JOIN attribute_group ON attribute_group.id = attribute_value.attr_group_id JOIN category ON category.id = attribute_group.parent_cat_id WHERE attribute_value.value LIKE '%{$q}%'");
        $dop_prods_self = \R::getAssoc("SELECT * FROM attribute_value WHERE attr_group_id = '0'");
          if($dop_prods){
            $i = 0;
            foreach($dop_prods as $id => $title){
              $data['items'][$i]['id'] = $id;
              $data['items'][$i]['text'] = $title['value'] . ' - ' . $title['group_title'] . '(группа' . $title['cat'] . ')';
              $i++;
            }
          }
          if($dop_prods_self){
            $i = 0;
            foreach($dop_prods_self as $id => $title){
              $data['items'][$i]['id'] = $id;
              $data['items'][$i]['text'] = $title['value'] . ' - САМОСТОЯТЕЛЬНЫЙ ПАРАМЕТР';
              $i++;
            }
          }
        echo json_encode($data);
        die;
      }
    /*атрибуты для выпадающего списка*/

}
