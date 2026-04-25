<div class="cart-wrap"><!--start-breadcrumbs-->
<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
        <li><a href="<?= PATH ?>">Главная</a></li>
        <li>Корзина</li>
      </ol>
    </div>
  </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->

    <div class="cart-content">
    <?php if(!isset($_SESSION['user'])):?>
      <?php if(!empty($_SESSION['cart'])):?>
        <div class="cart-items">
          <?php foreach($_SESSION['cart'] as $id => $item): ?>
            <div class="cart-item">
              <a href="product/<?=$item['alias'] ?>" class="cart-img cart-view">
                <img src="prodimg/<?=$item['img'] ?>" alt="<?=$item['title'] ?>">
              </a>
              <a class="cart-title" href="product/<?=$item['alias'] ?>"><?=$item['title'] ?></a>
              <div class="cart-qty">
                <input type="number" name="quantity" data-id="<?=$id;?>" value="<?=$item['qty']?>" size="4" min="1" step="1">
              </div>
              <?php if ($_SESSION['cart.sum'] >= DISCOUNT): ?>
                <?php if ($item['price_dis'] != 0): ?>
                  <div class="cart-price">
                    <p>цена</p>
                    <p><span><?=$item['price'];?></span><?=$item['price_dis'];?> руб/<?=$item['units'];?></p>
                  </div>
                <?php else: ?>
                  <div class="cart-price">
                    <p>цена</p>
                    <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
                  </div>
                <?php endif; ?>
              <?php else: ?>
                <div class="cart-price">
                  <p>цена</p>
                  <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
                </div>
              <?php endif; ?>

              <?php if ($_SESSION['cart.sum'] >= DISCOUNT): ?>
                <?php if ($item['price_dis'] != 0): ?>
                  <div class="cart-price">
                    <p>сумма</p>
                    <p><?=$item['qty']*$item['price_dis']?> руб</p>
                  </div>
                <?php else: ?>
                  <div class="cart-price">
                    <p>сумма</p>
                    <p><?=$item['qty']*$item['price']?> руб</p>
                  </div>
                <?php endif; ?>
              <?php else: ?>
                <div class="cart-price">
                  <p>сумма</p>
                  <p><?=$item['qty']*$item['price']?> руб</p>
                </div>
              <?php endif; ?>

              <div class="cart-delete hover">
                <a href="cart/delete/?id=<?=$id;?>"><span data-id="<?=$id;?>" class="del-item" aria-hidden="true">X</span></a>
              </div>
            </div>
          <?php endforeach;?>
        </div>
      <div class="cart-all">
        <div class="cart-all-qty">
          <p>Количество товаров в заказе:</p>
          <p class="all-sum"><?=$_SESSION['cart.qty']?></p>
        </div>

        <?php if ($_SESSION['cart.sum'] >= DISCOUNT): ?>
          <div class="cart-all-sum">
            <p>Общая сумма (с учётом скидки):</p>
            <p class="sum-discount"><?=$_SESSION['cart.disc'];?> руб.</p>
          </div>
          <div class="cart-all-sum">
            <p>Общая сумма (без скидки):</p>
            <p><?=$_SESSION['cart.sum'];?> руб.</p>
          </div>
        <?php else: ?>
          <div class="cart-all-sum">
            <p>Общая сумма:</p>
            <p><?=$_SESSION['cart.sum']?> руб</p>
          </div>
        <?php endif; ?>

      </div>
      <?php else: ?>
        <div class="cart-content">
          <h3>Корзина пуста</h3>
        </div>
      <?php endif;?>
  <?php endif;?>

