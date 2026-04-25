<?php

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\admin\Slider;
use ishop\App;

class SliderController extends AppController {

    public function indexAction(){
        $slider = \R::find('slider', 'ORDER BY position');
        $this->set(compact('slider'));
        $this->setMeta('Список слайдов');
    }

    public function addAction(){
        if(!empty($_POST)){
            $slider = new Slider();
            $data = $_POST;
            $slider->load($data);
            $slider->attributes['status'] = $slider->attributes['status'] ? '1' : '0';
            $slider->getImg();
            if(!$slider->validate($data)){
                $slider->getErrors();
                redirect();
            }
            if($id = $slider->save('slider')){
                $_SESSION['success'] = 'Слайд добавлен';
            }
            redirect(ADMIN . '/slider/edit?id=' . $id);
        }
        $this->setMeta('Новый слайд');
    }


    public function deleteAction(){
        $id = $this->getRequestID();
        $slide = \R::load('slider', $id);
        \R::trash($slide);
        $_SESSION['success'] = 'Слайд удалён!';
        redirect();
    }


    public function addImageAction(){
    if(isset($_GET['upload'])){
        $name = $_POST['name'];
        $slider = new Slider();
        $slider->uploadImg($name);
      }
  }

    public function editAction(){
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $slider = new Slider();
            $data = $_POST;
            $slider->load($data);
            $slider->attributes['status'] = $slider->attributes['status'] ? '1' : '0';
            $slider->getImg();
            if(!$slider->validate($data)){
                $slider->getErrors();
                redirect();
            }
            if($slider->update('slider', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect();
        }
        $id = $this->getRequestID();
        $slider = \R::load('slider', $id);
        $this->setMeta("Редактирование слайда {$slider->title}");
        $this->set(compact('slider'));
        }

        public function SortableAction(){
          if(isset($_POST['masiv'])){
            $pos_new = 1;
            foreach($_POST['masiv'] as $item){
              $res = \R::exec("UPDATE `slider` SET `position`='{$pos_new}' WHERE `id`='{$item}'");
              $pos_new++;
          }
          $_SESSION['success'] = 'Обновлено!';
          redirect();
          }
        }

        public function deleteImgAction(){
          $id = isset($_POST['id']) ? $_POST['id'] : null;
          $src = isset($_POST['src']) ? $_POST['src'] : null;
          if(!$id || !$src){
            return;
          }
          if(\R::exec("UPDATE slider SET slider_img = '' WHERE id = ? AND img1 = ?", [$id, $src])){
            @unlink(WWW . "/images/$src");
            exit('1');
          }
          if(\R::exec("UPDATE slider SET slider_img2 = '' WHERE id = ? AND img2 = ?", [$id, $src])){
            @unlink(WWW . "/images/$src");
            exit('1');
          }
          if(\R::exec("UPDATE slider SET slider_img3 = '' WHERE id = ? AND img3 = ?", [$id, $src])){
            @unlink(WWW . "/images/$src");
            exit('1');
          }
            return;
      }

      }
