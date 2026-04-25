<?php

namespace app\widgets\pages;

use ishop\App;
use ishop\Cache;
use RedUNIT\Base\Threeway;

class Pages{

    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl;
    protected $table = 'pages';
    protected $cache = 0;
    protected $cacheKey = 'ishop_menu';
    protected $attrs = [];


    public function __construct($options = []){
        $this->tpl = __DIR__ . '/page_tpl/page.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options){
        foreach($options as $k => $v){
            if(property_exists($this, $k)){
                $this->$k = $v;
            }
        }
    }

    protected function run(){
        $cache = Cache::instance();
        $this->menuHtml = $cache->get($this->cacheKey);
        if(!$this->menuHtml){
            $this->data = App::$app->getProperty('pages');
            if(!$this->data){
                $this->data = $pages = \R::getAssoc("SELECT * FROM {$this->table}");
            }
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if($this->cache){
                $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
            }
            }
            $this->output();
            }


    protected function output(){
        $attrs = '';
        if(!empty($this->attrs)){
            foreach($this->attrs as $k => $v){
                $attrs .= " $k='$v' ";
            }
        }
            echo $this->menuHtml;
    }

    protected function getTree(){
        $tree = [];
        $data = $this->data;
        foreach ($data as $id=>&$node) {
                $tree[$id] = &$node;
            }
        return $tree;
    }

    protected function getMenuHtml($tree){
        $str = '';
        foreach($tree as $id => $page){
            $str .= $this->catToTemplate($page, $id);
        }
        return $str;
    }

    protected function catToTemplate($page, $id){
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }

}

?>
