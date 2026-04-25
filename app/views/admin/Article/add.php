<section class="content-header">
  <h1>Добавление статьи</h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Главная</a></li>
    <li><a href="<?=ADMIN?>/news">Список статей</a></li>
    <li class="active">Добавление статьи</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form action="<?=ADMIN;?>/article/add" method="post" data-toggle="validator">
          <div class="box-body">

            <div class="form-group has-feedback">
              <label for="title">Название</label>
              <input type="text" name="title" class="form-control" placeholder="Название новости" required value="<?php isset ($_SESSION['news_data']['title']) ? h($_SESSION['news_data']['title']) : null; ?>">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">
              <label for="title">Дата</label>
              <input type="date" name="date" class="form-control" placeholder="Дата" value="<?php isset ($_SESSION['news_data']['date']) ? h($_SESSION['news_data']['date']) : null; ?>">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">
                <label for="description">Вступительный текст</label>
                <input type="text" name="pre_content" class="form-control" id="pre_content" placeholder="Вступительный текст" value="<?php isset ($_SESSION['news_data']['pre_content']) ? h($_SESSION['news_data']['pre_content']) : null; ?>">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">
                <label for="content">Контент (оборачиваем в тег div с классом desc-content)</label>
                <textarea name="content" id="editor1" rows="10" cols="80">
                  <?php if(isset($_SESSION['news_data']['content'])){
                    echo $_SESSION['news_data']['content'];
                  }
                  ?>
                </textarea>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <div class="col-md-4">
                <div class="box box-primary box-solid file-upload">
                  <div class="box-header">
                    <h3 class="box-title">Изображение</h3>
                  </div>
                  <div class="box-body">
                    <div id="newsimg" class="btn btn-success" data-url="/article/add-image" data-name="newsimg">Выбрать файл</div>
                    <p><small>Рекомендуемые размеры: </small></p>
                    <div class="newsimg"></div>
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
        <?php if (isset ($_SESSION['news_data'])) unset ($_SESSION['news_data']); ?>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
