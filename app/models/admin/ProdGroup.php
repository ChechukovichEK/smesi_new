<?php

namespace app\models\admin;

use app\models\AppModel;

class ProdGroup extends AppModel{

    public $attributes = [
        'title' => '',
        'alias' => '',
        'category_id' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
        ],
    ];



}
