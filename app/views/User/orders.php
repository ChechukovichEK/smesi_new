<div class="breadcrumbs">
  <div class="breadcrumbs-content">
    <div class="breadcrumbs-main">
      <ol class="breadcrumb">
        <li><a href="<?= PATH ?>">Главная</a></li>
        <li><a href="<?= PATH ?>/user/cabinet">Личный кабинет</a></li>
        <li>Список заказов</li>
      </ol>
    </div>
  </div>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body" id="order-list">
          <div class="table-responsive">
            <div class="table-header">
              <p class="num">№</p>
              <p class="stat">Статус</p>
              <p class="sum-cab">Сумма</p>
              <p class="date-cab">Дата создания</p>
              <p class="watch">Просмотреть</p>
            </div>
            <div class="table-body">
              <?php foreach($orders as $order): ?>
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
                  <p><?=$order['id'];?></p>
                  <p><?=$order['status'];?></p>

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

                  <p><?=$order['date'];?></p>
                  <p><a class="view-order btn hover" href="order/view?id=<?=$order['id'];?>">просмотреть</a></p>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
                    <div class="text-center">
                      <?php if (isset($pagination)): ?>
                        <?php if($pagination->countPages > 1): ?>
                            <?=$pagination;?>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
