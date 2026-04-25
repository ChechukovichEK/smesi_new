<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование товара <?=$product->title;?>
    </h1>
    <p> ID - <?=$product->id;?></p>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/product">Список товаров</a></li>
        <li class="active">Редактирование</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/product/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование товара</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование товара" value="<?=h($product->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="meta_title">Meta-title</label>
                            <input type="text" name="meta_title" class="form-control" id="meta_title"
                                   placeholder="Meta-title"
                                   maxlength="500"
                                   value="<?= h($product->meta_title); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="meta_desc">Meta-description</label>
                            <input type="text" name="meta_desc" class="form-control" id="meta_desc"
                                   placeholder="Meta-description"
                                   maxlength="500"
                                   value="<?= h($product->meta_desc); ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <label for="description">Позиция</label>
                            <input type="text" name="position" class="form-control" id="position" placeholder="Позиция" value="<?=$product->position;?>">
                        </div>

                        <div class="form-group">
                            <label for="cats">Родительские группы</label>
                            <select name="cats[]" class="form-control select2dopcats" id="dopcats" data-prod = <?=$product->id;?> multiple>
                                <?php if(!empty($dop_cats)): ?>
                                    <?php foreach($dop_cats as $item): ?>
                                        <option value="<?=$item['cat_id'];?>" selected><?=$item['title'];?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="attrs">Фильтры/Параметры товара</label>
                          <select name="attrs[]" class="form-control selectattrs" id="related" multiple>
                            <?php if(!empty($prod_params)): ?>
                              <?php foreach($prod_params as $item): ?>
                                <option value="<?=$item['attr_id'];?>" selected><?=$item['value'];?></option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                        </div>


  <div class="aj-enter">
  <?php if (isset($nav_groupes) && !empty($nav_groupes)): ?>
    <div class="form-group">
        <label for="category_id">Группа для навигации</label>
        <select name="category_id" class="form-control" id="category_id">
          <?php foreach ($nav_groupes as $item): ?>
            <option value="<?=$item->id;?>"<?php if($product->category_id == $item->id) echo ' selected'; ?>><?=$item['title'];?></option>
          <?php endforeach; ?>
        </select>
    </div>

<?php endif; ?>


                      </div>
                        <div class="form-group">
                            <label for="description">Короткое описание</label>
                            <input type="text" name="short_desc" class="form-control" id="short_desc" placeholder="Короткое описание" value="<?=$product->short_desc;?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Артикул</label>
                            <input type="text" name="articul" class="form-control" id="articul" placeholder="Артикул" value="<?=$product->articul;?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Производитель</label>
                            <input type="text" name="manufacturer" class="form-control" id="manufacturer" placeholder="Производитель" value="<?=$product->manufacturer;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Страна производитель</label>
                          <input type="text" name="manufacturer_country" class="form-control" placeholder="Страна производитель" value="<?=$product->manufacturer_country;?>">
                        </div>

                        <div class="nav-tabs-custom">
                            <label>Свободные характеристики</label>
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char1)): ?>
                                  <?=$product->char1;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_2" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char2)): ?>
                                  <?=$product->char2;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_3" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char3)): ?>
                                  <?=$product->char3;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_4" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char4)): ?>
                                  <?=$product->char4;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_5" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char5)): ?>
                                  <?=$product->char5;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_6" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char6)): ?>
                                  <?=$product->char6;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_7" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char7)): ?>
                                  <?=$product->char7;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_8" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char8)): ?>
                                  <?=$product->char8;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_9" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char9)): ?>
                                  <?=$product->char9;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_10" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char10)): ?>
                                  <?=$product->char10;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_11" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char11)): ?>
                                  <?=$product->char11;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_12" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char12)): ?>
                                  <?=$product->char12;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_13" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char13)): ?>
                                  <?=$product->char13;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_14" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char14)): ?>
                                  <?=$product->char14;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_15" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char15)): ?>
                                  <?=$product->char15;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_16" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char16)): ?>
                                  <?=$product->char16;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_17" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char17)): ?>
                                  <?=$product->char17;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_18" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char18)): ?>
                                  <?=$product->char18;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_19" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char19)): ?>
                                  <?=$product->char19;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_20" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char20)): ?>
                                  <?=$product->char20;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                              <li><a href="#tab_21" data-toggle="tab" aria-expanded="true">
                                <?php if (!empty($product->char21)): ?>
                                  <?=$product->char21;?>
                                <?php else: ?>
                                  <?='нет значения'?>
                                <?php endif; ?>
                              </a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                  <label for="description">Характеристика 1</label>
                                  <input type="text" name="char1" class="form-control" placeholder="Характеристика 1" value="<?=$product->char1;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы 1</label>
                                  <input type="text" name="mesure1" class="form-control" placeholder="Единицы 1" value="<?=$product->mesure1;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение 1</label>
                                  <input type="text" name="val1" class="form-control" placeholder="Значение 1" value="<?=h($product->val1);?>">
                                </div>
                              </div>
                              <div class="tab-pane" id="tab_2">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char2" class="form-control" placeholder="Характеристика" value="<?=$product->char2;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure2" class="form-control" placeholder="Единицы" value="<?=$product->mesure2;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val2" class="form-control" placeholder="Значение" value="<?=$product->val2;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_3">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char3" class="form-control" placeholder="Характеристика" value="<?=$product->char3;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure3" class="form-control" placeholder="Единицы" value="<?=$product->mesure3;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val3" class="form-control" placeholder="Значение" value="<?=$product->val3;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_4">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char4" class="form-control" placeholder="Характеристика" value="<?=$product->char4;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure4" class="form-control" placeholder="Единицы" value="<?=$product->mesure4;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val4" class="form-control" placeholder="Значение" value="<?=$product->val4;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_5">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char5" class="form-control" placeholder="Характеристика" value="<?=$product->char5;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure5" class="form-control" placeholder="Единицы" value="<?=$product->mesure5;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val5" class="form-control" placeholder="Значение" value="<?=$product->val5;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_6">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char6" class="form-control" placeholder="Характеристика" value="<?=$product->char6;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure6" class="form-control" placeholder="Единицы" value="<?=$product->mesure6;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val6" class="form-control" placeholder="Значение" value="<?=$product->val6;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_7">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char7" class="form-control" placeholder="Характеристика" value="<?=$product->char7;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure7" class="form-control" placeholder="Единицы" value="<?=$product->mesure7;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val7" class="form-control" placeholder="Значение" value="<?=$product->val7;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_8">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char8" class="form-control" placeholder="Характеристика" value="<?=$product->char8;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure8" class="form-control" placeholder="Единицы" value="<?=$product->mesure8;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val8" class="form-control" placeholder="Значение" value="<?=$product->val8;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_9">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char9" class="form-control" placeholder="Характеристика" value="<?=$product->char9;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure9" class="form-control" placeholder="Единицы" value="<?=$product->mesure9;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val9" class="form-control" placeholder="Значение" value="<?=$product->val9;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_10">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char10" class="form-control" placeholder="Характеристика" value="<?=$product->char10;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure10" class="form-control" placeholder="Единицы" value="<?=$product->mesure10;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val10" class="form-control" placeholder="Значение" value="<?=$product->val10;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_11">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char11" class="form-control" placeholder="Характеристика" value="<?=$product->char11;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure11" class="form-control" placeholder="Единицы" value="<?=$product->mesure11;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val11" class="form-control" placeholder="Значение" value="<?=$product->val11;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_12">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char12" class="form-control" placeholder="Характеристика" value="<?=$product->char12;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure12" class="form-control" placeholder="Единицы" value="<?=$product->mesure12;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val12" class="form-control" placeholder="Значение" value="<?=$product->val12;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_13">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char13" class="form-control" placeholder="Характеристика 13" value="<?=$product->char13;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure13" class="form-control" placeholder="Единицы 13" value="<?=$product->mesure13;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val13" class="form-control" placeholder="Значение" value="<?=$product->val13;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_14">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char14" class="form-control" placeholder="Характеристика" value="<?=$product->char14;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure14" class="form-control" placeholder="Единицы" value="<?=$product->mesure14;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val14" class="form-control" placeholder="Значение" value="<?=$product->val14;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_15">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char15" class="form-control" placeholder="Характеристика" value="<?=$product->char15;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure15" class="form-control" placeholder="Единицы" value="<?=$product->mesure15;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val15" class="form-control" placeholder="Значение" value="<?=$product->val15;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_16">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char16" class="form-control" placeholder="Характеристика" value="<?=$product->char16;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure16" class="form-control" placeholder="Единицы" value="<?=$product->mesure16;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val16" class="form-control" placeholder="Значение" value="<?=$product->val16;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_17">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char17" class="form-control" placeholder="Характеристика" value="<?=$product->char17;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure17" class="form-control" placeholder="Единицы" value="<?=$product->mesure17;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val17" class="form-control" placeholder="Значение" value="<?=$product->val17;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_18">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char18" class="form-control" placeholder="Характеристика" value="<?=$product->char18;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure18" class="form-control" placeholder="Единицы" value="<?=$product->mesure18;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val18" class="form-control" placeholder="Значение" value="<?=$product->val18;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_19">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char19" class="form-control" placeholder="Характеристика" value="<?=$product->char19;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure19" class="form-control" placeholder="Единицы" value="<?=$product->mesure19;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val19" class="form-control" placeholder="Значение" value="<?=$product->val19;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_20">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char20" class="form-control" placeholder="Характеристика" value="<?=$product->char20;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure20" class="form-control" placeholder="Единицы" value="<?=$product->mesure20;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val20" class="form-control" placeholder="Значение" value="<?=$product->val20;?>">
                                </div>
                              </div>

                              <div class="tab-pane" id="tab_21">
                                <div class="form-group">
                                  <label for="description">Характеристика</label>
                                  <input type="text" name="char21" class="form-control" placeholder="Характеристика" value="<?=$product->char21;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Единицы</label>
                                  <input type="text" name="mesure21" class="form-control" placeholder="Единицы" value="<?=$product->mesure21;?>">
                                </div>
                                <div class="form-group">
                                  <label for="description">Значение</label>
                                  <input type="text" name="val21" class="form-control" placeholder="Значение" value="<?=$product->val21;?>">
                                </div>
                              </div>
                            </div>
                        </div>

                        <?php if ((isset($_SESSION['user'])) && ($_SESSION['user']['role'] == 'admin')): ?>
                          <div class="form-group has-feedback">
                              <label for="price">Цена</label>
                              <input type="text" name="price" class="form-control" id="description" placeholder="Цена" pattern="^[0-9.]{1,}$" value="<?=$product->price;?>" required data-error="Допускаются цифры и десятичная точка">
                              <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                            <label for="price">Цена при заказе от 500 руб</label>
                            <input type="text" name="price_dis" class="form-control" id="price_dis" placeholder="Цена при заказе от 500 руб" pattern="^[0-9.]{1,}$" value="<?=$product->price_dis;?>" required data-error="Допускаются цифры и десятичная точка">
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                            <label for="price">Цена мастер</label>
                            <input type="text" name="price_master" class="form-control" id="price_master" placeholder="Цена мастер" pattern="^[0-9.]{1,}$" value="<?=$product->price_master;?>" required data-error="Допускаются цифры и десятичная точка">
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                            <label for="price">Цена опт</label>
                            <input type="text" name="price_opt" class="form-control" id="price_opt" placeholder="Цена опт" pattern="^[0-9.]{1,}$" value="<?=$product->price_opt;?>" required data-error="Допускаются цифры и десятичная точка">
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                              <label for="old_price">Скидка (в %)</label>
                              <input type="text" name="discount" class="form-control" id="description" placeholder="Скидка (в %)" pattern="^[0-9.]{1,}$" value="<?=$product->discount;?>" data-error="Допускаются только цифры">
                              <div class="help-block with-errors"></div>
                          </div>
                          <div class="form-group">
                            <label for="description">Валюта</label>
                            <input type="text" name="currency" class="form-control" placeholder="Валюта" value="<?=$product->currency;?>">
                          </div>

                          <div class="form-group">
                            <label for="description">Единицы для узазания в цене товара (мешок, шт, кг, л и т. д.)</label>
                            <input type="text" name="units" class="form-control" placeholder="Валюта" value="<?=$product->units;?>">
                          </div>


                        <?php else: ?>
                          <div class="form-group has-feedback">
                              <label for="price">Цена</label>
                              <input type="text" name="price" class="form-control" id="description" placeholder="Цена" pattern="^[0-9.]{1,}$" value="<?=$product->price;?>" required data-error="Допускаются цифры и десятичная точка" readonly>
                              <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                            <label for="price">Цена при заказе от 500 руб</label>
                            <input type="text" name="price_dis" class="form-control" id="price_dis" placeholder="Цена при заказе от 500 руб" pattern="^[0-9.]{1,}$" value="<?=$product->price_dis;?>" required data-error="Допускаются цифры и десятичная точка" readonly>
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                            <label for="price">Цена мастер</label>
                            <input type="text" name="price_master" class="form-control" id="price_master" placeholder="Цена мастер" pattern="^[0-9.]{1,}$" value="<?=$product->price_master;?>" required data-error="Допускаются цифры и десятичная точка" readonly>
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                            <label for="price">Цена опт</label>
                            <input type="text" name="price_opt" class="form-control" id="price_opt" placeholder="Цена опт" pattern="^[0-9.]{1,}$" value="<?=$product->price_opt;?>" required data-error="Допускаются цифры и десятичная точка" readonly>
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                              <label for="old_price">Скидка (в %)</label>
                              <input type="text" name="discount" class="form-control" id="description" placeholder="Скидка (в %)" pattern="^[0-9.]{1,}$" value="<?=$product->discount;?>" data-error="Допускаются только цифры" readonly>
                              <div class="help-block with-errors"></div>
                          </div>
                          <div class="form-group">
                            <label for="description">Валюта</label>
                            <input type="text" name="currency" class="form-control" placeholder="Валюта" value="<?=$product->currency;?>" readonly>
                          </div>

                          <div class="form-group">
                            <label for="description">Единицы для узазания в цене товара (мешок, шт, кг, л и т. д.)</label>
                            <input type="text" name="units" class="form-control" placeholder="Валюта" value="<?=$product->units;?>" readonly>
                          </div>
                        <?php endif; ?>



                        <div class="form-group has-feedback">
                            <label for="content">Описание</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?=$product->content;?></textarea>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="status"<?=$product->status ? ' checked' : null;?>> Статус
                            </label>
                        </div>

                        <div class="form-group">
                          <label>
                            <input type="checkbox" name="is_have"<?=$product->is_have ? ' checked' : null;?>> Наличие
                          </label>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="hit"<?=$product->hit ? ' checked' : null;?>> Хит
                            </label>
                        </div>

                        <div class="form-group">
                          <label>
                            <input type="checkbox" name="sale"<?=$product->sale ? ' checked' : null;?>> Акция
                          </label>
                        </div>

                        <div class="form-group">
                            <label for="related">С этим товаром также покупают</label>
                            <select name="related[]" class="form-control select2" id="related" multiple>
                                <?php if(!empty($related_product)): ?>
                                    <?php foreach($related_product as $item): ?>
                                        <option value="<?=$item['related_id'];?>" selected><?=$item['title'];?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="box box-danger box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Базовое изображение</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="single" class="btn btn-success" data-url="product/add-image" data-name="single">Выбрать файл</div>
                                        <p><small>Рекомендуемые размеры: 200х250</small></p>
                                        <div class="single">
                                            <img src="<?=PATH;?>/prodimg/<?=$product->img;?>" alt="" style="max-height: 150px;" data-id="<?=$product->id;?>" data-src="<?=$product->img;?>" class="del-item">
                                        </div>
                                    </div>
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="box box-primary box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Картинки галереи</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="multi" class="btn btn-success" data-url="product/add-image" data-name="multi">Выбрать файл</div>
                                        <p><small>Рекомендуемые размеры: 900х900</small></p>
                                        <div class="multi">
                                            <?php if(!empty($gallery)): ?>
                                                <?php foreach($gallery as $item): ?>
                                                    <img src="<?=PATH;?>/prodimg/<?=$item;?>" alt="" style="max-height: 150px; cursor: pointer;" data-id="<?=$product->id;?>" data-src="<?=$item;?>" class="del-item">
                                                <?php endforeach; ?>
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
                        <input type="hidden" name="id" value="<?=$product->id;?>">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        <a class="btn btn-primary" href="<?=ADMIN;?>/product/copy?id=<?=$product['id'];?>">Создать копию</a>
                        <a class="btn btn-danger delete" href="<?=ADMIN;?>/product/delete?id=<?=$product['id'];?>">Удалить товар</a>
                        <a class="btn btn-warning" href="<?=ADMIN;?>/category/edit?id=<?=$product['category_id'];?>">Назад в группу</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
