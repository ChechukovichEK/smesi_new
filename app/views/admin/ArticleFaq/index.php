<section class="content-header">
  <h1>Список новостей</h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Главная</a></li>
    <li class="active">Список статей</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <?php foreach ($news as $item): ?>
            <p class="item-p">
              <a class="list-group-item" href="<?=ADMIN;?>/article/edit?id=<?=$item['id'];?>"><?=$item['title'];?></a>
              <span><a href="<?=ADMIN;?>/article/delete?id=<?=$item['id'];?>" class="delete text-danger"><i class="fa fa-fw fa-close text-danger"></i></a></span>
            </p>

          <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>
<!-- /.content -->
