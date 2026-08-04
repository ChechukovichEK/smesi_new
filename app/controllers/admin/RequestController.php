<?php

namespace app\controllers\admin;

use ishop\libs\Pagination;

class RequestController extends AppController
{

	public function indexAction()
	{
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = 20;
		$count = \R::count('requests');
		$pagination = new Pagination($page, $perpage, $count);
		$start = $pagination->getStart();

		$requests = \R::getAll("SELECT `requests`.* FROM `requests` ORDER BY `requests`.`id` DESC LIMIT $start, $perpage");

		$this->setMeta('Заявки с сайта');
		$this->set(compact('requests', 'pagination', 'count'));
	}

	public function deleteAction() {
		$id = $this->getRequestID();
		$requests = \R::load('requests', $id);
		\R::trash($requests);
		$_SESSION['success'] = 'Запись удалена';
		redirect(ADMIN . '/request');
	}

}