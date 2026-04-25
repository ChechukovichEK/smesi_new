<?php

namespace app\models\admin;
use app\models\AppModel;

class Slider extends AppModel {

    public $attributes = [
        'title' => '',
        'link_url' => '',
        'background' => '',
        'status' => '',
        'position' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
        ]
    ];

    public function getImg(){
      if(!empty($_SESSION['slider-img1'])){
          $this->attributes['slider_img'] = $_SESSION['slider-img1'];
          unset($_SESSION['slider-img1']);
      }
      if(!empty($_SESSION['slider-img2'])){
          $this->attributes['slider_img2'] = $_SESSION['slider-img2'];
          unset($_SESSION['slider-img2']);
      }
      if(!empty($_SESSION['slider-img3'])){
          $this->attributes['slider_img3'] = $_SESSION['slider-img3'];
          unset($_SESSION['slider-img3']);
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
          if($name == 'slider-img1'){
              $_SESSION['slider-img1'] = $new_name;
          }
          if($name == 'slider-img2'){
              $_SESSION['slider-img2'] = $new_name;
          }
          if($name == 'slider-img3'){
              $_SESSION['slider-img3'] = $new_name;
          }
            $res = array("file" => $new_name);
            exit(json_encode($res));
        }
    }

}
