<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Добавить слайд
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="<?=ADMIN;?>/slider">Список слайдов</a></li>
    <li class="active">Новый слайд</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form action="<?=ADMIN;?>/slider/add" method="post" data-toggle="validator">
          <div class="box-body">
            <div class="form-group has-feedback">
              <label for="title">Название</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Название" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">
              <label>
                <input type="checkbox" name="status" checked> Отображать
              </label>
            </div>

            <div class="form-group has-feedback">
              <label for="link_url">Ссылка (ссылка должна вести только на материал сайта <?= \ishop\App::$app->getProperty('shop_name'); ?>, размещение внешних ссылок не допускается)</label>
              <input type="text" name="link_url" class="form-control" placeholder="Ссылка">
            </div>

            <div class="form-group has-feedback">
              <label for="background">Фон (применится на пространстве за пределами изображения, прописывать, если фон слайда отличный от белого)</label>
              <input type="text" name="background" class="form-control" placeholder="Фон">
            </div>

            <div class="form-group">
              <div class="col-md-4">
                <div class="box box-primary box-solid file-upload">
                  <div class="box-header">
                    <h3 class="box-title">Изображение 1 (1500х400px)</h3>
                  </div>
                  <div class="box-body">
                    <div id="slider-img1" class="btn btn-success" data-url="/slider/add-image" data-name="slider-img1">Выбрать файл</div>
                    <p><small>Рекомендуемые размеры: 1500х400px</small></p>
                    <div class="slider-img1"></div>
                  </div>
                  <div class="overlay">
                    <i class="fa fa-refresh fa-spin"></i>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                  <div class="box box-primary box-solid file-upload">
                      <div class="box-header">
                          <h3 class="box-title">Изображение 2 (900 х 600 px)</h3>
                      </div>
                      <div class="box-body">
                          <div id="slider-img2" class="btn btn-success" data-url="slider/add-image" data-name="slider-img2">Выбрать файл</div>
                          <p><small>Рекомендуемые размеры: 900х600px</small></p>
                          <div class="slider-img2"></div>
                      </div>
                      <div class="overlay">
                          <i class="fa fa-refresh fa-spin"></i>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="box box-primary box-solid file-upload">
                      <div class="box-header">
                          <h3 class="box-title">Изображение 3 (600 х 600 px)</h3>
                      </div>
                      <div class="box-body">
                          <div id="slider-img3" class="btn btn-success" data-url="slider/add-image" data-name="slider-img3">Выбрать файл</div>
                          <p><small>Рекомендуемые размеры: 600х600px</small></p>
                          <div class="slider-img3"></div>
                      </div>
                      <div class="overlay">
                          <i class="fa fa-refresh fa-spin"></i>
                      </div>
                  </div>
              </div>
            </div>
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-success">Добавить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
