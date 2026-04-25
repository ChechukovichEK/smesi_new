<?php

namespace app\models\admin;

class User extends \app\models\User {

    public $attributes = [
        'id' => '',
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
        'role' => '',
        'status' => '',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['name'],
            ['role'],
        ],
        'email' => [
            ['email'],
        ],
    ];

    public function checkUnique(){
        $user = \R::findOne('user', '(login = ?) AND id <> ?', [$this->attributes['login'], $this->attributes['id']]);
        if($user){
            if($user->login == $this->attributes['login']){
                $this->errors['unique'][] = 'Этот логин уже занят';
            }
            return false;
        }
        return true;
    }

}
