<?php

namespace app\models;

use app\models\AppModel;

class Navigation extends AppModel
{
	protected $table = 'navigation';
	
	public function getAll($position)
	{
		return \R::findAll(
			$this->table,
			"position = ? AND visibility = 1 ORDER BY num desc",
			[$position]
		);
	}
}