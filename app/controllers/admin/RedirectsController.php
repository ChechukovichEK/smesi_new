<?php
namespace app\controllers\admin;

use app\models\admin\Redirects;
use ishop\App;
use ishop\libs\Pagination;

class RedirectsController extends AppController {
	
	public function indexAction() {
		
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = 35;
		
		$count = \R::count('redirects');
		
		$pagination = new Pagination($page, $perpage, $count);
		$start = $pagination->getStart();
		
		$redirects = \R::getAll("SELECT * FROM redirects ORDER BY id DESC LIMIT $start, $perpage");
		
		$this->setMeta('Редиректы');
		$this->set(compact('redirects', 'pagination', 'count'));
	}
	
	
	public function addAction(){
		if(!empty($_POST)){
			$redirect = new Redirects();
			$data = $_POST;
			$redirect->load($data);
			
			if(!$redirect->validate($data)){
				$redirect->getErrors();
				$_SESSION['redirects-data'] = $data;
				redirect();
			}
			
			if($id = $redirect->save('redirects')){
				$_SESSION['success'] = 'Редирект добавлен';
			}
			redirect();
		}
		$this->setMeta("Добавление редиректа");
	}
	
	public function editAction(){
		if(!empty($_POST)){
			$id = $this->getRequestID(false);
			$redirect = new Redirects();
			$data = $_POST;
			$redirect->load($data);
			
			if(!$redirect->validate($data)){
				$redirect->getErrors();
				redirect();
			}
			
			if($redirect->update('redirects', $id)){
				$_SESSION['success'] = 'Изменения сохранены';
				redirect();
			}
		}
		
		$id = $this->getRequestID();
		$redirect = \R::load('redirects', $id);
		$this->setMeta("Редактирование редиректа {$redirect->url_from}");
		$this->set(compact('redirect'));
	}
	
	public function deleteAction(){
		$id = $this->getRequestID();
		$redirect = \R::load('redirects', $id);
		\R::trash($redirect);
		$_SESSION['success'] = 'Редирект удалён';
		redirect();
	}
}