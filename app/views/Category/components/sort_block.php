<?php
$activeSort = $_GET['sort'] ?? 'hit';
$activeSortTitle = 'Популярные';

foreach ($sortList as $item) {
	if ($item['value'] === $activeSort) {
		$activeSortTitle = $item['title'];
		break;
	}
}
?>

<div class="sort">
	<label class="label">Сортировка:</label>
	
	<div class="dropdown" data-dropdown>
		<div class="dropdown-label" data-dropdown-label>
			<?= $activeSortTitle ?>
		</div>
		
		<div class="dropdown-list">
			<?php foreach($sortList as $item): ?>
				<label class="dropdown-checker">
					<input type="radio" name="sort" value="<?= $item['value'] ?>"
						<?= $activeSort == $item['value'] ? 'checked' : '' ?>
						   data-dropdown-input>
					<span class="dropdown-item" data-dropdown-item><?= $item['title'] ?></span>
				</label>
			<?php endforeach; ?>
		</div>
	</div>
</div>