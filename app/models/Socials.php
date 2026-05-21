<?php

namespace app\models;

use app\models\AppModel;

class Socials extends AppModel
{
	protected $table = 'socials';
	
	public function getPublished()
	{
		return \R::findAll(
			$this->table,
			"is_published = 1 ORDER BY sort desc"
		);
	}
	
}