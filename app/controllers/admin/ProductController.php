<?php

namespace app\controllers\admin;

use app\models\admin\Product;
use app\models\AppModel;
use ishop\App;
use ishop\libs\Pagination;

class ProductController extends AppController {

    public function indexAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 35;
        $count = \R::count('product');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $products = \R::getAll("SELECT product.*, category.title AS cat FROM product JOIN category ON category.id = product.category_id ORDER BY product.title LIMIT $start, $perpage");
        $this->setMeta('Список товаров');
        $this->set(compact('products', 'pagination', 'count'));
    }

    public function hideAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 35;
        $count = \R::count('product', 'status = 0');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $products = \R::getAll("SELECT product.*, category.title AS cat FROM product JOIN category ON category.id = product.category_id WHERE status = '0' ORDER BY product.title LIMIT $start, $perpage");
        $this->setMeta('Скрытые товары');
        $this->set(compact('products', 'pagination', 'count'));
    }

    public function hitAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 35;
        $count = \R::count('product', "hit = '1'");
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $products = \R::getAll("SELECT product.*, category.title AS cat FROM product JOIN category ON category.id = product.category_id WHERE hit = '1' ORDER BY product.hit_position LIMIT $start, $perpage");
        $this->setMeta('Товары - хиты');
        $this->set(compact('products', 'pagination', 'count'));
    }

    public function nothasAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 35;
        $count = \R::count('product', "is_have = '0'");
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $products = \R::getAll("SELECT product.*, category.title AS cat FROM product JOIN category ON category.id = product.category_id WHERE is_have = '0' ORDER BY product.position LIMIT $start, $perpage");
        $this->setMeta('Нет в наличии');
        $this->set(compact('products', 'pagination', 'count'));
    }

    public function saleAction(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 35;
        $count = \R::count('product', "sale = '1'");
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $products = \R::getAll("SELECT product.*, category.title AS cat FROM product JOIN category ON category.id = product.category_id WHERE sale = '1' ORDER BY product.sale_position LIMIT $start, $perpage");
        $this->setMeta('Распродажа');
        $this->set(compact('products', 'pagination', 'count'));
    }

    public function addImageAction(){
        if(isset($_GET['upload'])){
            $name = $_POST['name'];
            $product = new Product();
            $product->uploadImg($name);
        }
    }

    public function editAction(){
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $product = new Product();
            $data = $_POST;
            $product->load($data);
            $product->attributes['status'] = $product->attributes['status'] ? '1' : '0';
            $product->attributes['hit'] = $product->attributes['hit'] ? '1' : '0';
            $product->attributes['sale'] = $product->attributes['sale'] ? '1' : '0';
            $product->attributes['is_have'] = $product->attributes['is_have'] ? '1' : '0';
            $product->getImg();
            if(!$product->validate($data)){
                $product->getErrors();
                redirect();
            }
            if($product->update('product', $id)){
                $product->editDopCats($id, $data);
                $product->editFilter($id, $data);
                $product->editGroup($id, $data);
                $product->editRelatedProduct($id, $data);
                $product->saveGallery($id);
                $_SESSION['success'] = 'Изменения сохранены';
                redirect();
            }
        }
        $id = $this->getRequestID();
        $product = \R::load('product', $id);
        $dop_cats = \R::getAll("SELECT cat_product.cat_id, category.title FROM cat_product JOIN category ON cat_product.cat_id = category.id WHERE cat_product.prod_id = ?", [$id]);
        $cat_ids = null;
        foreach($dop_cats as $item){
          $cat_ids .= $item['cat_id'] . ',';
        }
        $cat_ids = trim ($cat_ids, ',');
        if ($cat_ids) {
          $nav_groupes = \R::find('category', "id IN ($cat_ids)");
          $groupes = \R::find('groupes', "category_id IN ($cat_ids)");
          $filter_groups = \R::getAssoc("SELECT id, title FROM attribute_group WHERE parent_cat_id IN ($cat_ids)");
        }

        $parent_groupes = \R::getAssoc("SELECT groupe_product.*, groupes.title FROM  groupe_product JOIN groupes ON groupe_product.groupe_id = groupes.id WHERE product_id = '$product->id'");
        $data = \R::getAssoc('SELECT * FROM attribute_value');
        $attrs = [];
        foreach($data as $k => $v){
            $attrs[$v['attr_group_id']][$k] = $v['value'];
        }
        App::$app->setProperty('parent_id', $product->category_id);
        $nav_cat = \R::findOne('category', "id = $product->category_id");
        $filter = \R::getCol('SELECT attr_id FROM attribute_product WHERE product_id = ?', [$id]);
        //параметры товара
          $prod_params = \R::getAll("SELECT * FROM attribute_product JOIN attribute_value ON attribute_value.id = attribute_product.attr_id WHERE attribute_product.product_id = ?", [$product->id]);
        $related_product = \R::getAll("SELECT related_product.related_id, product.title FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ?", [$id]);
        $gallery = \R::getCol('SELECT img FROM gallery WHERE product_id = ?', [$id]);
        $this->setMeta("Редактирование товара {$product->title}");
        $this->set(compact('prod_params', 'product', 'filter', 'filter_self', 'related_product', 'gallery', 'filter_groups', 'attrs', 'parent_groupes', 'groupes', 'dop_cats', 'nav_groupes', 'cat_ids', 'id', 'nav_cat'));
    }

    public function copyAction(){
      if(!empty($_POST)){
        $prod_id = $this->getRequestID(false);
        $product_f = \R::load('product', $prod_id);
        $img = $product_f->img;
          $product = new Product();
          $data = $_POST;
          $product->load($data);
          $product->attributes['status'] = $product->attributes['status'] ? '1' : '0';
          $product->attributes['hit'] = $product->attributes['hit'] ? '1' : '0';
          $product->attributes['sale'] = $product->attributes['sale'] ? '1' : '0';
          $product->attributes['is_have'] = $product->attributes['is_have'] ? '1' : '0';
          if(!$product->validate($data)){
              $product->getErrors();
              redirect();
          }
          if($id = $product->save('product')){
              $alias = AppModel::createAlias('product', 'alias', $data['title'], $id);
              $p = \R::load('product', $id);
              $p->alias = $alias;
              $p->img = $img;
              \R::store($p);
              $product->editDopCats($id, $data);
              $product->editFilter($id, $data);
              $product->editGroup($id, $data);
              $product->editRelatedProduct($id, $data);
              $_SESSION['success'] = 'Товар добавлен';
              }
              redirect();
      }
      $prod_id = $this->getRequestID();
      $product = \R::load('product', $prod_id);
      $dop_cats = \R::getAll("SELECT cat_product.cat_id, category.title FROM cat_product JOIN category ON cat_product.cat_id = category.id WHERE cat_product.prod_id = ?", [$prod_id]);
      $cat_ids = null;
      foreach($dop_cats as $item){
        $cat_ids .= $item['cat_id'] . ',';
      }
      $cat_ids = trim ($cat_ids, ',');
      $nav_groupes = \R::find('category', "id IN ($cat_ids)");
      $groupes = \R::find('groupes', "category_id IN ($cat_ids)");
      $parent_groupes = \R::getAssoc("SELECT groupe_product.*, groupes.title FROM  groupe_product JOIN groupes ON groupe_product.groupe_id = groupes.id WHERE product_id = '$product->id'");
      $filter_groups = \R::getAssoc("SELECT id, title FROM attribute_group WHERE parent_cat_id IN ($cat_ids)");
      $data = \R::getAssoc('SELECT * FROM attribute_value');
      $attrs = [];
      foreach($data as $k => $v){
          $attrs[$v['attr_group_id']][$k] = $v['value'];
      }
      App::$app->setProperty('parent_id', $product->category_id);
      $nav_cat = \R::findOne('category', "id = $product->category_id");

      $filter = \R::getCol('SELECT attr_id FROM attribute_product WHERE product_id = ?', [$prod_id]);
      //параметры товара
        $prod_params = \R::getAll("SELECT * FROM attribute_product JOIN attribute_value ON attribute_value.id = attribute_product.attr_id WHERE attribute_product.product_id = ?", [$product->id]);
      $related_product = \R::getAll("SELECT related_product.related_id, product.title FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ?", [$prod_id]);
      $gallery = \R::getCol('SELECT img FROM gallery WHERE product_id = ?', [$prod_id]);
      $this->setMeta("Копирование товара {$product->title}");
      $this->set(compact('prod_params', 'product', 'filter', 'related_product', 'gallery', 'filter_groups', 'attrs', 'parent_groupes', 'groupes', 'dop_cats', 'nav_groupes', 'cat_ids', 'prod_id', 'nav_cat'));
  }

    public function deleteAction(){
    $id = $this->getRequestID();
    $related_product = \R::getCol('SELECT related_id FROM related_product WHERE product_id = ?', [$id]);
    if(!empty($related_product)){
        \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);
      }
    $cat_prods = \R::getCol('SELECT * FROM cat_product WHERE prod_id = ?', [$id]);
    if(!empty($cat_prods)){
        \R::exec("DELETE FROM cat_product WHERE prod_id = ?", [$id]);
    }
    // параметры/фильтры
    $params_prods = \R::getCol('SELECT * FROM attribute_product WHERE product_id = ?', [$id]);
    if(!empty($params_prods)){
        \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
    }

    // группы товаров по параметрам
    $params_groups = \R::getCol('SELECT * FROM paramgroup_product WHERE prod_id = ?', [$id]);
    if(!empty($params_groups)){
        \R::exec("DELETE FROM paramgroup_product WHERE prod_id = ?", [$id]);
    }

    //корзина
    $cart_prods = \R::getCol('SELECT * FROM cart WHERE product_id = ?', [$id]);
    if(!empty($cart_prods)){
        \R::exec("DELETE FROM cart WHERE product_id = ?", [$id]);
    }

    //галерея
    $prod_gallery = \R::getCol('SELECT * FROM gallery WHERE product_id = ?', [$id]);
    if(!empty($prod_gallery)){
        \R::exec("DELETE FROM gallery WHERE product_id = ?", [$id]);
    }

    $product = \R::load('product', $id);
    \R::trash($product);
    $_SESSION['success'] = 'Товар удален';
    redirect(ADMIN . '/category/edit?id=' . $product->category_id);
  }

    public function addAction(){
        if(!empty($_POST)){
            $product = new Product();
            $data = $_POST;
            $product->load($data);
            $product->attributes['status'] = $product->attributes['status'] ? '1' : '0';
            $product->attributes['hit'] = $product->attributes['hit'] ? '1' : '0';
            $product->attributes['sale'] = $product->attributes['sale'] ? '1' : '0';
            $product->attributes['is_have'] = $product->attributes['is_have'] ? '1' : '0';
            $product->getImg();

            if(!$product->validate($data)){
                $product->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }

            if($id = $product->save('product')){
                $product->saveGallery($id);
                $alias = AppModel::createAlias('product', 'alias', $data['title'], $id);
                $p = \R::load('product', $id);
                $p->alias = $alias;
                \R::store($p);
                $product->editDopCats($id, $data);
                $product->editFilter($id, $data);
                $product->editGroup($id, $data);
                $product->editRelatedProduct($id, $data);
                $_SESSION['success'] = 'Товар добавлен';
            }
            redirect();
        }

        $this->setMeta('Новый товар');
    }

    public function relatedProductAction(){
        /*$data = [
            'items' => [
                [
                    'id' => 1,
                    'text' => 'Товар 1',
                ],
                [
                    'id' => 2,
                    'text' => 'Товар 2',
                ],
            ]
        ];*/

        $q = isset($_GET['q']) ? $_GET['q'] : '';
        $data['items'] = [];
        $products = \R::getAssoc('SELECT id, title FROM product WHERE title LIKE ?', ["%{$q}%"]);
        if($products){
            $i = 0;
            foreach($products as $id => $title){
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
        }
        echo json_encode($data);
        die;
    }


    public function relatedCatsAction(){
        $q = isset($_GET['q']) ? $_GET['q'] : '';
        $cat_ids = $_GET['cat_ids'];
        $product = new Product();
        //$cat_ids = $product->getcatIds($cat_id);
        $data['items'] = [];
        $cats = \R::getAssoc("SELECT id, title FROM groupes WHERE category_id IN ($cat_ids) AND title LIKE ?", ["%{$q}%"]);
        if($cats){
            $i = 0;
            foreach($cats as $id => $title){
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
        }
        echo json_encode($data);
        die;
    }

    public function relatedDopcatsAction(){
        $q = isset($_GET['q']) ? $_GET['q'] : '';
        $data['items'] = [];
        $dop_cats = \R::getAssoc("SELECT id, title FROM category WHERE title LIKE ?", ["%{$q}%"]);
        if($dop_cats){
            $i = 0;
            foreach($dop_cats as $id => $title){
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
        }
        echo json_encode($data);
        die;
    }


    public function deleteImgAction(){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $src = isset($_POST['src']) ? $_POST['src'] : null;
            if(!$id || !$src){
                return;
            }
            if(\R::exec("UPDATE product SET img = 'no-foto-prod.jpg' WHERE id = ? AND img = ?", [$id, $src])){
                @unlink(WWW . "/images/$src");
                exit('1');
            }
            if(\R::exec("UPDATE category SET img = 'no-foto-prod.jpg' WHERE id = ? AND img = ?", [$id, $src])){
                @unlink(WWW . "/images/$src");
                exit('1');
            }
            if(\R::exec("UPDATE category SET icon = 'no-foto-prod.jpg' WHERE id = ? AND icon = ?", [$id, $src])){
                @unlink(WWW . "/images/$src");
                exit('1');
            }
            if(\R::exec("UPDATE articles SET img = 'no-foto-prod.jpg' WHERE id = ? AND img = ?", [$id, $src])){
                @unlink(WWW . "/images/$src");
                exit('1');
            }

            if(\R::exec("DELETE FROM gallery WHERE product_id = ? AND img = ?", [$id, $src])){
                @unlink(WWW . "/images/$src");
                exit('1');
            }
            return;
        }

    public function getfiltercatAction(){
      $cat_id = !empty($_GET['cat_id']) ? $_GET['cat_id'] : null;
      $prod = !empty($_GET['prod']) ? $_GET['prod'] : null;
      $prod_inf = \R::findOne('product', "id = ($prod)");
      $product = new Product();
      if(isset($cat_id) && !empty($cat_id)){
      $cat_ids = $product->getcatIds($cat_id);
    }
      if(isset($cat_ids) && !empty($cat_ids)){
        $filter_groups = \R::getAssoc("SELECT id, title FROM attribute_group WHERE parent_cat_id IN ($cat_ids)");
        $nav_groupes = \R::find('category', "id IN ($cat_ids)");
        $groupes = \R::find('groupes', "category_id IN ($cat_ids)");
        $parent_groupes = \R::getAssoc("SELECT groupe_product.*, groupes.title FROM groupe_product JOIN groupes ON groupe_product.groupe_id = groupes.id WHERE product_id = '$prod_inf->id'");
      }
      $filter = \R::getCol('SELECT attr_id FROM attribute_product WHERE product_id = ?', [$prod]);
      $data = \R::getAssoc('SELECT * FROM attribute_value');
      $attrs = [];
      foreach($data as $k => $v){
          $attrs[$v['attr_group_id']][$k] = $v['value'];
      }
      if($this->isAjax()){
          $this->loadView('add_filt', compact('prod_inf', 'filter_groups', 'attrs', 'groupes', 'cat_id', 'cat_ids', 'nav_groupes', 'filter', 'parent_groupes'));
      }
    }

    public function getfiltercataddAction(){
      $cat_id = !empty($_GET['cat_id']) ? $_GET['cat_id'] : null;
      $product = new Product();
      if(isset($cat_id) && !empty($cat_id)){
      $cat_ids = $product->getcatIds($cat_id);
    }
      if(isset($cat_ids) && !empty($cat_ids)){
        $filter_groups = \R::getAssoc("SELECT id, title FROM attribute_group WHERE parent_cat_id IN ($cat_ids)");
        $nav_groupes = \R::find('category', "id IN ($cat_ids)");
        $groupes = \R::find('groupes', "category_id IN ($cat_ids)");
      }
      $data = \R::getAssoc('SELECT * FROM attribute_value');
      $attrs = [];
      foreach($data as $k => $v){
          $attrs[$v['attr_group_id']][$k] = $v['value'];
      }
      if($this->isAjax()){
          $this->loadView('add_filtadd', compact('filter_groups', 'attrs', 'groupes', 'cat_id', 'cat_ids', 'nav_groupes'));
      }
    }

    public function SortableAction(){
      if(isset($_POST['masiv'])){
        $pos_new = 1;
        foreach($_POST['masiv'] as $item){
          $res = \R::exec("UPDATE `product` SET `position`='{$pos_new}' WHERE `id`='{$item}'");
          $pos_new++;
      }
      $_SESSION['success'] = 'Обновлено!';
      redirect();
      }
    }

    public function SortableparentAction(){
      if(isset($_POST['masiv'])){
        $pos_new = 1;
        foreach($_POST['masiv'] as $item){
          $res = \R::exec("UPDATE `product` SET `all_position`='{$pos_new}' WHERE `id`='{$item}'");
          $pos_new++;
      }
      $_SESSION['success'] = 'Обновлено!';
      redirect();
      }
    }

    //акции сортировка
    public function SalesortableAction(){
      if(isset($_POST['masiv'])){
        $pos_new = 1;
        foreach($_POST['masiv'] as $item){
          $res = \R::exec("UPDATE `product` SET `sale_position`='{$pos_new}' WHERE `id`='{$item}'");
          $pos_new++;
      }
      $_SESSION['success'] = 'Обновлено!';
      redirect();
      }
    }

    //хиты сортировка
    public function HitsortableAction(){
      if(isset($_POST['masiv'])){
        $pos_new = 1;
        foreach($_POST['masiv'] as $item){
          $res = \R::exec("UPDATE `product` SET `hit_position`='{$pos_new}' WHERE `id`='{$item}'");
          $pos_new++;
      }
      $_SESSION['success'] = 'Обновлено!';
      redirect();
      }
    }

    public function edithaveAction(){
      if(!empty($_POST)){
        $prod_id = $this->getRequestID();
        if (isset($_POST['is_have'])) {
          $is_have = '1';
        } else {
          $is_have = '0';
        }
        $product = \R::load('product', $prod_id);
        $product->is_have = $is_have;
        \R::store($product);
            $_SESSION['success'] = 'Изменения сохранены';
            redirect();
      }
    }

    public function editstatusAction(){
      if(!empty($_POST)){
        $prod_id = $this->getRequestID();
        if (isset($_POST['status'])) {
          $status = '1';
        } else {
          $status = '0';
        }
        $product = \R::load('product', $prod_id);
        $product->status = $status;
        \R::store($product);
            $_SESSION['success'] = 'Изменения сохранены';
            redirect();
      }
    }

    public function editsaleAction(){
      if(!empty($_POST)){
        $prod_id = $this->getRequestID();
        if (isset($_POST['sale'])) {
          $sale = '1';
        } else {
          $sale = '0';
        }
        $product = \R::load('product', $prod_id);
        $product->sale = $sale;
        \R::store($product);
            $_SESSION['success'] = 'Изменения сохранены';
            redirect();
      }
    }

    public function edithitAction(){
      if(!empty($_POST)){
        $prod_id = $this->getRequestID();
        if (isset($_POST['hit'])) {
          $hit = '1';
        } else {
          $hit = '0';
        }
        $product = \R::load('product', $prod_id);
        $product->hit = $hit;
        \R::store($product);
            $_SESSION['success'] = 'Изменения сохранены';
            redirect();
      }
    }


}
