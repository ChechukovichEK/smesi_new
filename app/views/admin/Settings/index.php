<section class="content-header">
	<h1>Настройки сайта</h1>
</section>

<section class="content">
	
	<div class="box">
		<div class="box-body">
			
			<table class="table table-bordered">
				<tr>
					<th>Название</th>
					<th>Значение</th>
				</tr>
				
				<?php foreach ($settings as $name => $value): ?>
					<tr>
						<td><?= $name ?></td>
						<td><?= nl2br(htmlspecialchars($value)) ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
			
			<a href="<?= ADMIN ?>/settings/edit" class="btn btn-primary">
				Редактировать настройки
			</a>
			
			<a href="<?= ADMIN ?>/settings/sitemap" class="btn btn-success" style="margin-left:10px;">
				Сгенерировать sitemap.xml
			</a>
		
		</div>
	</div>

</section>