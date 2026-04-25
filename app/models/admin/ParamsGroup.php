<?php

namespace app\models\admin;

use app\models\AppModel;

class ParamsGroup extends AppModel{

    public $attributes = [
        'title' => '',
        'prod_desc' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
        ],
    ];

    public function editGroupParams($id, $data){
        $params = \R::getCol('SELECT param_id FROM param_group WHERE group_id = ?', [$id]);
        // если менеджер убрал параметры - удаляем их
        if(empty($data['params']) && !empty($params)){
            \R::exec("DELETE FROM param_group WHERE group_id = ?", [$id]);
            return;
        }
        // если параметры добавляются
        if(empty($params) && !empty($data['params'])){
            $sql_part = '';
            foreach($data['params'] as $v){
                $sql_part .= "($v, $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO param_group (param_id, group_id) VALUES $sql_part");
            return;
        }

        // если изменились параметры - удалим и запишем новые
        if(!empty($data['params'])){
            $result = array_diff($params, $data['params']);
            if(!empty($result) || count($params) != count($data['params'])){
                \R::exec("DELETE FROM param_group WHERE group_id = ?", [$id]);
                $sql_part = '';
                foreach($data['params'] as $v){
                    $sql_part .= "($v, $id),";
                }
                $sql_part = rtrim($sql_part, ',');
                \R::exec("INSERT INTO param_group (param_id, group_id) VALUES $sql_part");
            }
        }
    }

    public function editParamProds($id, $data){
        $dop_prods = \R::getCol('SELECT prod_id FROM paramgroup_product WHERE group_id = ?', [$id]);
        // если менеджер убрал товары - удаляем их
        if(empty($data['param_products']) && !empty($dop_prods)){
            \R::exec("DELETE FROM paramgroup_product WHERE group_id = ?", [$id]);
            return;
        }
        // если группы добавляются
        if(empty($dop_prods) && !empty($data['param_products'])){
            $sql_part = '';
            foreach($data['param_products'] as $v){
                $sql_part .= "($v, $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO paramgroup_product (prod_id, group_id) VALUES $sql_part");
            return;
        }

        // если изменились товары - удалим и запишем новые
        if(!empty($data['param_products'])){
            $result = array_diff($dop_prods, $data['param_products']);
            if(!empty($result) || count($dop_prods) != count($data['param_products'])){
                \R::exec("DELETE FROM paramgroup_product WHERE group_id = ?", [$id]);
                $sql_part = '';
                foreach($data['param_products'] as $v){
                    $sql_part .= "($v, $id),";
                }
                $sql_part = rtrim($sql_part, ',');
                \R::exec("INSERT INTO paramgroup_product (prod_id, group_id) VALUES $sql_part");
            }
        }
    }

}
