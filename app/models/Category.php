<?php

namespace app\models;

use ishop\App;
use R;

class Category extends AppModel
{
	public function getCategoryTreeIds(int $id): array
	{
		$cats = App::$app->getProperty('cats');
		$result = [];
		
		$stack = [$id];
		
		while ($stack) {
			$current = array_pop($stack);
			foreach ($cats as $k => $v) {
				if ((int)$v['parent_id'] === $current) {
					$result[] = (int)$k;
					$stack[] = (int)$k;
				}
			}
		}
		
		return array_unique($result);
	}
	
	public function getCategoryProductIds(array $catIds): array
	{
		if (empty($catIds)) return [];
		
		$placeholders = implode(',', array_fill(0, count($catIds), '?'));
		$rows = R::getAll("
            SELECT DISTINCT prod_id
            FROM cat_product
            WHERE cat_id IN ($placeholders)
        ", $catIds);
		
		return array_map(fn($r) => (int)$r['prod_id'], $rows);
	}
	
	public function getGroups(int $categoryId): array
	{
		return R::getAssoc(
			"SELECT id, title FROM attribute_group WHERE parent_cat_id = ?",
			[$categoryId]
		);
	}
	
	public static function getAttrs(): array
	{
		$data = R::getAll('SELECT id, attr_group_id, value FROM attribute_value ORDER BY position');
		$attrs = [];
		foreach ($data as $row) {
			$attrs[(int)$row['attr_group_id']][(int)$row['id']] = $row['value'];
		}
		return $attrs;
	}
	
	public function getCatAttrs(int $groupId): array
	{
		return R::getAssoc(
			"SELECT id, value FROM attribute_value WHERE attr_group_id = ? ORDER BY position",
			[$groupId]
		);
	}
	
	public function getCatValues(array $filterGroup): array
	{
		$catValues = [];
		foreach ($filterGroup as $groupId => $title) {
			$attrs = $this->getCatAttrs((int)$groupId);
			foreach ($attrs as $id => $value) {
				$catValues[(int)$id] = $value;
			}
		}
		return $catValues;
	}
	
	/** Нормализация фильтра: лендинг + GET → массив ID */
	public function normalizeFilter(?string $landingFilter = null): ?array
	{
		$result = [];
		
		if (!empty($landingFilter)) {
			$clean = trim(preg_replace('#[^\d,]+#', '', $landingFilter), ',');
			if ($clean !== '') {
				$result = array_merge($result, explode(',', $clean));
			}
		}
		
		if (!empty($_GET['filter'])) {
			$getFilter = $_GET['filter'];
			if (is_array($getFilter)) {
				$getFilter = implode(',', $getFilter);
			}
			$clean = trim(preg_replace('#[^\d,]+#', '', $getFilter), ',');
			if ($clean !== '') {
				$result = array_merge($result, explode(',', $clean));
			}
		}
		
		$result = array_unique(array_filter(array_map('intval', $result)));
		
		return !empty($result) ? $result : null;
	}
	
	/** Список сортировок */
	public function getSortList(): array
	{
		return [
			'price_asc'     => ['title' => 'Цена ↑',            'sql' => 'price ASC'],
			'price_desc'    => ['title' => 'Цена ↓',            'sql' => 'price DESC'],
			'discount_desc' => ['title' => 'Сначала со скидкой','sql' => 'discount DESC, price ASC'],
			'hit'           => ['title' => 'Популярные',        'sql' => 'hit DESC, id DESC'],
		];
	}
	
	/** Текущая сортировка из GET */
	public function getActiveSort(): string
	{
		$sort = $_GET['sort'] ?? 'hit';
		$list = $this->getSortList();
		return array_key_exists($sort, $list) ? $sort : 'hit';
	}
	
	/** SQL для сортировки */
	public function getSortSql(string $sort): string
	{
		$list = $this->getSortList();
		return 'ORDER BY ' . $list[$sort]['sql'];
	}
	
	/** SQL‑фильтр по атрибутам */
	public function buildFilterSql(?array $filterIds): array
	{
		if (empty($filterIds)) {
			return ['', ''];
		}
		
		$filterIds = array_map('intval', $filterIds);
		$placeholders = implode(',', $filterIds);
		
		// считаем количество групп, в которых есть выбранные атрибуты
		$attrs = self::getAttrs();
		$groups = [];
		foreach ($attrs as $groupId => $items) {
			foreach ($items as $attrId => $value) {
				if (in_array($attrId, $filterIds, true)) {
					$groups[] = (int)$groupId;
					break;
				}
			}
		}
		$cnt = count(array_unique($groups));
		
		if ($cnt === 0) {
			return ['', ''];
		}
		
		$sqlProducts = "AND id IN (
            SELECT product_id
            FROM attribute_product
            WHERE attr_id IN ($placeholders)
            GROUP BY product_id
            HAVING COUNT(DISTINCT attr_id) >= $cnt
        )";
		
		$sqlCatProducts = "AND prod_id IN (
            SELECT product_id
            FROM attribute_product
            WHERE attr_id IN ($placeholders)
            GROUP BY product_id
            HAVING COUNT(DISTINCT attr_id) >= $cnt
        )";
		
		return [$sqlProducts, $sqlCatProducts];
	}
	
	public function getFilterMeta(array $filterIds): ?string
	{
		if (empty($filterIds)) return null;
		
		$placeholders = implode(',', array_fill(0, count($filterIds), '?'));
		$rows = R::getAll(
			"SELECT value FROM attribute_value WHERE id IN ($placeholders)",
			$filterIds
		);
		
		$values = array_map(fn($r) => $r['value'], $rows);
		$values = array_filter($values);
		
		return !empty($values) ? implode(', ', $values) : null;
	}
}
