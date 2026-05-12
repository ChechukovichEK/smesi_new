<?php

namespace app\controllers\admin;

use app\models\admin\Socials;
use ishop\App;

class SocialsController extends AppController
{
	public function indexAction()
	{
		$socials = \R::findAll('socials', 'ORDER BY sort desc');
		$this->setMeta('Соц. сети');
		$this->set(compact('socials'));
	}
	
	public function addAction()
	{
		if (!empty($_POST)) {
			$model = new Socials();
			$data = $_POST;
			$model->load($data);
			
			if (!$model->validate($data)) {
				$model->getErrors();
				redirect();
			}
			
			if ($model->save('socials')) {
				$_SESSION['success'] = 'Соц. сеть добавлена';
			} else {
				$_SESSION['error'] = 'Ошибка добавления';
			}
			
			redirect(ADMIN . '/socials');
		}
		
		$this->setMeta('Добавить соц. сеть');
	}
	
	public function editAction()
	{
		$id = $this->getRequestID();
		$social = \R::load('socials', $id);
		
		if (!$social) {
			throw new \Exception('Соц. сеть не найдена', 404);
		}
		
		if (!empty($_POST)) {
			$model = new Socials();
			$data = $_POST;
			$model->load($data);
			
			if (!$model->validate($data)) {
				$model->getErrors();
				redirect();
			}
			
			$social->key = $data['key'];
			$social->link = $data['link'];
			$social->sort = (int)$data['sort'];
			$social->is_published = isset($data['is_published']) ? 1 : 0;
			
			\R::store($social);
			
			$_SESSION['success'] = 'Изменения сохранены';
			redirect(ADMIN . '/socials');
		}
		
		$this->setMeta('Редактировать соц. сеть');
		$this->set(compact('social'));
	}
	
	public function deleteAction()
	{
		$id = $this->getRequestID();
		$social = \R::load('socials', $id);
		
		if (!$social) {
			throw new \Exception('Соц. сеть не найдена', 404);
		}
		
		\R::trash($social);
		$_SESSION['success'] = 'Соц. сеть удалена';
		redirect(ADMIN . '/socials');
	}
}