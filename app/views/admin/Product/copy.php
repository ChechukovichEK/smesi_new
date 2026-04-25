<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Копия товара <?=$product->title;?>
    </h1>
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
                <form action="<?=ADMIN;?>/product/copy" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование товара</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование товара" value="<?=h($product->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <label for="description">Позиция</label>
                            <input type="text" name="position" class="form-control" id="position" placeholder="Артикул" value="<?=$product->position;?>">
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
                          <input type="text" name="val1" class="form-control" placeholder="Значение 1" value="<?=$product->val1;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 2</label>
                          <input type="text" name="char2" class="form-control" placeholder="Характеристика 2" value="<?=$product->char2;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 2</label>
                          <input type="text" name="mesure2" class="form-control" placeholder="Единицы 2" value="<?=$product->mesure2;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 2</label>
                          <input type="text" name="val2" class="form-control" placeholder="Значение 2" value="<?=$product->val2;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 3</label>
                          <input type="text" name="char3" class="form-control" placeholder="Характеристика 3" value="<?=$product->char3;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 3</label>
                          <input type="text" name="mesure3" class="form-control" placeholder="Единицы 3" value="<?=$product->mesure3;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 3</label>
                          <input type="text" name="val3" class="form-control" placeholder="Значение 3" value="<?=$product->val3;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 4</label>
                          <input type="text" name="char4" class="form-control" placeholder="Характеристика 4" value="<?=$product->char4;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 4</label>
                          <input type="text" name="mesure4" class="form-control" placeholder="Единицы 4" value="<?=$product->mesure4;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 4</label>
                          <input type="text" name="val4" class="form-control" placeholder="Значение 4" value="<?=$product->val4;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 5</label>
                          <input type="text" name="char5" class="form-control" placeholder="Характеристика 5" value="<?=$product->char5;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 5</label>
                          <input type="text" name="mesure5" class="form-control" placeholder="Единицы 5" value="<?=$product->mesure5;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 5</label>
                          <input type="text" name="val5" class="form-control" placeholder="Значение 5" value="<?=$product->val5;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 6</label>
                          <input type="text" name="char6" class="form-control" placeholder="Характеристика 6" value="<?=$product->char6;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 6</label>
                          <input type="text" name="mesure6" class="form-control" placeholder="Единицы 6" value="<?=$product->mesure6;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 6</label>
                          <input type="text" name="val6" class="form-control" placeholder="Значение 6" value="<?=$product->val6;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 7</label>
                          <input type="text" name="char7" class="form-control" placeholder="Характеристика 7" value="<?=$product->char7;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 7</label>
                          <input type="text" name="mesure7" class="form-control" placeholder="Единицы 7" value="<?=$product->mesure7;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 7</label>
                          <input type="text" name="val7" class="form-control" placeholder="Значение 7" value="<?=$product->val7;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 8</label>
                          <input type="text" name="char8" class="form-control" placeholder="Характеристика 8" value="<?=$product->char8;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 8</label>
                          <input type="text" name="mesure8" class="form-control" placeholder="Единицы 8" value="<?=$product->mesure8;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 8</label>
                          <input type="text" name="val8" class="form-control" placeholder="Значение 8" value="<?=$product->val8;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 9</label>
                          <input type="text" name="char9" class="form-control" placeholder="Характеристика 9" value="<?=$product->char9;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 9</label>
                          <input type="text" name="mesure9" class="form-control" placeholder="Единицы 9" value="<?=$product->mesure9;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 9</label>
                          <input type="text" name="val9" class="form-control" placeholder="Значение 9" value="<?=$product->val9;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 10</label>
                          <input type="text" name="char10" class="form-control" placeholder="Характеристика 10" value="<?=$product->char10;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 10</label>
                          <input type="text" name="mesure10" class="form-control" placeholder="Единицы 10" value="<?=$product->mesure10;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 10</label>
                          <input type="text" name="val10" class="form-control" placeholder="Значение 10" value="<?=$product->val10;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 11</label>
                          <input type="text" name="char11" class="form-control" placeholder="Характеристика 11" value="<?=$product->char11;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 11</label>
                          <input type="text" name="mesure11" class="form-control" placeholder="Единицы 11" value="<?=$product->mesure11;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 11</label>
                          <input type="text" name="val11" class="form-control" placeholder="Значение 11" value="<?=$product->val11;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 12</label>
                          <input type="text" name="char12" class="form-control" placeholder="Характеристика 12" value="<?=$product->char12;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 12</label>
                          <input type="text" name="mesure12" class="form-control" placeholder="Единицы 12" value="<?=$product->mesure12;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 12</label>
                          <input type="text" name="val12" class="form-control" placeholder="Значение 12" value="<?=$product->val12;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 13</label>
                          <input type="text" name="char13" class="form-control" placeholder="Характеристика 13" value="<?=$product->char13;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 13</label>
                          <input type="text" name="mesure13" class="form-control" placeholder="Единицы 13" value="<?=$product->mesure13;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 13</label>
                          <input type="text" name="val13" class="form-control" placeholder="Значение 13" value="<?=$product->val13;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 14</label>
                          <input type="text" name="char14" class="form-control" placeholder="Характеристика 14" value="<?=$product->char14;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 14</label>
                          <input type="text" name="mesure14" class="form-control" placeholder="Единицы 14" value="<?=$product->mesure14;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 14</label>
                          <input type="text" name="val14" class="form-control" placeholder="Значение 14" value="<?=$product->val14;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 15</label>
                          <input type="text" name="char15" class="form-control" placeholder="Характеристика 15" value="<?=$product->char15;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 15</label>
                          <input type="text" name="mesure15" class="form-control" placeholder="Единицы 15" value="<?=$product->mesure15;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 15</label>
                          <input type="text" name="val15" class="form-control" placeholder="Значение 15" value="<?=$product->val15;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 16</label>
                          <input type="text" name="char16" class="form-control" placeholder="Характеристика 16" value="<?=$product->char16;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 16</label>
                          <input type="text" name="mesure16" class="form-control" placeholder="Единицы 16" value="<?=$product->mesure16;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 16</label>
                          <input type="text" name="val16" class="form-control" placeholder="Значение 16" value="<?=$product->val16;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 17</label>
                          <input type="text" name="char17" class="form-control" placeholder="Характеристика 17" value="<?=$product->char17;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 17</label>
                          <input type="text" name="mesure17" class="form-control" placeholder="Единицы 17" value="<?=$product->mesure17;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 17</label>
                          <input type="text" name="val17" class="form-control" placeholder="Значение 17" value="<?=$product->val17;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 18</label>
                          <input type="text" name="char18" class="form-control" placeholder="Характеристика 18" value="<?=$product->char18;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 18</label>
                          <input type="text" name="mesure18" class="form-control" placeholder="Единицы 18" value="<?=$product->mesure18;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 18</label>
                          <input type="text" name="val18" class="form-control" placeholder="Значение 18" value="<?=$product->val18;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 19</label>
                          <input type="text" name="char19" class="form-control" placeholder="Характеристика 19" value="<?=$product->char19;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 19</label>
                          <input type="text" name="mesure19" class="form-control" placeholder="Единицы 19" value="<?=$product->mesure19;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 19</label>
                          <input type="text" name="val19" class="form-control" placeholder="Значение 19" value="<?=$product->val19;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 20</label>
                          <input type="text" name="char20" class="form-control" placeholder="Характеристика 20" value="<?=$product->char20;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 20</label>
                          <input type="text" name="mesure20" class="form-control" placeholder="Единицы 20" value="<?=$product->mesure20;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 20</label>
                          <input type="text" name="val20" class="form-control" placeholder="Значение 20" value="<?=$product->val20;?>">
                        </div>

                        <div class="form-group">
                          <label for="description">Характеристика 21</label>
                          <input type="text" name="char21" class="form-control" placeholder="Характеристика 21" value="<?=$product->char21;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Единицы 21</label>
                          <input type="text" name="mesure21" class="form-control" placeholder="Единицы 21" value="<?=$product->mesure21;?>">
                        </div>
                        <div class="form-group">
                          <label for="description">Значение 21</label>
                          <input type="text" name="val21" class="form-control" placeholder="Значение 21" value="<?=$product->val21;?>">
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
                              <label for="old_price">Скидка</label>
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
                              <input type="text" name="price" class="form-control" id="description" placeholder="Цена" pattern="^[0-9.]{1,}$" value="<?=$product->price;?>" data-error="Допускаются цифры и десятичная точка" readonly>
                              <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                            <label for="price">Цена при заказе от 500 руб</label>
                            <input type="text" name="price_dis" class="form-control" id="price_dis" placeholder="Цена при заказе от 500 руб" pattern="^[0-9.]{1,}$" value="<?=$product->price_dis;?>" data-error="Допускаются цифры и десятичная точка" readonly>
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                            <label for="price">Цена мастер</label>
                            <input type="text" name="price_master" class="form-control" id="price_master" placeholder="Цена мастер" pattern="^[0-9.]{1,}$" value="<?=$product->price_master;?>" data-error="Допускаются цифры и десятичная точка" readonly>
                            <div class="help-block with-errors"></div>
                          </div>

                          <div class="form-group has-feedback">
                            <label for="price">Цена опт</label>
                            <input type="text" name="price_opt" class="form-control" id="price_opt" placeholder="Цена опт" pattern="^[0-9.]{1,}$" value="<?=$product->price_opt;?>" data-error="Допускаются цифры и десятичная точка" readonly>
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
                              <div class="box-header">
                                  <h3 class="box-title">Базовое изображение</h3>
                              </div>
                                  <div class="single">
                                      <img src="<?=PATH;?>/prodimg/<?=$product->img;?>" alt="" style="max-height: 150px;">
                                  </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$product->id;?>">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        <a class="btn btn-warning" href="<?=ADMIN;?>/category/edit?id=<?=$product['category_id'];?>">Назад в группу</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
