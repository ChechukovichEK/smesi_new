<?php
namespace app\models\admin;
use app\models\AppModel;

class LandingPages extends AppModel{

  public $attributes = [
    'title' => '',
    'alias' => '',
    'category_alias' => '',
    'filter' => '',
    'short_text' => '',
    'content' => '',
    'meta_title' => '',
    'meta_desc' => '',
  ];

  public $rules = [
    'required' => [
        ['title', 'alias', 'category_alias', 'filter'],
    ]
  ];
}
