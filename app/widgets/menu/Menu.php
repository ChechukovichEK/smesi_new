<?php

namespace app\widgets\menu;

use ishop\App;
use ishop\Cache;
use RedUNIT\Base\Threeway;

class Menu{

    protected $data;
    protected $tree;
    protected $flt_names;
    protected $menuHtml;
    protected $tpl;
    protected $container = 'ul';
    protected $class;
    protected $table = 'category';
    protected $cache = 0;
    protected $cacheKey = 'ishop_menu';
    protected $attrs = [];
    protected $prepend = '';

    public function __construct($options = []){
        $this->tpl = __DIR__ . '/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getCats(){
      return \R::findAll('category');
    }



    public function getGroups($id){
      return \R::getAssoc("SELECT id, title FROM attribute_group WHERE parent_cat_id = '$id'");
    }

    public function getMainGroups($id){
      return \R::getAssoc("SELECT * FROM groupes WHERE category_id = '$id'");
    }



    public function getGroupAttrs($id){
      return \R::getAssoc("SELECT * FROM attribute_value WHERE attr_group_id = '$id'");
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
            $this->data = App::$app->getProperty('cats');
            if(!$this->data){
                $this->data = $cats = \R::getAssoc("SELECT * FROM {$this->table} ORDER BY position");
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
        echo "<{$this->container} class='{$this->class}' $attrs>";
            echo $this->prepend;
            echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    protected function getTree(){
        $tree = [];
        $data = $this->data;
        foreach ($data as $id=>&$node) {
          $flt_groups = $this->getGroups($id);
          foreach ($flt_groups as $key => $value) {
            $flt_values = $this->getGroupAttrs($key);
              foreach ($flt_values as $flt_value => $value) {
                $node['flt_values'][$flt_value] = $value;
              }
          }
          $main_groups = $this->getMainGroups($id);
          foreach ($main_groups as $key => $main_group) {
                $node['group_values'][$key] = $main_group;
          }
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            }else{
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }



    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        foreach($tree as $id => $category){

          //foreach ($flt_groups as $flt_group =>$item) {
            //$groupe_values = $this->getGroupAttrs($flt_group);
          //}
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab, $id){
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }

}