<?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])):?>
  <?php if($cart_products): ?>
    <div class="cart-items">
      <?php foreach($cart_products as $id => $item): ?>
        <div class="cart-item <?php if(($item['is_have'] == '0') || ( $item['is_have'] == '-')){echo 'cart_noact';};?>">
          <?php if(($item['is_have'] == '0') || ( $item['is_have'] == '-')): ?>
            <p class="have-not">нет в наличии</p>
          <?php endif; ?>
          <a href="product/<?=$item['alias'] ?>" class="cart-img cart-view">
              <img src="prodimg/<?= $item['img'] ?>" alt="<?=$item['title'] ?>">
          </a>
          <a class="cart-title" href="product/<?=$item['alias'] ?>"><?=$item['title'] ?></a>
          <div class="cart-qty">
            <input type="number" name="quantity" data-id="<?=$item['id'];?>" value="<?=$item['qty']?>" size="4" min="1" step="1">
          </div>

          <?php if ($_SESSION['user']['status'] == 'client'): ?>
            <?php if ($cart_sum >= DISCOUNT): ?>
              <?php if ($item['price_dis'] != 0): ?>
                <div class="cart-price">
                  <p>цена</p>
                  <p><span><?=$item['price'];?></span><?=$item['price_dis'];?> руб/<?=$item['units'];?></p>
                </div>
              <?php else: ?>
                <div class="cart-price">
                  <p>цена</p>
                  <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
                </div>
              <?php endif; ?>
            <?php else: ?>
              <div class="cart-price">
                <p>цена</p>
                <?php if (!($item['discount'])): ?>
                  <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
                <?php else: ?>
                  <p><?=round(($item['price'])*((100 - $item['discount'])/100), 2)?> руб/<?=$item['units'];?></p>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($_SESSION['user']['status'] == 'master'): ?>
            <?php if ($item['price_master'] != 0): ?>
              <div class="cart-price">
                <p>цена</p>
                <p><span><?=$item['price'];?></span><?=$item['price_master'];?> руб/<?=$item['units'];?></p>
              </div>
            <?php else: ?>
              <div class="cart-price">
                <p>цена</p>
                <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($_SESSION['user']['status'] == 'opt'): ?>
            <?php if ($item['price_opt'] != 0): ?>
              <div class="cart-price">
                <p>цена</p>
                <p><span><?=$item['price'];?></span><?=$item['price_opt'];?> руб/<?=$item['units'];?></p>
              </div>
            <?php else: ?>
              <div class="cart-price">
                <p>цена</p>
                <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($_SESSION['user']['status'] == 'client'): ?>
            <?php if ($cart_sum >= DISCOUNT): ?>
              <?php if ($item['price_dis'] != 0): ?>
                <div class="cart-price">
                  <p>сумма</p>
                  <p><?=$item['qty']*$item['price_dis']?> руб</p>
                </div>
              <?php else: ?>
                <div class="cart-price">
                  <p>сумма</p>
                  <p><?=$item['qty']*$item['price']?> руб</p>
                </div>
              <?php endif; ?>
            <?php else: ?>
              <div class="cart-price">
                <p>сумма</p>
                <?php if (!($item['discount'])): ?>
                  <p><?=$item['qty']*$item['price']?> руб</p>
                <?php else: ?>
                  <p><?=round(($item['price'])*((100 - $item['discount'])/100), 2)*$item['qty']?> руб</p>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($_SESSION['user']['status'] == 'master'): ?>
              <?php if ($item['price_master'] != 0): ?>
                <div class="cart-price">
                  <p>сумма</p>
                  <p><?=$item['qty']*$item['price_master']?> руб</p>
                </div>
              <?php else: ?>
                <div class="cart-price">
                  <p>сумма</p>
                  <p><?=$item['qty']*$item['price']?> руб</p>
                </div>
              <?php endif; ?>
          <?php endif; ?>

          <?php if ($_SESSION['user']['status'] == 'opt'): ?>
              <?php if ($item['price_opt'] != 0): ?>
                <div class="cart-price">
                  <p>сумма</p>
                  <p><?=$item['qty']*$item['price_opt']?> руб</p>
                </div>
              <?php else: ?>
                <div class="cart-price">
                  <p>сумма</p>
                  <p><?=$item['qty']*$item['price']?> руб</p>
                </div>
              <?php endif; ?>
          <?php endif; ?>

          <div class="cart-delete hover">
            <a href="cart/delete/?id=<?=$item['id']?>"><span data-id="<?=$item['id']?>" class="del-item" aria-hidden="true">X</span></a>
          </div>
        </div>
          <?php if(($item['is_have'] == '0') || ( $item['is_have'] == '-')){
            $cart_qty = $cart_qty - $item['qty'];
            $cart_sum = $cart_sum - $item['qty'] * $item['price'];
            if (isset($cart_sum_dis)) {
              $cart_sum_dis = $cart_sum_dis - $item['qty'] * $item['price'];
            }

          } ?>
      <?php endforeach;?>
    </div>
    <div class="cart-all">
      <div class="cart-all-qty">
        <p>Количество товаров в заказе:</p>
        <p class="all-sum"><?=$cart_qty?></p>
      </div>

    <?php if ($_SESSION['user']['status'] == 'client'): ?>
      <?php if ($cart_sum >= DISCOUNT): ?>
        <div class="cart-all-sum">
          <p>Общая сумма (с учётом скидки):</p>
          <p class="sum-discount"><?=$cart_sum_dis;?> руб.</p>
        </div>
        <div class="cart-all-sum">
          <p>Общая сумма (без скидки):</p>
          <p><?=$cart_sum;?> руб.</p>
        </div>
      <?php else: ?>
        <div class="cart-all-sum">
          <p>Общая сумма:</p>
          <p><?=$cart_sum;?> руб</p>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($_SESSION['user']['status'] == 'master'): ?>
        <div class="cart-all-sum">
          <p>Общая сумма (с учётом скидки):</p>
          <p class="sum-discount"><?=$cart_sum_master;?> руб.</p>
        </div>
        <div class="cart-all-sum">
          <p>Общая сумма (без скидки):</p>
          <p><?=$cart_sum;?> руб.</p>
        </div>
    <?php endif; ?>

    <?php if ($_SESSION['user']['status'] == 'opt'): ?>
        <div class="cart-all-sum">
          <p>Общая сумма (с учётом скидки):</p>
          <p class="sum-discount"><?=$cart_sum_opt;?> руб.</p>
        </div>
        <div class="cart-all-sum">
          <p>Общая сумма (без скидки):</p>
          <p><?=$cart_sum;?> руб.</p>
        </div>
    <?php endif; ?>


    </div>
  <?php else: ?>
    <div class="cart-content">
      <h3>Корзина пуста</h3>
    </div>
  <?php endif;?>
