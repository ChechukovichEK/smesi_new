<?php

namespace app\models\admin;

use app\models\AppModel;

class FilterAttr extends AppModel{

    public $attributes = [
        'value' => '',
        'alias' => '',
        'color' => '',
        'attr_group_id' => '',
    ];

    public $rules = [
        'required' => [
            ['value'],
        ],
        'integer' => [
            ['attr_group_id'],
        ]
    ];

}
