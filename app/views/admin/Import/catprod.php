<?php if ((isset($_SESSION['user'])) && ($_SESSION['user']['role'] == 'admin')): ?>
  <section class="content-header">
    <h1>Импорт группа-продукт</h1>
    <ol class="breadcrumb">
      <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Главная</a></li>
    </ol>
  </section>


  <section class="content">
    <div class="row">
      <div class="form-group">
        <div class="col-md-4">
          <div class="box box-primary box-solid file-upload">
            <div class="box-header">
              <h3 class="box-title">Файл импорта</h3>
            </div>
            <div class="box-body">
              <form action="<?=ADMIN;?>/import/catprod" method="POST" enctype="multipart/form-data">
          			 <p>Выберите файл для загрузки <input type="file" name="xls"/></p>
          			 <input type="submit" value="Отправить"/>
              </form>
            </div>
            <div class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php else: ?>
  <section class="content-header">
      <h1>
          У Вас нет доступа в данный раздел
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
      </ol>
  </section>
<?php endif; ?>
