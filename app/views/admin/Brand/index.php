<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Все производители
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active">Список производителей</li>
	</ol>
</section>

<div class="search">
	<form action="<?=ADMIN;?>/brand/search" class="search-form" method="get" autocomplete="off">
		<p>
			<input type="text" class="typeahead" id="typeahead_brand" name="s" placeholder="Поиск">
			<input type="submit" class="search-bg" value=" ">
		</p>
	</form>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Alias</th>
								<th>Страна</th>
								<th>Производитель</th>
								<th>Импортер</th>
								<th>Приоритет</th>
								<th>Главная страница</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($brands as $brand): ?>
                                <tr>
                                    <td><?=$brand['id']?></td>
                                    <td><?=$brand['title']?></td>
                                    <td><?=$brand['alias']?></td>
									<td><?=$brand['country']?></td>
									<td><?=$brand['manufacturer']?></td>
									<td><?=$brand['importer']?></td>
									<td><?=$brand['sort']?></td>
									
									
									<td>
									<? if (!empty($brand['is_home'])): ?>
										Да
									<? else: ?>
										Нет
									<? endif; ?>
									</td>
									<td style="width: 110px;">
										<div class="btn-group">
											<a href="<?=ADMIN;?>/brand/edit?id=<?=$brand['id'];?>"
											   class="btn btn-success"><i class="fa fa-fw fa-pencil"></i></a>
											<a href="<?=ADMIN;?>/brand/delete?id=<?=$brand['id'];?>"
											   class="btn btn-danger" onclick="return confirm('Удалить?')"><i
														class="fa fa-fw fa-trash"></i></a>
										</div>
									</td>
                                </tr>
                            <? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?=count($brands);?> товаров из <?=$count;?>)</p>
						<?php if($pagination->countPages > 1): ?>
							<?=$pagination;?>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>