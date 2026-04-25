<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

  <?php
  $_monthsList = [
        ".01." => "января",
        ".02." => "февраля",
        ".03." => "марта",
        ".04." => "апреля",
        ".05." => "мая",
        ".06." => "июня",
        ".07." => "июля",
        ".08." => "августа",
        ".09." => "сентября",
        ".10." => "октября",
        ".11." => "ноября",
        ".12." => "декабря"
      ];
      $currentDate = date("d.m.Y  H:m"); //переменная $currentDate хранит текущую дату в формате 22.07.2020
      $_mD = date(".m.");
      $currentDate = str_replace($_mD, " ".$_monthsList[$_mD]." ", $currentDate);
   ?>
<div style="display:flex; align-items:center;">
  <p style="font-weight:bold; margin-right: 10px;">Дата и время заказа:</p>
  <p style="font-weight:bold;"><?= $currentDate ?></p>
</div>
<table style="border: 1px solid #ddd; border-collapse: collapse; width: 100%;">
    <thead>
    <tr style="background: #f9f9f9;">
        <th style="padding: 8px; border: 1px solid #ddd;">Наименование</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Артикул</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Кол-во</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Цена</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Сумма</th>
    </tr>
    </thead>
    <tbody>
      <?php if(isset($order_products)): ?>
        <?php foreach($order_products as $item): ?>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><?=$item['title'] ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?=$item['articul'] ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?=$item['qty'] ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?=$item['price'] ?> руб/<?=$item['units'] ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?=$item['price'] * $item['qty'] ?> руб</td>
            </tr>
        <?php endforeach;?>
      <?php endif; ?>
    </tbody>
</table>

<div style="display: flex; justify-content: flex-end;">
  <p style="padding: 8px; font-weight: bold;">Способ оплаты:</p>
    <p style="padding: 8px; border: 1px solid #ddd;"><?=$pay?></p>
</div>

<div style="display: flex; justify-content: flex-end;">
  <p style="padding: 8px; font-weight: bold;">Способ доставки:</p>
  <?php if($samovivoz == '1'): ?>
    <p style="padding: 8px; border: 1px solid #ddd;">Самовывоз - г. Минск, ул. Основателей 31/3</p>
  <?php endif; ?>
  <?php if(($samovivoz == '0') && (!empty($user_address))): ?>
      <p style="padding: 8px; border: 1px solid #ddd;">Доставка по адресу - <?=$user_address?></p>
  <?php endif; ?>
</div>

<div style="display: flex; justify-content: flex-end;">
  <p style="padding: 8px; font-weight: bold;">Комментарий к заказу</p>
  <?php if(!empty($note)): ?>
    <p style="padding: 8px; border: 1px solid #ddd;"><?=$note?></p>
  <?php endif; ?>
</div>

<div style="display: flex; justify-content: flex-end;">
  <p style="padding: 8px; font-weight: bold;">Итого:</p>
    <?php if(isset($order_qty)): ?>
      <p style="padding: 8px; border: 1px solid #ddd;"><?=$order_qty?></p>
    <?php endif; ?>
</div>

<div style="display: flex; justify-content: flex-end;">
  <p style="padding: 8px; font-weight: bold;">На сумму:</p>
  <p style="padding: 8px; border: 1px solid #ddd;"><?=$order_sum?> руб</p>
</div>

</body>
</html>
