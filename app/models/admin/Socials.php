<?php

namespace app\models\admin;

use app\models\AppModel;

class Socials extends AppModel
{
	public $attributes = [
		'key' => '',
		'link' => '',
		'sort' => 1,
		'is_published' => 1,
	];
	
	public $rules = [
		'required' => [
			['key'],
			['link'],
		],
	];
	
	public static function keysList()
	{
		return [
			'facebook' => 'Facebook',
			'instagram' => 'Instagram',
			'vk' => 'ВКонтакте',
			'youtube' => 'YouTube',
			'telegram' => 'Telegram',
			'tiktok' => 'TikTok',
			'whatsapp' => 'WhatsApp',
		];
	}
}