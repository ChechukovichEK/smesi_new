<?php

namespace app\models\admin;

use app\models\AppModel;

class Navigation extends AppModel
{
	protected $table = 'navigation';
	
	/**
	 * Получить пункты меню для админки (все, включая скрытые)
	 */
	public function getAllAdmin(string $position = 'top')
	{
		return \R::findAll(
			$this->table,
			"position = ? ORDER BY num desc",
			[$position]
		);
	}
	
	/**
	 * Получить пункты меню для фронта (только видимые)
	 */
	public function getAll(string $position = 'top')
	{
		return \R::findAll(
			$this->table,
			"position = ? AND visibility = 1 ORDER BY num desc",
			[$position]
		);
	}
	
	/**
	 * Получить один пункт меню
	 */
	public function getById(int $id)
	{
		return \R::load($this->table, $id);
	}
	
	/**
	 * Сохранение / обновление пункта меню
	 */
	public function saveItem(array $data)
	{
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		
		if ($id) {
			$item = \R::load($this->table, $id);
		} else {
			$item = \R::dispense($this->table);
		}
		
		$item->id_parent  = $data['id_parent'] ?? 0;
		$item->position   = $data['position'] ?? 'top';   // top / bottom / mobile
		$item->title      = $data['title'] ?? '';
		$item->link       = $data['link'] ?? '';
		$item->visibility = isset($data['visibility']) ? 1 : 0;
		$item->num        = $data['num'] ?? 1;
		$item->target     = $data['target'] ?? '_self';
		$item->noindex    = isset($data['noindex']) ? 1 : 0;
		
		return \R::store($item);
	}
	
	/**
	 * Удаление пункта меню
	 */
	public function deleteItem(int $id): bool
	{
		$item = \R::load($this->table, $id);
		
		if ($item->id) {
			\R::trash($item);
			return true;
		}
		
		return false;
	}
}