<?php
namespace app\models\admin;
use app\models\AppModel;

class Urltext extends AppModel{

  public $attributes = [
    'url' => '',
    'content' => '',
  ];

  public $rules = [
    'required' => [
        ['url'],
        ['content'],
    ]
  ];

}
