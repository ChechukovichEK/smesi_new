<?php if(!empty($_SESSION['cart']) && !isset($_SESSION['user'])):?>
    <?php if(!empty($_SESSION['cart'])): ?>
    <div class="cart-mods">
      <?php foreach($_SESSION['cart'] as $id => $item): ?>
        <div class="cart-mod">
          <div class="cart-mod-img">
            <a class="hover" href="product/<?=$item['alias'];?>"><img src="prodimg/<?=$item['img'];?>" alt="<?=$item['title'];?>"></a>
          </div>
          <div class="cart-mod-title">
            <a class="hover" href="product/<?=$item['alias'];?>"><?=$item['title'];?></a>
          </div>
          <div class="quantity">
            <input class="input-number__input" type="number" pattern="^[0-9]+$" value="<?=$item['qty'];?>" name="quantity" data-id="<?=$id;?>">
          </div>
          <?php if ($_SESSION['cart.sum'] >= DISCOUNT): ?>
            <?php if ($item['price_dis'] != 0): ?>
              <div class="cart-mod-price">
                <p>цена</p>
                <p><span><?=$item['price'];?></span><?=$item['price_dis'];?> руб/<?=$item['units'];?></p>
              </div>
            <?php else: ?>
              <div class="cart-mod-price">
                <p>цена</p>
                <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <div class="cart-mod-price">
              <p>цена</p>
              <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
            </div>
          <?php endif; ?>

          <?php if ($_SESSION['cart.sum'] >= DISCOUNT): ?>
            <?php if ($item['price_dis'] != 0): ?>
              <div class="cart-mod-price">
                <p>сумма</p>
                <p><?=$item['qty']*$item['price_dis']?> руб</p>
              </div>
            <?php else: ?>
              <div class="cart-mod-price">
                <p>сумма</p>
                <p><?=$item['qty']*$item['price']?> руб</p>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <div class="cart-mod-price">
              <p>сумма</p>
              <p><?=$item['qty']*$item['price']?> руб</p>
            </div>
          <?php endif; ?>

          <div class="cart-mod-del">
            <span data-id="<?=$id;?>" class="del-item hover">X</span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="mod-foot">
      <div class="itogo">
        <p>Итого:</p>
        <p class="cart-qty"><span><?=$_SESSION['cart.qty'];?></span> шт.</p>
      </div>
      <?php if ($_SESSION['cart.sum'] >= DISCOUNT): ?>
        <div class="mod-sum">
          <p>На сумму (с учётом скидки):</p>
          <p class="cart-sum sum-discount"><?=$_SESSION['cart.disc'];?> руб.</p>
        </div>
        <div class="mod-sum">
          <p>На сумму (без скидки):</p>
          <p class="cart-sum"><?=$_SESSION['cart.sum'];?> руб.</p>
        </div>
      <?php else: ?>
        <div class="mod-sum">
          <p>На сумму:</p>
          <p class="cart-sum"><?=$_SESSION['cart.sum'];?> руб.</p>
        </div>
      <?php endif; ?>
    </div>

  <?php else: ?>
      <h3>Корзина пуста</h3>
  <?php endif; ?>
<?php endif; ?>

