<?php
namespace app\models\admin;
use app\models\AppModel;

class Pages extends AppModel{

  public $attributes = [
    'title' => '',
    'content' => '',
    'position' => '',
    'meta_title' => '',
    'meta_desc' => '',
  ];

  public $rules = [
    'required' => [
        ['title'],
    ]
  ];
}
