<?php

namespace app\models;

use ishop\App;

class Category extends AppModel {

    public $attributes = [
        'title' => '',
        'parent_id' => '',
        'position' => '',
        'short_text' => '',
        'content' => '',
		'meta_title' => '',
		'meta_desc' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
        ]
    ];

    public function getIds($id){
        $cats = App::$app->getProperty('cats');
        $ids = null;
        foreach($cats as $k => $v){
            if($v['parent_id'] == $id){
                $ids .= $k . ',';
                $ids .= $this->getIds($k);
            }
        }
        return $ids;
    }

    public function getprodIds($ids_products){
        $ids_prod = null;
        foreach($ids_products as $v){
                $ids_prod .= $v['prod_id'] . ',';
            }
        $ids_prod = trim ($ids_prod, ',');
        return $ids_prod;
    }

    public function getGroups($id){
      return \R::getAssoc("SELECT id, title FROM attribute_group WHERE parent_cat_id = '$id'");
    }

    public static function getAttrs(){
        $data = \R::getAssoc('SELECT * FROM attribute_value ORDER BY position');
        $attrs = [];
        foreach($data as $k => $v){
            $attrs[$v['attr_group_id']][$k] = $v['value'];
        }
        return $attrs;
    }

    public function getCatAttrs($cat_id){
        $cat_attrs = \R::getAssoc("SELECT * FROM attribute_value WHERE attr_group_id = '$cat_id' ORDER BY position");
        return $cat_attrs;
    }

  public function getCatValues($filter_group){
    $cat_values = [];
    foreach($filter_group as $group_id => $group_item){
      $cat_attrs = $this->getCatAttrs($group_id);
        foreach($cat_attrs as $id => $cat_attr){
          $cat_values[$id] = $cat_attr;
        }
    }
    return $cat_values;
  }
	
	public function getFilter($_filter = null)
	{
		$filter = [];
		
		// Фильтр из лендинга
		if (!empty($_filter)) {
			$clean = trim(preg_replace("#[^\d,]+#", '', $_filter), ',');
			if ($clean !== '') {
				$filter = array_merge($filter, explode(',', $clean));
			}
		}
		
		// Фильтр из GET
		if (!empty($_GET['filter'])) {
			
			// Если вдруг прилетел массив — склеиваем
			$get_filter = $_GET['filter'];
			if (is_array($get_filter)) {
				$get_filter = implode(',', $get_filter);
			}
			
			$clean = trim(preg_replace("#[^\d,]+#", '', $get_filter), ',');
			if ($clean !== '') {
				$filter = array_merge($filter, explode(',', $clean));
			}
		}
		
		// Убираем пустые значения и дубли
		$filter = array_unique(array_filter($filter));
		
		return !empty($filter) ? $filter : null;
	}
	
	public function getSort(){
		if (isset($_GET['sort']) && $_GET['sort'] !== '' && $_GET['sort'] !== 'default') {
			return $_GET['sort'];
		}
		return 'hit';
	}
	
	public function getFilterValues($filter_names){
    $filter_values = '';
    foreach ($filter_names as $item) {
      $filter_values .=$item->value . ', ';
      }
      $filter_values = trim($filter_values, ', ');
      return $filter_values;
    }
	
	public static function getCountGroups($filter)
	{
		// Если фильтра нет — 0 групп
		if (empty($filter)) {
			return 0;
		}
		
		// Если вдруг прилетела строка — превращаем в массив
		if (!is_array($filter)) {
			$filter = explode(',', $filter);
		}
		
		$filter = array_filter($filter);
		
		$attrs = self::getAttrs();
		$data = [];
		
		foreach ($attrs as $groupId => $items) {
			foreach ($items as $attrId => $value) {
				if (in_array($attrId, $filter)) {
					$data[] = $groupId;
					break;
				}
			}
		}
		
		return count($data);
	}
	
	
	public function getImg(){
      if(!empty($_SESSION['base-img'])){
          $this->attributes['img'] = $_SESSION['base-img'];
          unset($_SESSION['base-img']);
      }
      if(!empty($_SESSION['icon-img'])){
          $this->attributes['icon'] = $_SESSION['icon-img'];
          unset($_SESSION['icon-img']);
      }
  }

  public function uploadImg($name){
        $uploaddir = WWW . '/images/';
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png", "image/svg+xml"); // массив допустимых расширений
        if($_FILES[$name]['size'] > 1048576){
            $res = array("error" => "Ошибка! Максимальный вес файла - 1 Мб!");
            exit(json_encode($res));
        }
        if($_FILES[$name]['error']){
            $res = array("error" => "Ошибка! Возможно, файл слишком большой.");
            exit(json_encode($res));
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = array("error" => "Допустимые расширения - .gif, .jpg, .png, .svg");
            exit(json_encode($res));
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            if($name == 'base-img'){
                $_SESSION['base-img'] = $new_name;
            }
            if($name == 'icon-img'){
                $_SESSION['icon-img'] = $new_name;
            }
            //self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
            $res = array("file" => $new_name);
            exit(json_encode($res));
        }
    }

}
