<?php

namespace app\controllers\admin;

use ishop\libs\Pagination;

class FeedbackController extends AppController
{

	public function indexAction()
	{
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = 20;
		$count = \R::count('feedback');
		$pagination = new Pagination($page, $perpage, $count);
		$start = $pagination->getStart();

		$feedbacks = \R::getAll("SELECT `feedback`.* FROM `feedback` ORDER BY `feedback`.`id` DESC LIMIT $start, $perpage");

		$this->setMeta('Заявки с сайта');
		$this->set(compact('feedbacks', 'pagination', 'count'));
	}

	public function deleteAction() {
		$id = $this->getRequestID();
		$feedback = \R::load('feedback', $id);
		\R::trash($feedback);
		$_SESSION['success'] = 'Запись удалена';
		redirect(ADMIN . '/feedback');
	}

}