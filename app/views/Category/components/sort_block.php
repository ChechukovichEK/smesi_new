<?php
/** @var array $sortList */
/** @var string $activeSort */

$activeSortTitle = $sortList[$activeSort]['title'] ?? 'Популярные';
?>

<div class="sort">
	<label class="label">Сортировка:</label>
	
	<div class="dropdown" data-dropdown>
		<div class="dropdown-label" data-dropdown-label>
			<?= htmlspecialchars($activeSortTitle, ENT_QUOTES, 'UTF-8') ?>
		</div>
		
		<div class="dropdown-list">
			<?php foreach ($sortList as $value => $item): ?>
				<label class="dropdown-checker">
					<input type="radio" name="sort" value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>"
						<?= $activeSort === $value ? 'checked' : '' ?>
							data-dropdown-input
					>
					<span class="dropdown-item" data-dropdown-item>
                        <?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?>
                    </span>
				</label>
			<?php endforeach; ?>
		</div>
	</div>
</div>
