<?php

namespace app\controllers\admin;

use app\models\AppModel;
use ishop\App;
use PHPExcel_IOFactory;

class ImportController extends AppController{
//общие функции
  public function getPhpExcel($file){
        return PHPExcel_IOFactory::load($file);
    }
  public function uploadFile($files) {
    $uploaddir = WWW . '/import';
    $uploadfile = $uploaddir .'/'.(int)microtime(true).'.xlsx';
    if (move_uploaded_file($files['xls']['tmp_name'], $uploadfile)) {
       return $uploadfile;
    }
    return FALSE;
  }
//общие функции

//загрузить категория-продукт
    public $catprod = [
      'N' => 'cat_id',
      'T' => 'prod_id',
    ];
    public function catprodAction(){
        if (!empty($_FILES['xls']['tmp_name'])) {
            $file = $this->uploadFile($_FILES);
            $this->tocatprod($file);
        }
        $this->setMeta("Импорт категория-продукт");
    }
    public function tocatprod($file){
      $this->xls = $this->getPhpExcel($file);
      $this->xls->setActiveSheetIndex(0);
      $sheet = $this->xls->getActiveSheet();
      $rowIterator = $sheet->getRowIterator();
      $arr = array();
      foreach ($rowIterator as $row) {
          if ($row->getRowIndex() != 1) {
              $cellIterator = $row->getCellIterator();
              foreach ($cellIterator as $cell) {
                  $cellPath = $cell->getColumn();
                  if (isset($this->catprod[$cellPath])) {
                      $arr[$row->getRowIndex()][$this->catprod[$cellPath]] = $cell->getCalculatedValue();
                  }
              }
          }
      }
      if ($this->catprodMySql($arr)) {
          unlink($file);
          return TRUE;
      }
      return false;
    }
    public function catprodMySql($arr){
      foreach ($arr as $item) {
        $cat_id = $item['cat_id'];
        $prod_id = $item['prod_id'];
          if(!empty($cat = \R::exec("SELECT * FROM cat_product WHERE cat_id = $cat_id AND prod_id = $prod_id"))){
            continue;
          }else{
          $query = \R::exec("INSERT INTO cat_product (cat_id, prod_id) VALUES ('$cat_id', '$prod_id')");
          }
      }
      $_SESSION['success'] = 'Значения в таблицу группа-товар успешно добавлены!';
      return true;
    }
//загрузить категория-продукт

//загрузить категории
    public $categorycells = [
      'A' => 'id',
      'B' => 'title',
      'C' => 'position',
      'D' => 'alias',
      'E' => 'parent_id',
    ];
    public function importcategoryAction(){
        if (!empty($_FILES['xls']['tmp_name'])) {
            $file = $this->uploadFile($_FILES);
            $this->xlsToMysql($file);
        }
        $this->setMeta("Импорт категорий");
}
    public function xlsToMysql($file){
        $this->xls = $this->getPhpExcel($file);
        $this->xls->setActiveSheetIndex(0);
        $sheet = $this->xls->getActiveSheet();
        $rowIterator = $sheet->getRowIterator();
        $arr = array();
        foreach ($rowIterator as $row) {
            if ($row->getRowIndex() != 1) {
                $cellIterator = $row->getCellIterator();
                foreach ($cellIterator as $cell) {
                    $cellPath = $cell->getColumn();
                    if (isset($this->categorycells[$cellPath])) {
                        $arr[$row->getRowIndex()][$this->categorycells[$cellPath]] = $cell->getCalculatedValue();
                    }
                }
            }
        }
        if ($this->insertExcel($arr)) {
            unlink($file);
            return TRUE;
        }
        return false;
}
    public function insertExcel($arr){
        $fields = '';
        foreach ($arr[2] as $key => $cell) {
            $fields .= '`' . $key . '`' . ',';
        }
        $fields = trim($fields, ',');
        $str = '';
        // INSERT INTO `main` (``,``,``..) VALUES ('','','',),(),(),();
        foreach ($arr as $item) {
          $id = $item['id'];
          if(!empty($cat = \R::exec("SELECT * FROM category WHERE id = $id"))){
            continue;
          }else{
            $str .= '(';
            $title = $item['title'];
            if(empty($item['position'])){
              $item['position'] = '10000';
            }
            if(empty($item['parent_id'])){
              $item['parent_id'] = '0';
            }
            $item['alias'] = AppModel::createAlias('category', 'alias', $title, $id);
            foreach ($item as $cell) {
                $str .= "'" . $cell . "',";
            }
            $str = trim($str, ',');
            $str .= '),';
          }
      }
    $str = trim($str, ',');
    if(empty($str)){
      $_SESSION['success'] = 'Нет новых значений!';
      return false;
    }
    $query = \R::exec("INSERT INTO category ($fields) VALUES $str");
    $_SESSION['success'] = 'Новые группы товаров успешно добавлены!';
    return true;
}
//загрузить категории

//обновить категории
    public $categorycellsupd = [
      'A' => 'id',
      'B' => 'title',
      'C' => 'position',
      'E' => 'parent_id',
    ];
    public function updateCategoryAction(){
      if (!empty($_FILES['xls']['tmp_name'])) {
          $file = $this->uploadFile($_FILES);
          $this->updCat($file);
      }
      $this->setMeta("Обновить категории");
    }
    public function updCat($file){
      $this->xls = $this->getPhpExcel($file);
      $this->xls->setActiveSheetIndex(0);
      $sheet = $this->xls->getActiveSheet();
      $rowIterator = $sheet->getRowIterator();
      $arr = array();

      foreach ($rowIterator as $row) {
          if ($row->getRowIndex() != 1) {
              $cellIterator = $row->getCellIterator();
              foreach ($cellIterator as $cell) {
                  $cellPath = $cell->getColumn();
                  if (isset($this->categorycellsupd[$cellPath])) {
                      $arr[$row->getRowIndex()][$this->categorycellsupd[$cellPath]] = $cell->getCalculatedValue();
                  }
              }
          }
      }
      if ($this->updMySql($arr)) {
          unlink($file);
          return TRUE;
      }
      return false;
    }
    public function updMySql($arr){
      foreach ($arr as $item) {
        $id = $item['id'];
        //$title = $item['title'];
        $position = $item['position'];
        $parent = $item['parent_id'];
        //$alias = AppModel::createAlias('category', 'alias', $title, $id);
        $query = \R::exec("UPDATE category SET
          position = '$position',
          parent_id = '$parent'
          WHERE id = '$id'");
        }
        $_SESSION['success'] = 'Группы успешно обновлены!';
        return true;
      }
//обновить категории

//загрузить товары
public $productcells = [
    'T' => 'id',
    'N' => 'category_id',
    'O' => 'category_title',
    'B' => 'title',
    'A' => 'articul',
    'G' => 'currency',
    'H' => 'units',
    'F' => 'price',
    'M' => 'is_have',
    'D' => 'content',
    'X' => 'manufacturer',
    'Z' => 'manufacturer_country',
    'AA' => 'discount',
    'AR' => 'char1',
    'AS' => 'mesure1',
    'AT' => 'val1',
    'AU' => 'char2',
    'AV' => 'mesure2',
    'AW' => 'val2',
    'AX' => 'char3',
    'AY' => 'mesure3',
    'AZ' => 'val3',
    'BA' => 'char4',
    'BB' => 'mesure4',
    'BC' => 'val4',
    'BD' => 'char5',
    'BE' => 'mesure5',
    'BF' => 'val5',
    'BG' => 'char6',
    'BH' => 'mesure6',
    'BI' => 'val6',
    'BJ' => 'char7',
    'BK' => 'mesure7',
    'BL' => 'val7',
    'BM' => 'char8',
    'BN' => 'mesure8',
    'BO' => 'val8',
    'BP' => 'char9',
    'BQ' => 'mesure9',
    'BR' => 'val9',
    'BS' => 'char10',
    'BT' => 'mesure10',
    'BU' => 'val10',
    'BV' => 'char11',
    'BW' => 'mesure11',
    'BX' => 'val11',
    'BY' => 'char12',
    'BZ' => 'mesure12',
    'CA' => 'val12',
    'CB' => 'char13',
    'CC' => 'mesure13',
    'CD' => 'val13',
    'CE' => 'char14',
    'CF' => 'mesure14',
    'CG' => 'val14',
    'CH' => 'char15',
    'CI' => 'mesure15',
    'CJ' => 'val15',
    'CK' => 'char16',
    'CL' => 'mesure16',
    'CM' => 'val16',
    'CN' => 'char17',
    'CO' => 'mesure17',
    'CP' => 'val17',
    'CQ' => 'char18',
    'CR' => 'mesure18',
    'CS' => 'val18',
    'CT' => 'char19',
    'CU' => 'mesure19',
    'CV' => 'val19',
    'CW' => 'char20',
    'CX' => 'mesure20',
    'CY' => 'val20',
    'CZ' => 'char21',
    'DA' => 'mesure21',
    'DB' => 'val21',
    'L' => 'img',
];
  public function importproductAction(){
    if (!empty($_FILES['xls']['tmp_name'])) {
        $file = $this->uploadFile($_FILES);
        $this->xlsToMysqlProd($file);
    }
    $this->setMeta("Импорт продуктов");
  }
  public function xlsToMysqlProd($file){
      $this->xls = $this->getPhpExcel($file);
      $this->xls->setActiveSheetIndex(0);
      $sheet = $this->xls->getActiveSheet();
      $rowIterator = $sheet->getRowIterator();
      $arr = array();
      foreach ($rowIterator as $row) {
          if ($row->getRowIndex() != 1) {
              $cellIterator = $row->getCellIterator();
              foreach ($cellIterator as $cell) {
                  $cellPath = $cell->getColumn();
                  if (isset($this->productcells[$cellPath])) {
                      $arr[$row->getRowIndex()][$this->productcells[$cellPath]] = $cell->getCalculatedValue();
                  }
              }
          }
      }
      if ($this->insertExcelProd($arr)) {
          unlink($file);
          return TRUE;
      }
      return false;
  }
  public function insertExcelProd($arr){
    $fields = '';
      foreach ($arr[2] as $key => $cell) {
        $fields .= '`' . $key . '`' . ',';
    }
    $fields .= '`alias`';
    $fields = trim($fields, ',');
    $str = '';
    foreach ($arr as $item) {
      $id = $item['id'];
      if(!empty($prod = \R::exec("SELECT * FROM product WHERE id = $id"))){
        continue;
      }else{
        $str .= '(';
        $title = $item['title'];
        $alias = AppModel::createAlias('product', 'alias', $title, $id);
        $item['price'] = round(floatval(preg_replace("#,#", ".", $item['price'])), 2);
        $item['content'] = htmlspecialchars_decode($item['content']);
        $item['discount'] = trim($item['discount'], '%');
        $url = explode(', ', $item['img']);
        $url_count = count($url);
        $img_base_full = $url[0];
        $img_base = parse_url($img_base_full, PHP_URL_PATH);
        $img_base = trim($img_base, '/');
        $item['img'] = $img_base;
        foreach ($url as $value) {
          $url_item = $value;
          $name = parse_url($url_item, PHP_URL_PATH);
          $name = trim($name, '/');
          $path = WWW . '/prodimg/' . $name;
          $this -> uplfile($url_item, $path);
          if($url_count > 1){
            \R::exec("INSERT INTO gallery (product_id, img) VALUES ($id, '$name')");
          }
        }

        foreach ($item as $cell) {
          $str .= "'" . $cell . "',";
        }
        $str .= "'" . $alias . "',";
        $str = trim($str, ',');
        $str .= '),';
      }
    }
      $str = trim($str, ',');
      if(empty($str)){
        $_SESSION['success'] = 'Нет новых значений!';
        return false;
      }
      $query = \R::exec("INSERT INTO product ($fields) VALUES $str");
      $_SESSION['success'] = 'Новые товары успешно добавлены!';
      return true;
  }
//загрузить товары

//обновить товары
public $productupd = [
  'A' => 'id',
  'D' => 'price',
  'E'=> 'price_dis',
  'F' => 'price_opt',
  'G' => 'price_master',
];
public function updateProductAction(){
  if (!empty($_FILES['xls']['tmp_name'])) {
      $file = $this->uploadFile($_FILES);
      $this->updProd($file);
  }
  $this->setMeta("Обновить товары");
}
public function updProd($file){
  $this->xls = $this->getPhpExcel($file);
  $this->xls->setActiveSheetIndex(0);
  $sheet = $this->xls->getActiveSheet();
  $rowIterator = $sheet->getRowIterator();
  $arr = array();
  foreach ($rowIterator as $row) {
      if ($row->getRowIndex() != 1) {
          $cellIterator = $row->getCellIterator();
          foreach ($cellIterator as $cell) {
              $cellPath = $cell->getColumn();
              if (isset($this->productupd[$cellPath])) {
                  $arr[$row->getRowIndex()][$this->productupd[$cellPath]] = $cell->getCalculatedValue();
              }
          }
      }
  }
  if ($this->updprodMySql($arr)) {
      unlink($file);
      return TRUE;
  }
  return false;
}
public function updprodMySql($arr){
  foreach ($arr as $item) {
    $id = $item['id'];
    //$item['discount'] = trim($item['discount'], '%');
    //$discount = $item['discount'];
    //$content = htmlspecialchars_decode($item['content']);
    //$title = $item['title'];
    //$alias = AppModel::createAliasEx($title, $id);
    $price = round(floatval(preg_replace("#,#", ".", $item['price'])), 2);
    $price_dis = round(floatval(preg_replace("#,#", ".", $item['price_dis'])), 2);
    $price_master = round(floatval(preg_replace("#,#", ".", $item['price_master'])), 2);
    $price_opt = round(floatval(preg_replace("#,#", ".", $item['price_opt'])), 2);
    //$is_have = $item['is_have'];
  $query = \R::exec("UPDATE `product` SET
              price = '$price',
              price_dis = '$price_dis',
              price_master = '$price_master',
              price_opt = '$price_opt'
              WHERE id = '$id'");
  }
  $_SESSION['success'] = 'Товары успешно обновлены!';
  return true;
}
//обновить товары

//импорт пользователей
public $usercells = [
  'A' => 'id',
  'B' => 'name',
  'C' => 'phone',
  'D' => 'login',
  'E' => 'password',
  'F' => 'address',
  'G' => 'email',
];
public function importuserAction(){
    if (!empty($_FILES['xls']['tmp_name'])) {
        $file = $this->uploadFile($_FILES);
        $this->userToMysql($file);
    }
    $this->setMeta("Импорт пользователей");
}
public function userToMysql($file){
    $this->xls = $this->getPhpExcel($file);
    $this->xls->setActiveSheetIndex(0);
    $sheet = $this->xls->getActiveSheet();
    $rowIterator = $sheet->getRowIterator();
    $arr = array();
    foreach ($rowIterator as $row) {
        if ($row->getRowIndex() != 1) {
            $cellIterator = $row->getCellIterator();
            foreach ($cellIterator as $cell) {
                $cellPath = $cell->getColumn();
                if (isset($this->usercells[$cellPath])) {
                    $arr[$row->getRowIndex()][$this->usercells[$cellPath]] = $cell->getCalculatedValue();
                }
            }
        }
    }
    if ($this->userExcel($arr)) {
        unlink($file);
        return TRUE;
    }
    return false;
}
public function userExcel($arr){
    $fields = '';
    foreach ($arr[2] as $key => $cell) {
        $fields .= '`' . $key . '`' . ',';
    }
    $fields .= '`role`';
    $fields = trim($fields, ',');
    $str = '';
    // INSERT INTO `main` (``,``,``..) VALUES ('','','',),(),(),();
    foreach ($arr as $item) {
      $id = $item['id'];
      if(!empty($user = \R::exec("SELECT * FROM user WHERE id = $id"))){
        continue;
      }else{
        $str .= '(';
        if(!empty($item['password'])){
        $item['password'] = password_hash($item['password'], PASSWORD_DEFAULT);
      }else{
        $item['password'] = password_hash('123456', PASSWORD_DEFAULT);
      }
        foreach ($item as $cell) {
            $str .= "'" . $cell . "',";
        }
        $str .= "'user'";
        $str .= '),';
      }
  }
$str = trim($str, ',');
if(empty($str)){
  $_SESSION['success'] = 'Нет новых значений!';
  return false;
}
$query = \R::exec("INSERT INTO user ($fields) VALUES $str");
$_SESSION['success'] = 'Новые пользователи успешно добавлены!';
return true;
}
//импорт пользователей

//импорт заказов
public $ordercells = [
  'A' => 'id',
  'B' => 'user_id',
  'C' => 'status',
  'D' => 'date',
  'E' => 'update_at',
  'F' => 'name',
  'G' => 'email',
  'H' => 'phone',
  'I' => 'address',
  'J' => 'samovivoz',
  'K' => 'pay',
  'L' => 'note',
  'M' => 'sum',
  'N' => 'manager',
];

public $orderprodcells = [
  'A' => 'id',
  'B' => 'order_id',
  'C' => 'product_id',
  'D' => 'articul',
  'E' => 'qty',
  'F' => 'title',
  'G' => 'alias',
  'H' => 'price',
  'I' => 'discount',
];

public function importorderAction(){
    if (!empty($_FILES['xls']['tmp_name'])) {
        $file = $this->uploadFile($_FILES);
        $this->orderToMysql($file);
    }
    $this->setMeta("Импорт заказов");
}
public function orderToMysql($file){
    $this->xls = $this->getPhpExcel($file);
    $this->xls->setActiveSheetIndex(0);
    $sheet = $this->xls->getActiveSheet();
    $rowIterator = $sheet->getRowIterator();
    $arr = array();
    foreach ($rowIterator as $row) {
        if ($row->getRowIndex() != 1) {
            $cellIterator = $row->getCellIterator();
            foreach ($cellIterator as $cell) {
                $cellPath = $cell->getColumn();
                if (isset($this->ordercells[$cellPath])) {
                    $arr[$row->getRowIndex()][$this->ordercells[$cellPath]] = $cell->getCalculatedValue();
                }
            }
        }
    }
    $this->xls->createSheet();
    $this->xls->setActiveSheetIndex(1);
    $sheetprod = $this->xls->getActiveSheet();
    $rowIterator = $sheetprod->getRowIterator();
    $arrprod = array();
    foreach ($rowIterator as $row) {
        if ($row->getRowIndex() != 1) {
            $cellIterator = $row->getCellIterator();
            foreach ($cellIterator as $cell) {
                $cellPath = $cell->getColumn();
                if (isset($this->orderprodcells[$cellPath])) {
                    $arrprod[$row->getRowIndex()][$this->orderprodcells[$cellPath]] = $cell->getCalculatedValue();
                }
            }
        }
    }

    if ($this->orderExcel($arr, $arrprod)) {
        unlink($file);
        return TRUE;
    }
    return false;
}

public function orderExcel($arr, $arrprod){
    $fields = '';
    foreach ($arr[2] as $key => $cell) {
        $fields .= '`' . $key . '`' . ',';
    }
    $fields = trim($fields, ',');
    $str = '';
    // INSERT INTO `main` (``,``,``..) VALUES ('','','',),(),(),();
    foreach ($arr as $item) {
      $id = $item['id'];
      if(!empty($order = \R::exec("SELECT * FROM `order` WHERE id = $id"))){
        continue;
      }else{
        $str .= '(';
        foreach ($item as $cell) {
            $str .= "'" . $cell . "',";
        }
        $str = trim($str, ',');
        $str .= '),';
      }
  }
$str = trim($str, ',');
if(empty($str)){
  $_SESSION['success'] = 'Нет новых значений!';
  return false;
}
$fieldsprod = '';
foreach ($arrprod[2] as $key => $cell) {
    $fieldsprod .= '`' . $key . '`' . ',';
}
$fieldsprod = trim($fieldsprod, ',');
debug($fieldsprod);
$strprod = '';
// INSERT INTO `main` (``,``,``..) VALUES ('','','',),(),(),();
foreach ($arrprod as $item) {
  $id = $item['id'];
  $prod = $item['product_id'];
  $product = \R::findOne('product', "id = ?", [$id]);
  $alias = $product['alias'];
  $item['alias'] = $alias;
  if(!empty($orderprod = \R::exec("SELECT * FROM `order_product` WHERE id = $id"))){
    continue;
  }else{
    $strprod .= '(';
    foreach ($item as $cell) {
        $strprod .= "'" . $cell . "',";
    }
    $strprod = trim($strprod, ',');
    $strprod .= '),';
  }
}
$strprod = trim($strprod, ',');
debug($strprod);
debug($str);
$query = \R::exec("INSERT INTO `order` ($fields) VALUES $str");
$query = \R::exec("INSERT INTO `order_product` ($fieldsprod) VALUES $strprod");
$_SESSION['success'] = 'Новые заказы успешно добавлены!';
return true;
}
//импорт заказов


//добавить изображения в папку товаров
  public $productimg = [
        'A' => 'img',
    ];

  public function imgtoFldAction(){
      if (!empty($_FILES['xls']['tmp_name'])) {
          $file = $this->uploadFile($_FILES);
          $this->imgtoFld($file);
      }
      $this->setMeta("Загрузить изображения");
  }
  public function uplfile($url, $path){
    $ReadFile = fopen ($url, "rb");
    if ($ReadFile) {
        $WriteFile = fopen ($path, "wb");
        if ($WriteFile){
            while(!feof($ReadFile)) {
                fwrite($WriteFile, fread($ReadFile, 4096 ));
            }
            fclose($WriteFile);
        }
        fclose($ReadFile);
    }
  }
  public function imgtoFld($file){
    $this->xls = $this->getPhpExcel($file);
    $this->xls->setActiveSheetIndex(0);
    $sheet = $this->xls->getActiveSheet();
    $rowIterator = $sheet->getRowIterator();
    $arr = array();
    foreach ($rowIterator as $row) {
      if ($row->getRowIndex() != 1) {
        $cellIterator = $row->getCellIterator();
          foreach ($cellIterator as $cell) {
            $cellPath = $cell->getColumn();
              if (isset($this->productimg[$cellPath])) {
                $arr[$row->getRowIndex()][$this->productimg[$cellPath]] = $cell->getCalculatedValue();
              }
          }
      }
    }
    foreach ($arr as $item) {
      $url = $item['img'];
      $name = parse_url($url, PHP_URL_PATH);
      $name = trim($name, '/');
      $path = WWW . '/prodimg/' . $name;
      $this -> uplfile($url, $path);
    }
    return true;
  }
//добавить изображения в папку товаров

//исключить удалённые товары из БД
public $nocells = [
  'T' => 'id',
];
public function exceptionAction(){
    if (!empty($_FILES['xls']['tmp_name'])) {
        $file = $this->uploadFile($_FILES);
        $this->exceptionToMysql($file);
    }
    $this->setMeta("Исключить удалённые товары");
}
public function exceptionToMysql($file){
    $this->xls = $this->getPhpExcel($file);
    $this->xls->setActiveSheetIndex(0);
    $sheet = $this->xls->getActiveSheet();
    $rowIterator = $sheet->getRowIterator();
    $arr = array();
    foreach ($rowIterator as $row) {
        if ($row->getRowIndex() != 1) {
            $cellIterator = $row->getCellIterator();
            foreach ($cellIterator as $cell) {
                $cellPath = $cell->getColumn();
                if (isset($this->nocells[$cellPath])) {
                    $arr[$row->getRowIndex()][$this->nocells[$cellPath]] = $cell->getCalculatedValue();
                }
            }
        }
    }
    if ($this->exExcel($arr)) {
        unlink($file);
        return TRUE;
    }
    return false;
}
public function exExcel($arr){
    $prod = \R::getAll("SELECT * FROM `product`");
    // INSERT INTO `main` (``,``,``..) VALUES ('','','',),(),(),();
    $targ_arr = [];
    $i = 0;
    foreach ($arr as $item) {
      $targ_arr[$i] = $item['id'];
      $i++;
    }
    //debug($targ_arr);
    foreach ($prod as $item) {
      $search_id = $item['id'];
      if (!in_array($search_id, $targ_arr)){
        \R::exec("DELETE FROM `product` WHERE id = $search_id");
      }
    }

//$_SESSION['success'] = 'Лишние товары успешно удалены!';
return true;
}
//исключить удалённые товары из БД


}
