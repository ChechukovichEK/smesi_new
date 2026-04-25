<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование категории <?=$category->title;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/category">Список категорий</a></li>
        <li class="active"><?=$category->title;?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/category/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование категории</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование категории" value="<?=h($category->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="title">Позиция категории</label>
                            <input type="text" name="position" class="form-control" placeholder="Позиция категории" value="<?=h($category->position);?>">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Родительская категория</label>
                            <?php new \app\widgets\menu\Menu([
                                'tpl' => WWW . '/menu/select.php',
                                'container' => 'select',
                                'cache' => 0,
                                'cacheKey' => 'admin_select',
                                'class' => 'form-control',
                                'attrs' => [
                                    'name' => 'parent_id',
                                    'id' => 'parent_id',
                                ],
                                'prepend' => '<option value="0">Самостоятельная категория</option>',
                            ]) ?>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="meta_title">Meta-title</label>
                            <input type="text" name="meta_title" class="form-control" id="meta_title"
                                   placeholder="Meta-title"
                                   maxlength="500"
                                   value="<?= h($category->meta_title); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="meta_desc">Meta-description</label>
                            <input type="text" name="meta_desc" class="form-control" id="meta_desc"
                                   placeholder="Meta-description"
                                   maxlength="500"
                                   value="<?= h($category->meta_desc); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="short_text">Краткое описание</label>
                            <input type="text" name="short_text" class="form-control" placeholder="Краткое описание" value="<?= h($category->short_text); ?>">
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Описание</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?=$category->content;?></textarea>
                        </div>

                        <div class="form-group">
                          <div class="col-md-4">
                            <div class="box box-primary box-solid file-upload">
                              <div class="box-header">
                                <h3 class="box-title">Изображение</h3>
                              </div>
                              <div class="box-body">
                                <div id="base-img" class="btn btn-success" data-url="/category/add-image" data-name="base-img">Выбрать файл</div>
                                <p><small>Рекомендуемые размеры: 87х54</small></p>
                                <div class="base-img">
                                  <img src="<?=PATH;?>/images/<?=$category->img?>" style="max-height:150px;" data-id="<?=$category->id;?>" data-src="<?=$category->img;?>" class="del-item">
                                </div>
                              </div>
                              <div class="overlay">
                                <i class="fa fa-refresh fa-spin"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-4">
                            <div class="box box-primary box-solid file-upload">
                              <div class="box-header">
                                <h3 class="box-title">Иконка</h3>
                              </div>
                              <div class="box-body">
                                <div id="icon-img" class="btn btn-success" data-url="/category/add-image" data-name="icon-img">Выбрать файл</div>
                                <p><small>Рекомендуемые размеры: 87х54</small></p>
                                <div class="icon-img" id="admin-icon">
                                  <?php if (!empty($category->icon)): ?>
                                    <img src="<?=PATH;?>/images/<?=$category->icon?>" style="max-height:150px;" data-id="<?=$category->id;?>" data-src="<?=$category->icon;?>" class="del-item">
                                  <?php endif; ?>
                                </div>
                              </div>
                              <div class="overlay">
                                <i class="fa fa-refresh fa-spin"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$category->id;?>">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php if(isset($child_cats) && !empty($child_cats)): ?>
<section class="content-header">
    <h1>
        Список дочерних групп (для сортировки перетащите строку на нужную позицию)
    </h1>
</section>
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
                                <th>Наименование</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody id="sortable_cats">
                            <?php foreach($child_cats as $product): ?>
                                <tr id="<?=$product['id'];?>">
                                    <td><?=$product['title'];?></td>
                                    <td><a href="<?=ADMIN;?>/category/edit?id=<?=$product['id'];?>"><i class="fa fa-fw fa-eye"></i></a> <a class="delete" href="<?=ADMIN;?>/category/delete?id=<?=$product['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
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
<?php endif; ?>

<section class="content-header">
    <h1>
        Фильтры категории
    </h1>
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
                                <th>Группа</th>
                                <th>Значение</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody id="sortable-attrs">
                            <?php foreach($filter_group as $key => $value): ?>
                              <?php foreach ($cat_values as $i => $item): ?>
                                <?php if ($item['attr_group_id'] == $key): ?>
                                  <tr id="<?=$i;?>">
                                    <td><?=$value;?></td>
                                    <td><?=$item['value'];?></td>
                                    <td>
                                        <a href="<?=ADMIN;?>/filter/attribute-edit?id=<?=$i;?>"><i class="fa fa-fw fa-pencil"></i></a>
                                        <a class="delete text-danger" href="<?=ADMIN;?>/filter/attribute-delete?id=<?=$i;?>"><i class="fa fa-fw fa-close text-danger"></i></a>
                                    </td>
                                  </tr>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="content-header">
    <h1>
        Список товаров группы
    </h1>
</section>

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
                                <th>Изображение</th>
                                <th>Наименование</th>
                                <th>Цена</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody <?php if ($category->parent_id == 0): ?>
                              <?='id="all_sortable"'?>
                              <?php else: ?>
                              <?='id="sortable"'?>
                            <?php endif; ?>>
                            <?php foreach($products as $product): ?>
                                <tr id="<?=$product['id'];?>">
                                    <td><?=$product['id'];?></td>
                                    <td class="cat-admin-img"><img src="<?=PATH;?>/prodimg/<?=$product['img'];?>"></td>

                                    <td><?=$product['title'];?></td>
                                    <td><?=$product['price'];?></td>
                                    <td><?=$product['status'] ? 'On' : 'Off';?></td>
                                    <td><a href="<?=ADMIN;?>/product/edit?id=<?=$product['id'];?>"><i class="fa fa-fw fa-eye"></i></a> <a class="delete" href="<?=ADMIN;?>/product/delete?id=<?=$product['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
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
