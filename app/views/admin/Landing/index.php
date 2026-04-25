<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список посадочных страниц
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список посадочных страниц</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <?php foreach ($landing_pages as $item): ?>
                        <p class="item-p">
                            <a class="list-group-item" href="<?=ADMIN;?>/landing/edit?id=<?=$item['id'];?>"><?=$item['title'];?></a>
                            <span><a href="<?=ADMIN;?>/landing/delete?id=<?=$item['id'];?>" class="delete text-danger"><i class="fa fa-fw fa-close text-danger"></i></a></span>
                        </p>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->