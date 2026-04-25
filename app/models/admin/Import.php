<?php
namespace app\models\admin;
use app\models\AppModel;

class Import extends AppModel{

  public $cells = [
    'D'=>'order',
		'F'=>'date port',
		'B'=>'customer',
		'G'=>'country',
		'J'=>'products',
		'K'=>'grade',
		'U'=>'date',
		'M'=>'size',
		'P'=>'length',
		'Q'=>'quantity',
		'U'=>'date',
		'V'=>'gruzo',
  ];



  public function uploadFile($files) {
    $uploaddir = WWW . '/import/';
    $uploadfile = $uploaddir .'/'.(int)microtime(true).'.xlsx';
    if (move_uploaded_file($files['xls']['tmp_name'], $uploadfile)) {
       return $uploadfile;
    }
    return FALSE;
  }



}
