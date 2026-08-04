<section class="content-header">
	<h1>
		<?=$this->meta['title'];?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
		<li class="active"><?=$this->meta['title'];?></li>
	</ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Адрес</th>
								<th>Сообщение</th>
								<th>Файл</th>
                                <th>Дата</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($requests as $request): ?>
                            <tr>
                                <td><?=$request['id'];?></td>
                                <td><?=$request['surname'];?></td>
                                <td><?=$request['name'];?></td>
                                <td><?=$request['phone'];?></td>
                                <td><?=$request['address'];?></td>
								<td><?=$request['message'];?></td>
								<td><a href="<?=PATH?>/uploads/requests/<?=$request['file'];?>"><?=$request['file'];?></a></td>
                                <td><?=$request['created_at'];?></td>
                                <td>
                                    <a class="delete" href="<?=ADMIN;?>/request/delete?id=<?=$request['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a>
                                </td>
                            </tr>
                            <? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
						<?php if($pagination->countPages > 1): ?>
							<?=$pagination;?>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>