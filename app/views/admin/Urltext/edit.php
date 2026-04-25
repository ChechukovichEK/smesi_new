<section class="content-header">
  <h1>Редактирование текста для адреса <?=$url->url?></h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Главная</a></li>
    <li><a href="<?=ADMIN?>/urltext">Список адресов с уникальным текстом</a></li>
    <li class="active">Редактирование адреса <?=$url->url?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form action="<?=ADMIN;?>/urltext/edit" method="post" data-toggle="validator">
          <div class="box-body">

            <div class="form-group has-feedback">
              <label for="url">URL-адрес</label>
              <input type="text" name="url" class="form-control" id="title" placeholder="URL-адрес" required value="<?=h($url->url);?>">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="content">Уникальный текст</label>
                <textarea name="content" id="editor1" rows="10" cols="80"><?=$url->content;?></textarea>
                <div class="help-block with-errors"></div>
            </div>

          </div>
          <div class="box-footer">
            <input type="hidden" name="id" value="<?=$url->id;?>">
            <button type="submit" class="btn btn-success">Сохранить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
