<?php

namespace app\models\admin;

use app\models\AppModel;

class Product extends AppModel {

    public $attributes = [
        'title' => '',
        'position' => '',
        'category_id' => '',
        'price' => '',
        'price_dis' => '',
        'price_master' => '',
        'price_opt' => '',
        'old_price' => '',
        'content' => '',
        'status' => '',
        'hit' => '',
        'sale' => '',
        'articul' => '',
        'short_desc' => '',
        'manufacturer' => '',
        'manufacturer_country' => '',
        'is_have' => '',
        'currency' => '',
        'units' => '',
        'char1' => '',
        'mesure1' => '',
        'val1' => '',
        'char2' => '',
        'mesure2' => '',
        'val2' => '',
        'char3' => '',
        'mesure3' => '',
        'val3' => '',
        'char4' => '',
        'mesure4' => '',
        'val4' => '',
        'char5' => '',
        'mesure5' => '',
        'val5' => '',
        'char6' => '',
        'mesure6' => '',
        'val6' => '',
        'char7' => '',
        'mesure7' => '',
        'val7' => '',
        'char8' => '',
        'mesure8' => '',
        'val8' => '',
        'char9' => '',
        'mesure9' => '',
        'val9' => '',
        'char10' => '',
        'mesure10' => '',
        'val10' => '',
        'char11' => '',
        'mesure11' => '',
        'val11' => '',
        'char12' => '',
        'mesure12' => '',
        'val12' => '',
        'char13' => '',
        'mesure13' => '',
        'val13' => '',
        'char14' => '',
        'mesure14' => '',
        'val14' => '',
        'char15' => '',
        'mesure15' => '',
        'val15' => '',
        'char16' => '',
        'mesure16' => '',
        'val16' => '',
        'char17' => '',
        'mesure17' => '',
        'val17' => '',
        'char18' => '',
        'mesure18' => '',
        'val18' => '',
        'char19' => '',
        'mesure19' => '',
        'val19' => '',
        'char20' => '',
        'mesure20' => '',
        'val20' => '',
        'char21' => '',
        'mesure21' => '',
        'val21' => '',
        'discount' => '',
		'meta_title' => '',
		'meta_desc' => '',
    ];


    public $rules = [
        'required' => [
            ['title'],
            ['category_id'],
        ],
        'integer' => [
            ['category_id'],
        ],
    ];


    public function getIds($id){
        $cats = \R::getAssoc("SELECT * FROM category ORDER BY position");
        $ids = null;
        foreach($cats as $k => $v){
            if($v['parent_id'] == $id){
                $ids .= $k . ',';
                $ids .= $this->getIds($k);
            }
        }
        return $ids;
    }

    public function getcatIds($cat_id){
        $cat_ids = null;
        foreach($cat_id as $k => $v){
                $cat_ids .= $v . ',';
        }
        $cat_ids = trim ($cat_ids, ',');
        return $cat_ids;
    }


