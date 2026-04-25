<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
        <li><a href="<?= PATH ?>">Главная</a></li>
        <li><a href="<?= PATH ?>/user/cabinet">Личный кабинет</a></li>
        <li><a href="<?= PATH ?>/user/orders">Список заказов</a></li>
        <li>Заказ № <span class="num"><?=$order['id'];?></span></li>
      </ol>
    </div>
  </div>
</div>

<div class="view-orders">
  <div class="content-orders">
      <h1>Заказ № <span><?=$order['id'];?></span> - <?=$order['name'];?></h1>
  </div>
<div class="table-responsive">
  <div class="table-header" id="vieword">
    <p>Дата заказа</p>
    <p>Кол-во позиций в заказе</p>
    <p>Сумма заказа</p>
    <p>Статус</p>
  </div>
  <div class="table-body">
      <?php
        if($order['status'] == 'новый'){
          $class = '';
        }
        if($order['status'] == 'в процессе'){
          $class = 'info';
        }
        if($order['status'] == 'завершен'){
          $class = 'success';
        }
        ?>
      <div class="<?=$class;?>">
        <p><?=$order['date'];?></p>
        <p><?=count($order_products);?></p>

        <?php if ($order['user_status'] == 'client'): ?>
          <?php if ($order['sum'] >= DISCOUNT): ?>
            <p><?=$order['sum_discount']?> руб</p>
          <?php else: ?>
            <p><?=$order['sum']?> руб</p>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($order['user_status'] == 'master'): ?>
            <p><?=$order['sum_master']?> руб</p>
        <?php endif; ?>

        <?php if ($order['user_status'] == 'opt'): ?>
            <p><?=$order['sum_opt']?> руб</p>
        <?php endif; ?>

        <p><?=$order['status'];?></p>
      </div>
  </div>

</div>

<div class="order-details">
  <h3>Детали заказа</h3>
  <div class="box">
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="left table-bold">Наименование</th>
              <th class="table-bold">Кол-во</th>
              <th class="table-bold">Цена</th>
              <th class="table-bold">Сумма</th>
            </tr>
          </thead>
          <tbody>
            <?php $qty = 0; foreach($order_products as $product): ?>
              <tr>
                <td class="left font-sm hover"><a class="link" href = 'product/<?=$product->alias;?>'><?=$product->title;?></a></td>
                <td class="num"><?=$product->qty; $qty += $product->qty?></td>

                <?php if ($order['user_status'] == 'client'): ?>
                  <?php if ($order['sum'] >= DISCOUNT): ?>
                    <?php if ($product->price_dis != 0): ?>
                      <td class="num"><?=$product->price_dis;?> руб.</td>
                      <td class="num"><?=$product->price_dis * $product->qty;?> руб.</td>
                    <?php else: ?>
                      <td class="num"><?=$product->price;?> руб.</td>
                      <td class="num"><?=$product->price * $product->qty;?> руб.</td>
                    <?php endif; ?>
                  <?php else: ?>
                    <td class="num"><?=$product->price;?> руб.</td>
                    <td class="num"><?=$product->price * $product->qty;?> руб.</td>
                  <?php endif; ?>
                <?php endif; ?>

                <?php if ($order['user_status'] == 'master'): ?>
                      <?php if ($product->price_master != 0): ?>
                        <td><?=$product->price_master;?> руб.</td>
                        <td><?=$product->price_master * $product->qty;?> руб.</td>
                      <?php else: ?>
                        <td><?=$product->price;?> руб.</td>
                        <td><?=$product->price * $product->qty;?> руб.</td>
                      <?php endif; ?>
                <?php endif; ?>

                <?php if ($order['user_status'] == 'opt'): ?>
                      <?php if ($product->price_opt != 0): ?>
                        <td><?=$product->price_opt;?> руб.</td>
                        <td><?=$product->price_opt * $product->qty;?> руб.</td>
                      <?php else: ?>
                        <td><?=$product->price;?> руб.</td>
                        <td><?=$product->price * $product->qty;?> руб.</td>
                      <?php endif; ?>
                <?php endif; ?>
              </tr>


            <?php endforeach; ?>
              <tr class="active">
                <td colspan="1" class="left table-bold">
                  <b>Итого:</b>
                </td>
                <td class="num"><?=$qty;?></td>
                <td><b></b></td>

                <?php if ($order['user_status'] == 'client'): ?>
                  <?php if ($order['sum'] >= DISCOUNT): ?>
                    <td class="num"><b><?=$order['sum_discount'];?> руб.</b></td>
                  <?php else: ?>
                    <td class="num"><b><?=$order['sum'];?> руб.</b></td>
                  <?php endif; ?>
                <?php endif; ?>

                <?php if ($order['user_status'] == 'master'): ?>
                  <td class="num"><b><?=$order['sum_master'];?> руб.</b></td>
                <?php endif; ?>

                <?php if ($order['user_status'] == 'opt'): ?>
                  <td class="num"><b><?=$order['sum_opt'];?> руб.</b></td>
                <?php endif; ?>

              </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
