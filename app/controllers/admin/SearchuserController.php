<?php

namespace app\controllers\admin;

class SearchuserController extends AppController{


    public function typeaheadAction(){
        if($this->isAjax()){
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if($query){
                $users = \R::getAll("SELECT id, name, login, phone FROM user WHERE name LIKE '%{$query}%' OR login LIKE '%{$query}%' OR phone LIKE '%{$query}%'");
                echo json_encode($users);
            }
        }
        die;
    }

    public function indexAction(){
        $query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;
        if($query){
            $users = \R::getAll("SELECT * FROM user WHERE name LIKE '%{$query}%' OR login LIKE '%{$query}%' OR phone LIKE '%{$query}%'");
        }
        $this->setMeta('Поиск по: ' . h($query));
        $this->set(compact('users', 'query'));
    }

}