<?php endif;?>




<?php if ((isset($_SESSION['cart.sum']) && $_SESSION['cart.sum'] > 0 && !isset($_SESSION['user'])) || (isset($cart_sum) && $cart_sum > 0 && isset($_SESSION['user']))): ?>

<div class="register-top heading">
  <h2>Оформление заказа</h2>
</div>

      <form method="post" action="cart/checkout" class="order" id="order" role="form" data-toggle="validator" onsubmit="ym(98576053,'reachGoal','purchase');gtag('event', 'purchase'); return true;">
      <?php if(!isset($_SESSION['user'])): ?>
        <div class="form-group has-feedback">
            <label for="name">Имя*</label>
            <input id="name-send" type="text" name="name" class="form-control" placeholder="Имя" value="<?= isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name'] : '' ?>" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            <label for="phone">Телефон*</label>
            <input id="phone-send" type="tel" name="phone" class="form-control" placeholder="Телефон" value="<?= isset($_SESSION['form_data']['phone']) ? $_SESSION['form_data']['phone'] : '' ?>" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '' ?>">
        </div>

        <div class="deliv">
          <p>Способ доставки</p>
          <div class="sam-item">
            <div class="deliv-item sam">
              <p class="hover">Самовывоз</p>
            </div>
            <div class="sam-content">
              <div class="sam-flex">
                <label><input type="checkbox" name="samovivoz"> г. Минск, ул. Основателей 31/3</label>
              </div>
            </div>
          </div>
          <div class="run-item">
            <div class="deliv-item run">
              <p class="hover">Доставка</p>
				<p class="deliv-item-text">Условия и стоимость доставки уточняйте у менеджера</p>
            </div>
            <div class="run-content">
              <div class="form-group has-feedback">
                  <label for="address">Адрес доставки (стоимость доставки к итоговой сумме добавит менеджер после связи Вами и уточнении всех деталей заказа)</label>
                  <input type="text" name="address" class="form-control" id="address" placeholder="Адрес доставки" value="<?= isset($_SESSION['form_data']['address']) ? $_SESSION['form_data']['address'] : '' ?>">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              </div>
              <!--<div class="delivery-map">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A98bdb9cf42281b33ce2999a68253f4e6448d63eba8810705d061643b2fb32da4&amp;width=100%&amp;height=565&amp;lang=ru_RU&amp;scroll=true"></script>
              </div>-->
            </div>
          </div>
        </div>
        <div class="pay">
          <p>Способ оплаты</p>
          <div class="form-group">
            <label><input class="cash-pay" type="radio" name="pay" value="Наличные"> Наличные</label>
            <label><input class="card-pay" type="radio" name="pay" value="Оплата картой"> Оплата картой</label>
            <label><input class="virt" type="radio" name="pay" value="Безналичный расчёт"> Безналичный расчёт</label>
          </div>
        </div>

        <div class="form-group">
            <label for="note">Примечание к заказу</label>
            <textarea name="note" class="form-control"></textarea>
        </div>
        <div class="btn-order-wrap">
          <button type="submit" id="order-diz" class="btn-order hover">Оформить заказ</button>
        </div>

        <?php else: ?>
        <div class="form-group has-feedback">
          <label for="phone">Телефон*</label>
            <input type="tel" name="phone" class="form-control" id="phone-cart" placeholder="Телефон" value="<?= isset($_SESSION['form_data']['phone']) ? $_SESSION['form_data']['phone'] : '' ?>" required>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '' ?>">
        </div>

        <div class="deliv">
          <p>Способ доставки</p>
          <div class="sam-item">
            <div class="deliv-item sam">
              <p class="hover">Самовывоз</p>
            </div>
            <div class="sam-content">
              <div class="sam-flex">
                <label><input type="checkbox" name="samovivoz"> г. Минск, ул. Основателей 31/3</label>
              </div>
            </div>
          </div>
          <div class="run-item">
            <div class="deliv-item run">
              <p class="hover">Доставка</p>
				<p class="deliv-item-text">Условия и стоимость доставки уточняйте у менеджера</p>
            </div>
            <div class="run-content">
              <div class="form-group has-feedback">
                  <label for="address">Адрес доставки (стоимость доставки к итоговой сумме добавит менеджер после связи Вами и уточнении всех деталей заказа)</label>
                  <input type="text" name="address" class="form-control" id="address" placeholder="Адрес доставки" value="<?= isset($_SESSION['form_data']['address']) ? $_SESSION['form_data']['address'] : '' ?>">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              </div>
              <!--<div class="delivery-map">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A98bdb9cf42281b33ce2999a68253f4e6448d63eba8810705d061643b2fb32da4&amp;width=100%&amp;height=565&amp;lang=ru_RU&amp;scroll=true"></script>
              </div>-->
            </div>
          </div>
        </div>
        <div class="pay">
          <p>Способ оплаты</p>
          <div class="form-group">
            <label><input class="cash-pay" type="radio" name="pay" value="Наличные"> Наличные</label>
            <label><input class="card-pay" type="radio" name="pay" value="Оплата картой"> Оплата картой</label>
            <label><input class="virt" type="radio" name="pay" value="Безналичный расчёт"> Безналичный расчёт</label>
          </div>
        </div>

        <div class="form-group">
            <label for="address">Примечание к заказу</label>
            <textarea name="note" class="form-control"></textarea>
        </div>
        <div class="btn-order-wrap">
          <button type="submit" id="order-diz" class="btn-order hover">Оформить заказ</button>
        </div>
        <?php endif; ?>
      </form>
      <?php endif; ?>
    </div>
  </div>


  <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
  <div id="map"></div>
<!--product-end-->
