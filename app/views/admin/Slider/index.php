<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список слайдов
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список слайдов</li>
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
                                <th>Название</th>
                                <th>Изображение</th>
                                <th>Статус</th>
                                <th>Сортировка</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody id="sortable-slider">
                            <?php foreach($slider as $product): ?>
                              <tr  id="<?=$product['id'];?>">
                                <td><?=$product['title'];?></td>
                                <td class="cat-admin-img">
                                  <img src="<?=PATH;?>/images/<?=$product['slider_img'];?>">
                                </td>
                                <td><?=$product['status'] ? 'On' : 'Off';?></td>
                                <td><?=$product['position'];?></td>
                                <td><a href="<?=ADMIN;?>/slider/edit?id=<?=$product['id'];?>"><i class="fa fa-fw fa-eye"></i></a> <a class="delete" href="<?=ADMIN;?>/slider/delete?id=<?=$product['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
                              </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
