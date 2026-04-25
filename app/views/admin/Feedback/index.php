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
                                <th>Тип</th>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Текст</th>
                                <th>Дата</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($feedbacks as $feedback): ?>
                            <tr>
                                <td><?=$feedback['id'];?></td>
                                <td><?=$feedback['type'];?></td>
                                <td><?=$feedback['name'];?></td>
                                <td><?=$feedback['phone'];?></td>
                                <td><?=$feedback['text'];?></td>
                                <td><?=$feedback['created_at'];?></td>
                                <td>
                                    <a class="delete" href="<?=ADMIN;?>/feedback/delete?id=<?=$feedback['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a>
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