    public function editRelatedProduct($id, $data){
        $related_product = \R::getCol('SELECT related_id FROM related_product WHERE product_id = ?', [$id]);
        // если менеджер убрал связанные товары - удаляем их
        if(empty($data['related']) && !empty($related_product)){
            \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);
            return;
        }
        // если добавляются связанные товары
        if(empty($related_product) && !empty($data['related'])){
            $sql_part = '';
            foreach($data['related'] as $v){
                $v = (int)$v;
                $sql_part .= "($id, $v),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO related_product (product_id, related_id) VALUES $sql_part");
            return;
        }
        // если изменились связанные товары - удалим и запишем новые
        if(!empty($data['related'])){
            $result = array_diff($related_product, $data['related']);
            if(!empty($result) || count($related_product) != count($data['related'])){
                \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);
                $sql_part = '';
                foreach($data['related'] as $v){
                    $v = (int)$v;
                    $sql_part .= "($id, $v),";
                }
                $sql_part = rtrim($sql_part, ',');
                \R::exec("INSERT INTO related_product (product_id, related_id) VALUES $sql_part");
            }
        }
    }

    public function editDopCats($id, $data){
        $dop_cats = \R::getCol('SELECT cat_id FROM cat_product WHERE prod_id = ?', [$id]);
        // если менеджер убрал группы - удаляем их
        if(empty($data['cats']) && !empty($dop_cats)){
            \R::exec("DELETE FROM cat_product WHERE prod_id = ?", [$id]);
            return;
        }
        // если группы добавляются
        if(empty($dop_cats) && !empty($data['cats'])){
            $sql_part = '';
            foreach($data['cats'] as $v){
                $sql_part .= "($v, $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO cat_product (cat_id, prod_id) VALUES $sql_part");
            return;
        }

        // если изменились группы - удалим и запишем новые
        if(!empty($data['cats'])){
            $result = array_diff($dop_cats, $data['cats']);
            if(!empty($result) || count($dop_cats) != count($data['cats'])){
                \R::exec("DELETE FROM cat_product WHERE prod_id = ?", [$id]);
                $sql_part = '';
                foreach($data['cats'] as $v){
                    $sql_part .= "($v, $id),";
                }
                $sql_part = rtrim($sql_part, ',');
                \R::exec("INSERT INTO cat_product (cat_id, prod_id) VALUES $sql_part");
            }
        }
    }

    public function editColorVariant($id, $data){
        $color_variant = \R::getCol('SELECT color_variant_id FROM color_group WHERE product_id = ?', [$id]);
        // если менеджер убрал связанные товары - удаляем их
        if(empty($data['colors']) && !empty($color_variant)){
            \R::exec("DELETE FROM color_group WHERE product_id = ?", [$id]);
            return;
        }
        // если добавляются связанные товары
        if(empty($color_variant) && !empty($data['colors'])){
            $sql_part = '';
            foreach($data['colors'] as $v){
                $v = (int)$v;
                $sql_part .= "($id, $v),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO color_group (product_id, color_variant_id) VALUES $sql_part");
            return;
        }
        // если изменились связанные товары - удалим и запишем новые
        if(!empty($data['colors'])){
            $result = array_diff($color_variant, $data['colors']);
            if(!empty($result) || count($color_variant) != count($data['colors'])){
                \R::exec("DELETE FROM color_group WHERE product_id = ?", [$id]);
                $sql_part = '';
                foreach($data['colors'] as $v){
                    $v = (int)$v;
                    $sql_part .= "($id, $v),";
                }
                $sql_part = rtrim($sql_part, ',');
                \R::exec("INSERT INTO color_group (product_id, color_variant_id) VALUES $sql_part");
            }
        }
    }



    public function editFilter($id, $data){
        $filter = \R::getCol('SELECT attr_id FROM attribute_product WHERE product_id = ?', [$id]);
        // если менеджер убрал фильтры - удаляем их
        if(empty($data['attrs']) && !empty($filter)){
            \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
            return;
        }
        // если фильтры добавляются
        if(empty($filter) && !empty($data['attrs'])){
            $sql_part = '';
            foreach($data['attrs'] as $v){
                $v = (int)$v;
                $sql_part .= "($v, $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO attribute_product (attr_id, product_id) VALUES $sql_part");
            return;
        }
        // если изменились фильтры - удалим и запишем новые
        if(!empty($data['attrs'])){
            $result = array_diff($filter, $data['attrs']);
            if(!empty($result) || count($filter) != count($data['attrs'])){
                \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
                $sql_part = '';
                foreach($data['attrs'] as $v){
                    $v = (int)$v;
                    $sql_part .= "($v, $id),";
                }
                $sql_part = rtrim($sql_part, ',');
                \R::exec("INSERT INTO attribute_product (attr_id, product_id) VALUES $sql_part");
            }
        }
    }

    public function editGroup($id, $data){
        $groupe = \R::getCol('SELECT groupe_id FROM groupe_product WHERE product_id = ?', [$id]);
        // если менеджер убрал группы - удаляем их
        if(empty($data['groupe']) && !empty($groupe)){
            \R::exec("DELETE FROM groupe_product WHERE product_id = ?", [$id]);
            return;
        }
        // если группы добавляются
        if(empty($groupe) && !empty($data['groupe'])){
            $sql_part = '';
            foreach($data['groupe'] as $v){
                $sql_part .= "($v, $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO groupe_product (groupe_id, product_id) VALUES $sql_part");
            return;
        }
        // если изменились группы - удалим и запишем новые
        if(!empty($data['groupe'])){
            $result = array_diff($groupe, $data['groupe']);
            if(!empty($result) || count($groupe) != count($data['groupe'])){
                \R::exec("DELETE FROM groupe_product WHERE product_id = ?", [$id]);
                $sql_part = '';
                foreach($data['groupe'] as $v){
                    $sql_part .= "($v, $id),";
                }
                $sql_part = rtrim($sql_part, ',');
                \R::exec("INSERT INTO groupe_product (groupe_id, product_id) VALUES $sql_part");
            }
        }
    }

    public function getImg(){
        if(!empty($_SESSION['single'])){
            $this->attributes['img'] = $_SESSION['single'];
            unset($_SESSION['single']);
        }
    }

    public function saveGallery($id){
        if(!empty($_SESSION['multi'])){
            $sql_part = '';
            foreach($_SESSION['multi'] as $v){
                $sql_part .= "('$v', $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO gallery (img, product_id) VALUES $sql_part");
            unset($_SESSION['multi']);
        }
    }

    public function uploadImg($name){
        $uploaddir = WWW . '/prodimg/';
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
        if($_FILES[$name]['size'] > 1048576){
            $res = array("error" => "Ошибка! Максимальный вес файла - 1 Мб!");
            exit(json_encode($res));
        }
        if($_FILES[$name]['error']){
            $res = array("error" => "Ошибка! Возможно, файл слишком большой.");
            exit(json_encode($res));
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = array("error" => "Допустимые расширения - .gif, .jpg, .png");
            exit(json_encode($res));
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            if($name == 'single'){
                $_SESSION['single'] = $new_name;
            }else{
                $_SESSION['multi'][] = $new_name;
            }
            //self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
            $res = array("file" => $new_name);
            exit(json_encode($res));
        }
    }

    /**
     * @param string $target путь к оригинальному файлу
     * @param string $dest путь сохранения обработанного файла
     * @param string $wmax максимальная ширина
     * @param string $hmax максимальная высота
     * @param string $ext расширение файла
     */

}
