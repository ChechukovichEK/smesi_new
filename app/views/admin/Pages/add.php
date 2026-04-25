<section class="content-header">
  <h1>Добавление страницы</h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Главная</a></li>
    <li><a href="<?=ADMIN?>/pages">Страницы</a></li>
    <li class="active">Добавление страницы</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form action="<?=ADMIN;?>/pages/add" method="post" data-toggle="validator">
          <div class="box-body">

            <div class="form-group has-feedback">
              <label for="title">Название</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Название страницы" required value="<?php isset ($_SESSION['pages_data']['title']) ? h($_SESSION['pages_data']['title']) : null; ?>">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
              <label for="position">Позиция</label>
              <input type="text" name="position" class="form-control" id="position" placeholder="Позиция страницы" value="<?php isset ($_SESSION['pages_data']['position']) ? h($_SESSION['pages_data']['position']) : null; ?>">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">
                <label for="content">Контент</label>
                <textarea name="content" id="editor1" rows="10" cols="80">
                  <?php if(isset($_SESSION['pages_data']['content'])){
                    echo $_SESSION['pages_data']['content'];
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
        <?php if (isset ($_SESSION['pages_data'])) unset ($_SESSION['pages_data']); ?>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
