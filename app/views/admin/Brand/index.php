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
									<td><?=$brand['sort']?>
									<td>
									<? if (!empty($brand['is_home'])): ?>
										Да
									<? else: ?>
										Нет
									<? endif; ?>
									</td>
                                    <td>
                                        <a href="<?=ADMIN;?>/brand/edit?id=<?=$brand['id'];?>"><i class="fa fa-fw fa-eye"></i></a>
                                        <a class="delete" href="<?=ADMIN;?>/brand/delete?id=<?=$brand['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a>
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