<?php if(!empty($_SESSION['user'])): ?>
  <?php if(isset($cart_products) && !empty($cart_products)): ?>
      <div class="cart-mods">
        <?php foreach($cart_products as $id => $item): ?>
          <div class="cart-mod <?php if(($item['is_have'] == '0') || ( $item['is_have'] == '-')){echo 'cart_noact';};?>">
            <?php if(($item['is_have'] == '0') || ( $item['is_have'] == '-')): ?>
              <p class="have-not">нет в наличии</p>
            <?php endif; ?>
            <div class="cart-mod-img">
              <a class="hover" href="product/<?=$item['alias'];?>"><img src="prodimg/<?=$item['img'];?>" alt="<?=$item['title'];?>"></a>
            </div>
            <div class="cart-mod-title">
              <a class="hover" href="product/<?=$item['alias'];?>"><?=$item['title'];?></a>
            </div>
            <div class="quantity">
              <input class="input-number__input" type="number" pattern="^[0-9]+$" value="<?=$item['qty'];?>" name="quantity" data-id="<?=$item['id']?>">
            </div>

            <?php if ($_SESSION['user']['status'] == 'client'): ?>
              <?php if ($cart_sum >= DISCOUNT): ?>
                <?php if ($item['price_dis'] != 0): ?>
                  <div class="cart-mod-price">
                    <p>цена</p>
                    <p><span><?=$item['price'];?></span><?=$item['price_dis'];?> руб/<?=$item['units'];?></p>
                  </div>
                <?php else: ?>
                  <div class="cart-mod-price">
                    <p>цена</p>
                    <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
                  </div>
                <?php endif; ?>
              <?php else: ?>
                <div class="cart-mod-price">
                  <p>цена</p>
                    <?php if (!($item['discount'])): ?>
                      <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
                    <?php else: ?>
                      <p><?=round(($item['price'])*((100 - $item['discount'])/100), 2)?> руб/<?=$item['units'];?></p>
                    <?php endif; ?>
                </div>
              <?php endif; ?>

              <?php if ($cart_sum >= DISCOUNT): ?>
                <?php if ($item['price_dis'] != 0): ?>
                  <div class="cart-mod-price">
                    <p>сумма</p>
                    <p><?=$item['qty']*$item['price_dis']?> руб</p>
                  </div>
                <?php else: ?>
                  <div class="cart-mod-price">
                    <p>сумма</p>
                    <p><?=$item['qty']*$item['price']?> руб</p>
                  </div>
                <?php endif; ?>
              <?php else: ?>
                <div class="cart-mod-price">
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
                  <div class="cart-mod-price">
                    <p>цена</p>
                    <p><span><?=$item['price'];?></span><?=$item['price_master'];?> руб/<?=$item['units'];?></p>
                  </div>
                <?php else: ?>
                  <div class="cart-mod-price">
                    <p>цена</p>
                    <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
                  </div>
                <?php endif; ?>

                <?php if ($item['price_master'] != 0): ?>
                  <div class="cart-mod-price">
                    <p>сумма</p>
                    <p><?=$item['qty']*$item['price_master']?> руб</p>
                  </div>
                <?php else: ?>
                  <div class="cart-mod-price">
                    <p>сумма</p>
                    <p><?=$item['qty']*$item['price']?> руб</p>
                  </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($_SESSION['user']['status'] == 'opt'): ?>
                <?php if ($item['price_opt'] != 0): ?>
                  <div class="cart-mod-price">
                    <p>цена</p>
                    <p><span><?=$item['price'];?></span><?=$item['price_opt'];?> руб/<?=$item['units'];?></p>
                  </div>
                <?php else: ?>
                  <div class="cart-mod-price">
                    <p>цена</p>
                    <p><?=$item['price'];?> руб/<?=$item['units'];?></p>
                  </div>
                <?php endif; ?>

                <?php if ($item['price_opt'] != 0): ?>
                  <div class="cart-mod-price">
                    <p>сумма</p>
                    <p><?=$item['qty']*$item['price_opt']?> руб</p>
                  </div>
                <?php else: ?>
                  <div class="cart-mod-price">
                    <p>сумма</p>
                    <p><?=$item['qty']*$item['price']?> руб</p>
                  </div>
                <?php endif; ?>
            <?php endif; ?>


            <div class="cart-mod-del">
              <span data-id="<?=$item['id']?>" class="del-item hover">X</span>
            </div>
          </div>
          <?php if(($item['is_have'] == '0') || ( $item['is_have'] == '-')){
            $cart_qty = $cart_qty - $item['qty'];
            $cart_sum = $cart_sum - $item['qty'] * $item['price'];
            if($item['price_dis'] != 0){
              $cart_sum_dis = $cart_sum_dis - $item['qty'] * $item['price_dis'];
            }
            else{
              $cart_sum_dis = $cart_sum_dis - $item['qty'] * $item['price'];
            }
          } ?>
        <?php endforeach; ?>
    </div>

    <div class="mod-foot">
      <div class="itogo">
        <p>Итого:</p>
        <p class="cart-qty"><span><?=$cart_qty?></span> шт.</p>
      </div>
      <?php if ($_SESSION['user']['status'] == 'client'): ?>
        <?php if ($cart_sum >= DISCOUNT): ?>
          <div class="mod-sum">
            <p>На сумму (с учётом скидки):</p>
            <p class="cart-sum sum-discount"><?=$cart_sum_dis?> руб.</p>
          </div>
          <div class="mod-sum">
            <p>На сумму (без скидки):</p>
            <p class="cart-sum"><?=$cart_sum?> руб.</p>
          </div>
        <?php else: ?>
          <div class="mod-sum">
            <p>На сумму:</p>
            <p class="cart-sum"><?=$cart_sum?> руб.</p>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <?php if ($_SESSION['user']['status'] == 'master'): ?>
          <div class="mod-sum">
            <p>На сумму (с учётом скидки):</p>
            <p class="cart-sum sum-discount"><?=$cart_sum_master?> руб.</p>
          </div>
          <div class="mod-sum">
            <p>На сумму (без скидки):</p>
            <p class="cart-sum"><?=$cart_sum?> руб.</p>
          </div>
      <?php endif; ?>

      <?php if ($_SESSION['user']['status'] == 'opt'): ?>
          <div class="mod-sum">
            <p>На сумму (с учётом скидки):</p>
            <p class="cart-sum sum-discount"><?=$cart_sum_opt?> руб.</p>
          </div>
          <div class="mod-sum">
            <p>На сумму (без скидки):</p>
            <p class="cart-sum"><?=$cart_sum?> руб.</p>
          </div>
      <?php endif; ?>

    </div>

  <?php else: ?>
    <h3>Корзина пуста</h3>
  <?php endif; ?>
<?php endif; ?>
