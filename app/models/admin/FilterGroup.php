<?php

namespace app\models\admin;

use app\models\AppModel;

class FilterGroup extends AppModel{

    public $attributes = [
        'title' => '',
        'parent_cat_id' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
        ],
    ];

}
