<?php

namespace app\controllers\admin;

use app\models\admin\Navigation;
use stroy\App;

class NavigationController extends AppController
{
	protected string $position = 'top';
	protected string $alias = 'navigation';
	
	public function __construct($route)
	{
		parent::__construct($route);
		
		// alias из маршрута
		$this->alias = $route['ctrl_alias'] ?? 'navigation';
		
		// соответствие alias → позиции
		$map = [
			'navigation'         => 'top',
			'navigation_footer'  => 'bottom',
			'navigation_mobile'  => 'mobile',
		];
		
		$this->position = $map[$this->alias] ?? 'top';
	}
	
	public function indexAction()
	{
		$model = new Navigation();
		$items = $model->getAllAdmin($this->position);
		
		$this->setMeta("Меню ({$this->position})");
		$this->set([
			'items'     => $items,
			'position'  => $this->position,
			'alias'     => $this->alias,
		]);
	}
	
	public function addAction()
	{
		$model = new Navigation();
		$parents = $model->getAllAdmin($this->position);
		
		if (!empty($_POST)) {
			$_POST['position'] = $this->position;
			$model->saveItem($_POST);
			$_SESSION['success'] = 'Пункт меню добавлен';
			redirect(ADMIN . "/{$this->alias}");
		}
		
		$this->setMeta("Добавить пункт ({$this->position})");
		$this->set([
			'position' => $this->position,
			'alias'    => $this->alias,
			'parents'  => $parents,
		]);
	}
	
	public function editAction()
	{
		$id = $this->route['id'];
		
		$model = new Navigation();
		$item = $model->getById($id);
		$parents = $model->getAllAdmin($this->position);
		
		if (!$item->id) {
			throw new \Exception('Пункт меню не найден', 404);
		}
		
		if (!empty($_POST)) {
			$_POST['id'] = $id;
			$_POST['position'] = $this->position;
			$model->saveItem($_POST);
			$_SESSION['success'] = 'Изменения сохранены';
			redirect(ADMIN . "/{$this->alias}");
		}
		
		$this->setMeta("Редактирование ({$this->position})");
		$this->set([
			'item'     => $item,
			'position' => $this->position,
			'alias'    => $this->alias,
			'parents'  => $parents,
		]);
	}
	
	public function deleteAction()
	{
		$id = $this->route['id'];
		
		$model = new Navigation();
		$model->deleteItem($id);
		
		$_SESSION['success'] = 'Пункт меню удалён';
		redirect(ADMIN . "/{$this->alias}");
	}
}