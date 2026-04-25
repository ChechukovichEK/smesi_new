<?php

namespace app\controllers\admin;

use app\models\admin\LandingPages;
use app\models\AppModel;

class LandingController extends AppController {

    public function indexAction(){
		$landing_pages = \R::findAll('landing_pages', 'ORDER BY title');
        $this->setMeta('Список посадочных страниц');
		$this->set(compact('landing_pages'));
    }

	public function addAction(){
		\R::findAll('landing_pages', 'LIMIT 0');
		if(!empty($_POST)){
			$page = new LandingPages();
			$data = $_POST;
			$page->load($data);

			if(!$page->validate($data)){
				$page->getErrors();
				$_SESSION['pages-data'] = $data;
				redirect();
			}
			if($page->save('landing_pages', false)){
				$_SESSION['success'] = 'Страница добавлена';
				redirect(ADMIN . '/landing');
			}
		}
		$this->setMeta("Добавление страницы");
	}

	public function editAction(){
		if(!empty($_POST)){
			$id = $this->getRequestID(false);
			$page = new LandingPages();
			$data = $_POST;
			$page->load($data);
			if(!$page->validate($data)){
				$page->getErrors();
				redirect();
			}
			if($page->update('landing_pages', $id)){
				$_SESSION['success'] = 'Изменения сохранены';
				redirect();
			}
		}
		$id = $this->getRequestID();
		$page = \R::load('landing_pages', $id);
		$this->setMeta("Редактирование страницы {$page->title}");
		$this->set(compact('page'));
	}

	public function deleteAction(){
		$id = $this->getRequestID();
		$page = \R::load('landing_pages', $id);
		\R::trash($page);
		$_SESSION['success'] = 'Страница удалена';
		redirect();
	}

}
