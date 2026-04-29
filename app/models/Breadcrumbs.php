<?php

namespace app\models;

use ishop\App;

class Breadcrumbs
{
	
	public static function getBreadcrumbs($category_id, $cur_alias, $name = '')
	{
		$cats = App::$app->getProperty('cats');
		$breadcrumbs_array = self::getParts($cats, $category_id);
		
		$position = 1;
		$breadcrumbs = '';
		
		// Главная
		$breadcrumbs .= "
    <li itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
        <a itemprop='item' href='" . PATH . "'>
            <span itemprop='name'>Главная</span>
        </a>
        <meta itemprop='position' content='{$position}' />
    </li>";
		$position++;
		
		// Каталог (добавляем вручную)
		$breadcrumbs .= "
    <li itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
        <a itemprop='item' href='" . PATH . "/catalog'>
            <span itemprop='name'>Каталог</span>
        </a>
        <meta itemprop='position' content='{$position}' />
    </li>";
		$position++;
		
		// Категории
		if ($breadcrumbs_array) {
			foreach ($breadcrumbs_array as $alias => $title) {
				if ($cur_alias == $alias) {
					// текущая категория
					$breadcrumbs .= "
                <li class='current-crumb' itemprop='itemListElement'
                    itemscope itemtype='https://schema.org/ListItem'>
                    <span itemprop='name'>{$title}</span>
                    <meta itemprop='position' content='{$position}' />
                </li>";
				} else {
					// обычная категория
					$breadcrumbs .= "
                <li itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
                    <a itemprop='item' href='" . PATH . "/category/{$alias}'>
                        <span itemprop='name'>{$title}</span>
                    </a>
                    <meta itemprop='position' content='{$position}' />
                </li>";
				}
				$position++;
			}
		}
		
		// Последний элемент (например, товар)
		if ($name) {
			$breadcrumbs .= "
        <li class='current-crumb' itemprop='itemListElement'
            itemscope itemtype='https://schema.org/ListItem'>
            <span itemprop='name'>{$name}</span>
            <meta itemprop='position' content='{$position}' />
        </li>";
		}
		
		return $breadcrumbs;
	}

    public static function getParts($cats, $id)
    {
        if (!$id) return false;
        $breadcrumbs = [];
        foreach ($cats as $k => $v) {
            if (isset($cats[$id])) {
                $breadcrumbs[$cats[$id]['alias']] = $cats[$id]['title'];
                $id = $cats[$id]['parent_id'];
            } else break;
        }
        return array_reverse($breadcrumbs, true);
    }

}
