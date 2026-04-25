<section class="content-header">
  <h1>Добавление уникального текста</h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Главная</a></li>
    <li><a href="<?=ADMIN?>/urltext">Список уникальных текстов</a></li>
    <li class="active">Добавление уникального текста</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form action="<?=ADMIN;?>/urltext/add" method="post" data-toggle="validator">
          <div class="box-body">

            <div class="form-group has-feedback">
              <label for="url">URL-адрес</label>
              <input type="text" name="url" class="form-control" placeholder="URL-адрес" required value="<?php isset ($_SESSION['url_data']['url']) ? h($_SESSION['url_data']['url']) : null; ?>">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">
                <label for="content">Уникальный текст</label>
                <textarea name="content" id="editor1" rows="10" cols="80">
                  <?php if(isset($_SESSION['url_data']['content'])){
                    echo $_SESSION['url_data']['content'];
                  }
                  ?>
                </textarea>
                <div class="help-block with-errors"></div>
            </div>

          </div>
          <div class="box-footer">
              <button type="submit" class="btn btn-success">Добавить</button>
          </div>
        </form>
        <?php if (isset ($_SESSION['url_data'])) unset ($_SESSION['url_data']); ?>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
