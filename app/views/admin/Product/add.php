<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Новый товар
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/product">Список товаров</a></li>
        <li class="active">Новый товар</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form action="<?=ADMIN;?>/product/add" method="post" data-toggle="validator" id="add">
          <div class="box-body">
            <div class="form-group has-feedback">
              <label for="title">Наименование товара</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Наименование товара" value="<?php isset($_SESSION['form_data']['title']) ? h($_SESSION['form_data']['title']) : null; ?>" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group">
              <label for="description">Позиция</label>
              <input type="text" name="position" class="form-control" id="position" placeholder="Позиция" value="<?php isset($_SESSION['form_data']['position']) ? h($_SESSION['form_data']['position']) : null; ?>">
            </div>

            <div class="form-group" id="dop_cats">
              <label for="cats">Родительские группы</label>
              <select name="cats[]" class="form-control select2dopcats" id="dopcatsadd" multiple></select>
            </div>

            <div class="aj-enter">
            </div>

            <div class="form-group">
              <label for="description">Короткое описание</label>
              <input type="text" name="short_desc" class="form-control" id="short_desc" placeholder="Короткое описание" value="<?php isset($_SESSION['form_data']['short_desc']) ? h($_SESSION['form_data']['short_desc']) : null; ?>">
            </div>
            <div class="form-group">
              <label for="description">Артикул</label>
              <input type="text" name="articul" class="form-control" id="articul" placeholder="Артикул" value="<?php isset($_SESSION['form_data']['articul']) ? h($_SESSION['form_data']['articul']) : null; ?>">
            </div>

            <div class="form-group">
              <label for="description">Производитель</label>
              <input type="text" name="manufacturer" class="form-control" id="manufacturer" placeholder="Производитель" value="<?php isset($_SESSION['form_data']['manufacturer']) ? h($_SESSION['form_data']['manufacturer']) : null; ?>">
            </div>

            <div class="form-group">
              <label for="description">Страна производитель</label>
              <input type="text" name="manufacturer_country" class="form-control" placeholder="Страна производитель" value="<?php isset($_SESSION['form_data']['manufacturer_country']) ? h($_SESSION['form_data']['manufacturer_country']) : null; ?>">
            </div>

            <div class="form-group">
              <label for="prod_attrs">Добавить фильтры/параметры товара</label>
              <select name="attrs[]" class="form-control selectattrs" id="related" multiple></select>
            </div>



            <div class="nav-tabs-custom">
                <label>Свободные характеристики</label>
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">1</a></li>
                  <li><a href="#tab_2" data-toggle="tab" aria-expanded="true">2</a></li>
                  <li><a href="#tab_3" data-toggle="tab" aria-expanded="true">3</a></li>
                  <li><a href="#tab_4" data-toggle="tab" aria-expanded="true">4</a></li>
                  <li><a href="#tab_5" data-toggle="tab" aria-expanded="true">5</a></li>
                  <li><a href="#tab_6" data-toggle="tab" aria-expanded="true">6</a></li>
                  <li><a href="#tab_7" data-toggle="tab" aria-expanded="true">7</a></li>
                  <li><a href="#tab_8" data-toggle="tab" aria-expanded="true">8</a></li>
                  <li><a href="#tab_9" data-toggle="tab" aria-expanded="true">9</a></li>
                  <li><a href="#tab_10" data-toggle="tab" aria-expanded="true">10</a></li>
                  <li><a href="#tab_11" data-toggle="tab" aria-expanded="true">11</a></li>
                  <li><a href="#tab_12" data-toggle="tab" aria-expanded="true">12</a></li>
                  <li><a href="#tab_13" data-toggle="tab" aria-expanded="true">13</a></li>
                  <li><a href="#tab_14" data-toggle="tab" aria-expanded="true">14</a></li>
                  <li><a href="#tab_15" data-toggle="tab" aria-expanded="true">15</a></li>
                  <li><a href="#tab_16" data-toggle="tab" aria-expanded="true">16</a></li>
                  <li><a href="#tab_17" data-toggle="tab" aria-expanded="true">17</a></li>
                  <li><a href="#tab_18" data-toggle="tab" aria-expanded="true">18</a></li>
                  <li><a href="#tab_19" data-toggle="tab" aria-expanded="true">19</a></li>
                  <li><a href="#tab_20" data-toggle="tab" aria-expanded="true">20</a></li>
                  <li><a href="#tab_21" data-toggle="tab" aria-expanded="true">21</a></li>
                </ul>
                <div class="tab-content">

                  <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                      <label for="description">Характеристика 1</label>
                      <input type="text" name="char2" class="form-control" placeholder="Характеристика 1" value="<?php isset($_SESSION['form_data']['char1']) ? h($_SESSION['form_data']['char1']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 1</label>
                      <input type="text" name="mesure2" class="form-control" placeholder="Единицы 1" value="<?php isset($_SESSION['form_data']['mesure1']) ? h($_SESSION['form_data']['mesure1']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 1</label>
                      <input type="text" name="val2" class="form-control" placeholder="Значение 1" value="<?php isset($_SESSION['form_data']['val1']) ? h($_SESSION['form_data']['val1']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_2">
                    <div class="form-group">
                      <label for="description">Характеристика 2</label>
                      <input type="text" name="char2" class="form-control" placeholder="Характеристика 2" value="<?php isset($_SESSION['form_data']['char2']) ? h($_SESSION['form_data']['char2']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 2</label>
                      <input type="text" name="mesure2" class="form-control" placeholder="Единицы 2" value="<?php isset($_SESSION['form_data']['mesure2']) ? h($_SESSION['form_data']['mesure2']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 2</label>
                      <input type="text" name="val2" class="form-control" placeholder="Значение 2" value="<?php isset($_SESSION['form_data']['val2']) ? h($_SESSION['form_data']['val2']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_3">
                    <div class="form-group">
                      <label for="description">Характеристика 3</label>
                      <input type="text" name="char3" class="form-control" placeholder="Характеристика 3" value="<?php isset($_SESSION['form_data']['char3']) ? h($_SESSION['form_data']['char3']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 3</label>
                      <input type="text" name="mesure3" class="form-control" placeholder="Единицы 3" value="<?php isset($_SESSION['form_data']['mesure3']) ? h($_SESSION['form_data']['mesure3']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 3</label>
                      <input type="text" name="val3" class="form-control" placeholder="Значение 3" value="<?php isset($_SESSION['form_data']['val3']) ? h($_SESSION['form_data']['val3']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_4">
                    <div class="form-group">
                      <label for="description">Характеристика 4</label>
                      <input type="text" name="char4" class="form-control" placeholder="Характеристика 4" value="<?php isset($_SESSION['form_data']['char4']) ? h($_SESSION['form_data']['char4']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 4</label>
                      <input type="text" name="mesure4" class="form-control" placeholder="Единицы 4" value="<?php isset($_SESSION['form_data']['mesure4']) ? h($_SESSION['form_data']['mesure4']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 4</label>
                      <input type="text" name="val4" class="form-control" placeholder="Значение 4" value="<?php isset($_SESSION['form_data']['val4']) ? h($_SESSION['form_data']['val4']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_5">
                    <div class="form-group">
                      <label for="description">Характеристика 5</label>
                      <input type="text" name="char5" class="form-control" placeholder="Характеристика 5" value="<?php isset($_SESSION['form_data']['char5']) ? h($_SESSION['form_data']['char5']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 5</label>
                      <input type="text" name="mesure5" class="form-control" placeholder="Единицы 5" value="<?php isset($_SESSION['form_data']['mesure5']) ? h($_SESSION['form_data']['mesure5']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 5</label>
                      <input type="text" name="val5" class="form-control" placeholder="Значение 5" value="<?php isset($_SESSION['form_data']['val5']) ? h($_SESSION['form_data']['val5']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_6">
                    <div class="form-group">
                      <label for="description">Характеристика 6</label>
                      <input type="text" name="char6" class="form-control" placeholder="Характеристика 6" value="<?php isset($_SESSION['form_data']['char6']) ? h($_SESSION['form_data']['char6']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 6</label>
                      <input type="text" name="mesure6" class="form-control" placeholder="Единицы 6" value="<?php isset($_SESSION['form_data']['mesure6']) ? h($_SESSION['form_data']['mesure6']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 6</label>
                      <input type="text" name="val6" class="form-control" placeholder="Значение 6" value="<?php isset($_SESSION['form_data']['val6']) ? h($_SESSION['form_data']['val6']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_7">
                    <div class="form-group">
                      <label for="description">Характеристика 7</label>
                      <input type="text" name="char7" class="form-control" placeholder="Характеристика 7" value="<?php isset($_SESSION['form_data']['char7']) ? h($_SESSION['form_data']['char7']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 7</label>
                      <input type="text" name="mesure7" class="form-control" placeholder="Единицы 7" value="<?php isset($_SESSION['form_data']['mesure7']) ? h($_SESSION['form_data']['mesure7']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 7</label>
                      <input type="text" name="val7" class="form-control" placeholder="Значение 7" value="<?php isset($_SESSION['form_data']['val7']) ? h($_SESSION['form_data']['val7']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_8">
                    <div class="form-group">
                      <label for="description">Характеристика 8</label>
                      <input type="text" name="char8" class="form-control" placeholder="Характеристика 8" value="<?php isset($_SESSION['form_data']['char8']) ? h($_SESSION['form_data']['char8']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 8</label>
                      <input type="text" name="mesure8" class="form-control" placeholder="Единицы 8" value="<?php isset($_SESSION['form_data']['mesure8']) ? h($_SESSION['form_data']['mesure8']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 8</label>
                      <input type="text" name="val8" class="form-control" placeholder="Значение 8" value="<?php isset($_SESSION['form_data']['val8']) ? h($_SESSION['form_data']['val8']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_9">
                    <div class="form-group">
                      <label for="description">Характеристика 9</label>
                      <input type="text" name="char9" class="form-control" placeholder="Характеристика 9" value="<?php isset($_SESSION['form_data']['char9']) ? h($_SESSION['form_data']['char9']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 9</label>
                      <input type="text" name="mesure9" class="form-control" placeholder="Единицы 9" value="<?php isset($_SESSION['form_data']['mesure9']) ? h($_SESSION['form_data']['mesure9']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 9</label>
                      <input type="text" name="val9" class="form-control" placeholder="Значение 9" value="<?php isset($_SESSION['form_data']['val9']) ? h($_SESSION['form_data']['val9']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_10">
                    <div class="form-group">
                      <label for="description">Характеристика 10</label>
                      <input type="text" name="char10" class="form-control" placeholder="Характеристика 10" value="<?php isset($_SESSION['form_data']['char10']) ? h($_SESSION['form_data']['char10']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 10</label>
                      <input type="text" name="mesure10" class="form-control" placeholder="Единицы 10" value="<?php isset($_SESSION['form_data']['mesure10']) ? h($_SESSION['form_data']['mesure10']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 10</label>
                      <input type="text" name="val10" class="form-control" placeholder="Значение 10" value="<?php isset($_SESSION['form_data']['val10']) ? h($_SESSION['form_data']['val10']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_11">
                    <div class="form-group">
                      <label for="description">Характеристика 11</label>
                      <input type="text" name="char11" class="form-control" placeholder="Характеристика 11" value="<?php isset($_SESSION['form_data']['char11']) ? h($_SESSION['form_data']['char11']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 11</label>
                      <input type="text" name="mesure11" class="form-control" placeholder="Единицы 11" value="<?php isset($_SESSION['form_data']['mesure11']) ? h($_SESSION['form_data']['mesure11']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 11</label>
                      <input type="text" name="val11" class="form-control" placeholder="Значение 11" value="<?php isset($_SESSION['form_data']['val11']) ? h($_SESSION['form_data']['val11']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_12">
                    <div class="form-group">
                      <label for="description">Характеристика 12</label>
                      <input type="text" name="char12" class="form-control" placeholder="Характеристика 12" value="<?php isset($_SESSION['form_data']['char12']) ? h($_SESSION['form_data']['char12']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 12</label>
                      <input type="text" name="mesure12" class="form-control" placeholder="Единицы 12" value="<?php isset($_SESSION['form_data']['mesure12']) ? h($_SESSION['form_data']['mesure12']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 12</label>
                      <input type="text" name="val12" class="form-control" placeholder="Значение 12" value="<?php isset($_SESSION['form_data']['val12']) ? h($_SESSION['form_data']['val12']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_13">
                    <div class="form-group">
                      <label for="description">Характеристика 13</label>
                      <input type="text" name="char13" class="form-control" placeholder="Характеристика 13" value="<?php isset($_SESSION['form_data']['char13']) ? h($_SESSION['form_data']['char13']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 13</label>
                      <input type="text" name="mesure13" class="form-control" placeholder="Единицы 13" value="<?php isset($_SESSION['form_data']['mesure13']) ? h($_SESSION['form_data']['mesure13']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 13</label>
                      <input type="text" name="val13" class="form-control" placeholder="Значение 13" value="<?php isset($_SESSION['form_data']['val13']) ? h($_SESSION['form_data']['val13']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_14">
                    <div class="form-group">
                      <label for="description">Характеристика 14</label>
                      <input type="text" name="char14" class="form-control" placeholder="Характеристика 14" value="<?php isset($_SESSION['form_data']['char14']) ? h($_SESSION['form_data']['char14']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 14</label>
                      <input type="text" name="mesure14" class="form-control" placeholder="Единицы 14" value="<?php isset($_SESSION['form_data']['mesure14']) ? h($_SESSION['form_data']['mesure14']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 14</label>
                      <input type="text" name="val14" class="form-control" placeholder="Значение 14" value="<?php isset($_SESSION['form_data']['val14']) ? h($_SESSION['form_data']['val14']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_15">
                    <div class="form-group">
                      <label for="description">Характеристика 15</label>
                      <input type="text" name="char15" class="form-control" placeholder="Характеристика 15" value="<?php isset($_SESSION['form_data']['char15']) ? h($_SESSION['form_data']['char15']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 15</label>
                      <input type="text" name="mesure15" class="form-control" placeholder="Единицы 15" value="<?php isset($_SESSION['form_data']['mesure15']) ? h($_SESSION['form_data']['mesure15']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 15</label>
                      <input type="text" name="val15" class="form-control" placeholder="Значение 15" value="<?php isset($_SESSION['form_data']['val15']) ? h($_SESSION['form_data']['val15']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_16">
                    <div class="form-group">
                      <label for="description">Характеристика 16</label>
                      <input type="text" name="char16" class="form-control" placeholder="Характеристика 16" value="<?php isset($_SESSION['form_data']['char16']) ? h($_SESSION['form_data']['char16']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 16</label>
                      <input type="text" name="mesure16" class="form-control" placeholder="Единицы 16" value="<?php isset($_SESSION['form_data']['mesure16']) ? h($_SESSION['form_data']['mesure16']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 16</label>
                      <input type="text" name="val16" class="form-control" placeholder="Значение 16" value="<?php isset($_SESSION['form_data']['val16']) ? h($_SESSION['form_data']['val16']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_17">
                    <div class="form-group">
                      <label for="description">Характеристика 17</label>
                      <input type="text" name="char17" class="form-control" placeholder="Характеристика 17" value="<?php isset($_SESSION['form_data']['char17']) ? h($_SESSION['form_data']['char17']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 17</label>
                      <input type="text" name="mesure17" class="form-control" placeholder="Единицы 17" value="<?php isset($_SESSION['form_data']['mesure17']) ? h($_SESSION['form_data']['mesure17']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 17</label>
                      <input type="text" name="val17" class="form-control" placeholder="Значение 17" value="<?php isset($_SESSION['form_data']['val17']) ? h($_SESSION['form_data']['val17']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_18">
                    <div class="form-group">
                      <label for="description">Характеристика 18</label>
                      <input type="text" name="char18" class="form-control" placeholder="Характеристика 18" value="<?php isset($_SESSION['form_data']['char18']) ? h($_SESSION['form_data']['char18']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 18</label>
                      <input type="text" name="mesure18" class="form-control" placeholder="Единицы 18" value="<?php isset($_SESSION['form_data']['mesure18']) ? h($_SESSION['form_data']['mesure18']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 18</label>
                      <input type="text" name="val18" class="form-control" placeholder="Значение 18" value="<?php isset($_SESSION['form_data']['val18']) ? h($_SESSION['form_data']['val18']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_19">
                    <div class="form-group">
                      <label for="description">Характеристика 19</label>
                      <input type="text" name="char19" class="form-control" placeholder="Характеристика 19" value="<?php isset($_SESSION['form_data']['char19']) ? h($_SESSION['form_data']['char19']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 19</label>
                      <input type="text" name="mesure19" class="form-control" placeholder="Единицы 19" value="<?php isset($_SESSION['form_data']['mesure19']) ? h($_SESSION['form_data']['mesure19']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 19</label>
                      <input type="text" name="val19" class="form-control" placeholder="Значение 19" value="<?php isset($_SESSION['form_data']['val19']) ? h($_SESSION['form_data']['val19']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_20">
                    <div class="form-group">
                      <label for="description">Характеристика 20</label>
                      <input type="text" name="char20" class="form-control" placeholder="Характеристика 20" value="<?php isset($_SESSION['form_data']['char20']) ? h($_SESSION['form_data']['char20']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 20</label>
                      <input type="text" name="mesure20" class="form-control" placeholder="Единицы 20" value="<?php isset($_SESSION['form_data']['mesure20']) ? h($_SESSION['form_data']['mesure20']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 20</label>
                      <input type="text" name="val20" class="form-control" placeholder="Значение 20" value="<?php isset($_SESSION['form_data']['val20']) ? h($_SESSION['form_data']['val20']) : null; ?>">
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_21">
                    <div class="form-group">
                      <label for="description">Характеристика 21</label>
                      <input type="text" name="char21" class="form-control" placeholder="Характеристика 21" value="<?php isset($_SESSION['form_data']['char21']) ? h($_SESSION['form_data']['char21']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Единицы 21</label>
                      <input type="text" name="mesure21" class="form-control" placeholder="Единицы 21" value="<?php isset($_SESSION['form_data']['mesure21']) ? h($_SESSION['form_data']['mesure21']) : null; ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Значение 21</label>
                      <input type="text" name="val21" class="form-control" placeholder="Значение 21" value="<?php isset($_SESSION['form_data']['val21']) ? h($_SESSION['form_data']['val21']) : null; ?>">
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group has-feedback">
              <label for="price">Цена</label>
              <input type="text" name="price" class="form-control" id="price" placeholder="Цена" pattern="^[0-9.]{1,}$" value="<?php isset($_SESSION['form_data']['price']) ? h($_SESSION['form_data']['price']) : null; ?>" required data-error="Допускаются цифры и десятичная точка">
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback">
              <label for="price">Цена при заказе от 500 руб</label>
              <input type="text" name="price_dis" class="form-control" id="price_dis" placeholder="Цена при заказе от 500 руб" pattern="^[0-9.]{1,}$" value="<?php isset($_SESSION['form_data']['price_dis']) ? h($_SESSION['form_data']['price_dis']) : null; ?>" required data-error="Допускаются цифры и десятичная точка">
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback">
              <label for="price">Цена мастер</label>
              <input type="text" name="price_master" class="form-control" id="price_master" placeholder="Цена мастер" pattern="^[0-9.]{1,}$" value="<?php isset($_SESSION['form_data']['price_dis']) ? h($_SESSION['form_data']['price_dis']) : null; ?>" required data-error="Допускаются цифры и десятичная точка">
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback">
              <label for="price">Цена опт</label>
              <input type="text" name="price_opt" class="form-control" id="price_opt" placeholder="Цена опт" pattern="^[0-9.]{1,}$" value="<?php isset($_SESSION['form_data']['price_dis']) ? h($_SESSION['form_data']['price_dis']) : null; ?>" required data-error="Допускаются цифры и десятичная точка">
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group has-feedback">
              <label for="old_price">Cкидка (в %)</label>
              <input type="text" name="discount" class="form-control" id="old_price" placeholder="Скидка (в %)" pattern="^[0-9.]{1,}$" value="<?php isset($_SESSION['form_data']['discount']) ? h($_SESSION['form_data']['discount']) : null; ?>" data-error="Допускаются только цифры">
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label for="description">Валюта</label>
              <input type="text" name="currency" class="form-control" placeholder="Валюта" value="<?php isset($_SESSION['form_data']['currency']) ? h($_SESSION['form_data']['currency']) : null; ?>">
            </div>

            <div class="form-group">
              <label for="description">Единицы для узазания в цене товара (мешок, шт, кг, л и т. д.)</label>
              <input type="text" name="units" class="form-control" placeholder="Единицы" value="<?php isset($_SESSION['form_data']['units']) ? h($_SESSION['form_data']['units']) : null; ?>">
            </div>


            <div class="form-group has-feedback">
              <label for="content">Описание</label>
              <textarea name="content" id="editor1" cols="80" rows="10"><?php isset($_SESSION['form_data']['content']) ? $_SESSION['form_data']['content'] : null; ?></textarea>
            </div>

            <div class="form-group">
              <label>
                <input type="checkbox" name="status" checked> Статус (при снятии отметки товар не отображается на сайте)
              </label>
            </div>

            <div class="form-group">
              <label>
                <input type="checkbox" name="is_have" checked> Наличие
              </label>
            </div>

            <div class="form-group">
              <label>
                <input type="checkbox" name="hit"> Хит
              </label>
            </div>
            <div class="form-group">
              <label>
                <input type="checkbox" name="sale"> Акция
              </label>
            </div>

            <div class="form-group">
              <label for="related">С этим товаром также покупают</label>
              <select name="related[]" class="form-control select2" id="related" multiple></select>
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
                    <div class="single"></div>
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
                    <div class="multi"></div>
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
        <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
      </div>
    </div>
  </div>
</section>
<div class="preloader"><img src='<?=PATH ?>/images/ring.svg' alt=""></div>
<!-- /.content -->
