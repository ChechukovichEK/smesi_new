<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Редактировать группу параметров для товара <?=$group_inf->title;?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="<?=ADMIN;?>/params/groups-view">Группы параметров</a></li>
    <li class="active">Редактировать группу параметров</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form action="<?=ADMIN;?>/paramgroup/group-edit" method="post" data-toggle="validator">
          <div class="box-body">
            <div class="form-group has-feedback">
                <label for="title">Тип параметров</label>
                <input type="text" name="title" class="form-control" placeholder="Тип параметров" value="<?=h($group_inf->title);?>" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
                <label for="prod_desc">Название группы</label>
                <input type="text" name="prod_desc" class="form-control" placeholder="Название группы"  value="<?=h($group_inf->prod_desc);?>">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group" id="dop_cats">
              <label for="params">Параметры</label>
              <select name="params[]" class="form-control selectattrs" multiple>
                <?php if(!empty($dop_params)): ?>
                  <?php foreach($dop_params as $item): ?>
                    <option value="<?=$item['param_id'];?>" selected><?=$item['attr_title'];?> - <?=$item['value'];?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>

            <div class="form-group" id="dop_cats">
              <label for="param_products">Товары</label>
              <select name="param_products[]" class="form-control select2" multiple>
                <?php if(!empty($dop_prods)): ?>
                  <?php foreach($dop_prods as $item): ?>
                    <option value="<?=$item['prod_id'];?>" selected><?=$item['title'];?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>

          <div class="box-footer">
            <input type="hidden" name="id" value="<?=$group_inf->id;?>">
            <button type="submit" class="btn btn-success">Сохранить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
<!-- /.content -->

<?php if(isset($dop_params) && !empty($dop_params)): ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($dop_params as $product): ?>
                                <tr>
                                    <td><?=$product['param_id'];?></td>
                                    <td><?=$product['attr_title'];?> - <?=$product['value'];?></td>
                                    <td><a href="<?=ADMIN;?>/filter/attribute-edit?id=<?=$product['param_id'];?>"><i class="fa fa-fw fa-eye"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="<?=ADMIN;?>/params/group-add" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Добавить группу параметров</a>

</section>


<?php endif; ?>
<!-- /.content -->
