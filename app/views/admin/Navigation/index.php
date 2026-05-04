<?php
$ctrl = $alias;

$names = [
	'top'    => 'Навигация',
	'bottom' => 'Футер',
	'mobile' => 'Мобильное меню',
];

$menuName = $names[$position] ?? 'Меню';
?>

<section class="content-header">
	<h1><?= $menuName ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active"><?= $menuName ?></li>
	</ol>
</section>

<section class="content">
	
	<div class="box">
		<div class="box-header">
			<a href="<?= ADMIN ?>/<?= $ctrl ?>/add" class="btn btn-success">
				<i class="fa fa-plus"></i> Добавить пункт
			</a>
		</div>
		
		<div class="box-body">
			
			<?php if (!empty($items)): ?>
				
				<table class="table table-bordered table-hover">
					<thead>
					<tr>
						<th></th>
						<th>Название</th>
						<th>Ссылка</th>
						<th>Порядок</th>
						<th>Видимость</th>
						<th>Действия</th>
					</tr>
					</thead>
					
					<tbody>
					
					<?php foreach ($items as $item): ?>
						
						<?php
						// есть ли у пункта дети?
						$hasChildren = false;
						foreach ($items as $child) {
							if ($child->id_parent == $item->id) {
								$hasChildren = true;
								break;
							}
						}
						?>
						
						<?php if ($hasChildren): ?>
							<!-- Родительский пункт с аккордеоном -->
							<tr>
								<td style="width: 40px;"><i class="fa fa-fw fa-folder" style="color: #f39c12;"></i></td>
								
								<td>
									<a data-toggle="collapse" href="#menu-<?= $item->id ?>">
										<?= htmlspecialchars($item->title) ?> <i class="fa fa-fw fa-chevron-down"></i>
									</a>
								</td>
								
								<td>
									<a href="<?= PATH ?><?= htmlspecialchars($item->link) ?>" target="_blank" class="btn btn-default">
										<i class="fa fa-fw fa-external-link"></i> <?= htmlspecialchars($item->link) ?>
									</a>
								</td>
								<td style="width: 80px;"><?= $item->num ?></td>
								
								<td style="width: 50px;">
									<?php if ($item->visibility): ?>
										<i class="fa fa-fw fa-eye" style="color: #00a65a;"></i>
									<?php else: ?>
										<i class="fa fa-fw fa-eye-slash" style="color: #f56954;"></i>
									<?php endif; ?>
								</td>
								
								<td style="width: 110px;">
									<a href="<?= ADMIN ?>/<?= $ctrl ?>/edit/<?= $item->id ?>" class="btn btn-success">
										<i class="fa fa-pencil"></i>
									</a>
									<a href="<?= ADMIN ?>/<?= $ctrl ?>/delete/<?= $item->id ?>" class="btn btn-danger"
									   onclick="return confirm('Удалить пункт меню?')">
										<i class="fa fa-trash"></i>
									</a>
								</td>
							</tr>
							
							<!-- Дети -->
							<tr class="collapse" id="menu-<?= $item->id ?>">
								<td colspan="7" style="padding: 0;">
									<table class="table table-bordered" style="margin: 0;">
										<?php foreach ($items as $child): ?>
											<?php if ($child->id_parent == $item->id): ?>
												<tr>
													<td style="width: 40px;"><i class="fa fa-fw fa-link" style="color: #b5bbc8;"></i></td>
													
													<td>
														
														<?= htmlspecialchars($child->title) ?>
													</td>
													
													<td>
														<a href="<?= PATH ?><?= htmlspecialchars($child->link) ?>" target="_blank" class="btn btn-default">
															<i class="fa fa-fw fa-external-link"></i> <?= htmlspecialchars($child->link) ?>
														</a>
													</td>
													
													<td style="width: 80px;"><?= $child->num ?></td>
													
													<td style="width: 50px;">
														<?php if ($item->visibility): ?>
															<i class="fa fa-fw fa-eye" style="color: #00a65a;"></i>
														<?php else: ?>
															<i class="fa fa-fw fa-eye-slash" style="color: #f56954;"></i>
														<?php endif; ?>
													</td>
													
													<td style="width: 110px;">
														<a href="<?= ADMIN ?>/<?= $ctrl ?>/edit/<?= $child->id ?>" class="btn btn-success">
															<i class="fa fa-pencil"></i>
														</a>
														<a href="<?= ADMIN ?>/<?= $ctrl ?>/delete/<?= $child->id ?>" class="btn btn-danger"
														   onclick="return confirm('Удалить пункт меню?')">
															<i class="fa fa-trash"></i>
														</a>
													</td>
												</tr>
											<?php endif; ?>
										<?php endforeach; ?>
									</table>
								</td>
							</tr>
						
						<?php else: ?>
							
							<!-- Обычный пункт -->
							<tr>
								<td style="width: 40px;"><i class="fa fa-fw fa-link" style="color: #b5bbc8;"></i></td>
								
								<td>
									<?= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $item->depth) ?>
									<?= htmlspecialchars($item->title) ?>
								</td>
								
								<td>
									<a href="<?= PATH ?><?= htmlspecialchars($item->link) ?>" target="_blank" class="btn btn-default">
										<i class="fa fa-fw fa-external-link"></i> <?= htmlspecialchars($item->link) ?>
									</a>
								</td>
								
								<td style="width: 80px;"><?= $item->num ?></td>
								
								<td style="width: 50px;">
									<?php if ($item->visibility): ?>
										<i class="fa fa-fw fa-eye" style="color: #00a65a;"></i>
									<?php else: ?>
										<i class="fa fa-fw fa-eye-slash" style="color: #f56954;"></i>
									<?php endif; ?>
								</td>
								
								<td style="width: 110px;">
									<a href="<?= ADMIN ?>/<?= $ctrl ?>/edit/<?= $item->id ?>" class="btn btn-success">
										<i class="fa fa-pencil"></i>
									</a>
									<a href="<?= ADMIN ?>/<?= $ctrl ?>/delete/<?= $item->id ?>" class="btn btn-danger"
									   onclick="return confirm('Удалить пункт меню?')">
										<i class="fa fa-trash"></i>
									</a>
								</td>
							</tr>
						
						<?php endif; ?>
					
					<?php endforeach; ?>
					
					</tbody>
				</table>
			
			<?php else: ?>
				
				<p>Пункты меню отсутствуют.</p>
			
			<?php endif; ?>
		
		</div>
	</div>

</section>