<?php

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\Category;
use ishop\App;

class CategoryController extends AppController {

    public function indexAction(){
        $this->setMeta('Список групп товаров');
    }

    public function deleteAction(){
        $id = $this->getRequestID();
        $children = \R::count('category', 'parent_id = ?', [$id]);
        $errors = '';
        if($children){
            $errors .= '<li>Удаление невозможно, в категории есть вложенные категории</li>';
        }
        $products = \R::count('product', 'category_id = ?', [$id]);
        if($products){
            $errors .= '<li>Удаление невозможно, в категории есть товары</li>';
        }
        if($errors){
            $_SESSION['error'] = "<ul>$errors</ul>";
            redirect();
        }
        $category = \R::load('category', $id);
        \R::trash($category);
        $_SESSION['success'] = 'Категория удалена';
        redirect();
    }

    public function addAction(){
        if(!empty($_POST)){
            $category = new Category();
            $data = $_POST;
            $category->load($data);
            $category->getImg();
            if(!$category->validate($data)){
                $category->getErrors();
                redirect();
            }
            if($id = $category->save('category')){
                $alias = AppModel::createAlias('category', 'alias', $data['title'], $id);
                $cat = \R::load('category', $id);
                $cat->alias = $alias;
                \R::store($cat);
                $_SESSION['success'] = 'Категория добавлена';
            }
            redirect();
        }
        $this->setMeta('Новая категория');
    }

    public function addImageAction(){
    if(isset($_GET['upload'])){
        $name = $_POST['name'];
        $category = new Category();
        $category->uploadImg($name);
      }
  }


    public function editAction(){
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $category = new Category();
            $data = $_POST;
            $category->load($data);
            $category->getImg();
            if(!$category->validate($data)){
                $category->getErrors();
                redirect();
            }
            if($category->update('category', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect();
        }
        $id = $this->getRequestID();
        $category = \R::load('category', $id);
        App::$app->setProperty('parent_id', $category->parent_id);
        App::$app->setProperty('cat_id', $category->id);
        App::$app->setProperty('cats', self::getCats());
        $cat_model = new Category();
        $ids = $cat_model->getIds($category->id);
        $ids = !$ids ? $category->id : $ids . $category->id;
        $ids_products = \R::find('cat_product', "cat_id IN ($ids) GROUP BY prod_id");
        $ids_prod = $cat_model->getprodIds($ids_products);
        if($ids_prod){
          if ($category->parent_id == 0) {
            $products = \R::find('product', "status = '1' AND id IN ($ids_prod) ORDER BY all_position");
          } else {
            $products = \R::find('product', "status = '1' AND id IN ($ids_prod) ORDER BY position");
          }

        }
        $filter_group = $cat_model->getGroups($category->id);
        $cat_values = $cat_model->getCatValues($filter_group);
        $attrs = $cat_model->getAttrs();
        $child_cats = \R::find('category', "parent_id = $category->id ORDER BY position");
        $this->setMeta("Редактирование категории {$category->title}");
        $this->set(compact('child_cats', 'category', 'products', 'filter_group', 'cat_values'));
      }

          public function getCats(){
                  $cats = \R::getAssoc("SELECT * FROM category ORDER BY position");
              return $cats;
          }

          public function editpositionAction(){
            if(!empty($_POST)){
              $prod_id = $this->getRequestID();
              $position = $_POST['position'];
              $position_product = \R::load('product', $prod_id);
              $position_product->position = $position;
              \R::store($position_product);
                  $_SESSION['success'] = 'Изменения сохранены';
                  redirect();
          }
        }

        public function SortableAction(){
          if(isset($_POST['masiv'])){
            $pos_new = 1;
            foreach($_POST['masiv'] as $item){
              $res = \R::exec("UPDATE `attribute_value` SET `position`='{$pos_new}' WHERE `id`='{$item}'");
              $pos_new++;
          }
          $_SESSION['success'] = 'Обновлено!';
          redirect();
          }
        }

        public function SortablecatsAction(){
          if(isset($_POST['masiv'])){
            $pos_new = 1;
            foreach($_POST['masiv'] as $item){
              $res = \R::exec("UPDATE `category` SET `position`='{$pos_new}' WHERE `id`='{$item}'");
              $pos_new++;
          }
          $_SESSION['success'] = 'Обновлено!';
          redirect();
          }
        }

      }
