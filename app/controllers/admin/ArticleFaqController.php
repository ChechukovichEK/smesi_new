<?php

namespace app\controllers\admin;

use app\models\admin\Article_faq;

class ArticleFaqController extends AppController
{
	public function indexAction()
	{
		$id_article = $this->getRequestID();
		$faq = \R::findAll('articlefaq', 'id_article = ? ORDER BY num DESC', [$id_article]);
		
		$this->setMeta("FAQ статьи");
		$this->set(compact('faq', 'id_article'));
	}
	
	public function addAction()
	{
		$id_article = $this->getRequestID();
		
		if (!empty($_POST)) {
			$faq = new Article_faq();
			$data = $_POST;
			$data['id_article'] = $id_article;
			
			$faq->load($data);
			
			if (!$faq->validate($data)) {
				$faq->getErrors();
				redirect();
			}
			
			$faq->beforeSave();
			$faq->save('articlefaq');
			
			$_SESSION['success'] = 'FAQ добавлен';
			redirect();
		}
		
		$this->setMeta("Добавить FAQ");
		$this->set(compact('id_article'));
	}
	
	public function editAction()
	{
		$id = $this->getRequestID();
		
		if (!empty($_POST)) {
			$faq = new Article_faq();
			$data = $_POST;
			
			$faq->load($data);
			
			if (!$faq->validate($data)) {
				$faq->getErrors();
				redirect();
			}
			
			$faq->beforeSave();
			$faq->update('articlefaq', $id);
			
			$_SESSION['success'] = 'FAQ обновлён';
			redirect();
		}
		
		$faq = \R::load('articlefaq', $id);
		$id_article = $faq->id_article;
		
		$this->setMeta("Редактирование FAQ");
		$this->set(compact('faq', 'id_article'));
		
	}
	
	public function deleteAction()
	{
		$id = $this->getRequestID();
		$faq = \R::load('articlefaq', $id);
		\R::trash($faq);
		
		$_SESSION['success'] = 'FAQ удалён';
		redirect();
	}
}