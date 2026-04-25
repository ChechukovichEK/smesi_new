<?php

namespace app\controllers\admin;

use app\models\AppModel;
use app\models\Order;
use ishop\App;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends AppController{

  public function indexAction(){
    $this->setMeta('Экспорт в Excel');
  }


  public function exportorderAction(){
    //выгружаем таблицу orders в лист1
    $order = \R::getAll("SELECT * FROM `order`");
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0);
    $active_sheet = $spreadsheet->getActiveSheet();
    //формируем шапку заказа
    $active_sheet->setCellValue('A1','Уникальный код заказа');
    $active_sheet->setCellValue('B1','Уникальный код клиента');
    $active_sheet->setCellValue('C1','Имя клиента');
    $active_sheet->setCellValue('D1','Электронная почта');
    $active_sheet->setCellValue('E1','Телефон');
    $active_sheet->setCellValue('G1','ДатаВремяСозданияЗаказа');
    $active_sheet->setCellValue('H1','Способ доставки');
    $active_sheet->setCellValue('I1','Способ оплаты');
    $active_sheet->setCellValue('J1','Адрес доставки');
    $active_sheet->setCellValue('K1','Сумма заказа');
    $active_sheet->setCellValue('L1','Количество позиций в заказе');
    $active_sheet->setCellValue('M1','Статус');
    $active_sheet->setCellValue('N1','Менеджер');
    $active_sheet->setCellValue('O1','Сумма скидка клиента');
    $active_sheet->setCellValue('P1','Сумма мастер');
    $active_sheet->setCellValue('Q1','Сумма опт');
    $active_sheet->setCellValue('R1','Статус клиента');



    $row_start = 2;
    $i = 0;
    foreach($order as $item) {
     $row_next = $row_start + $i;
     $order_sum = Order::getSum($item['id']);
     $order_qty = Order::getQty($item['id']);
     $order_sum_master = Order::getSumMaster($item['id']);
     $order_sum_opt = Order::getSumOpt($item['id']);
     $order_sum_dis = Order::getSumDis($item['id']);
     if($item['samovivoz'] == '1'){
         $if_dostavka = 'самовывоз';
       }else{
         $if_dostavka = 'доставка';
    }
     $active_sheet->setCellValue('A'.$row_next,$item['id']);
     $active_sheet->setCellValue('B'.$row_next,$item['user_id']);
     $active_sheet->setCellValue('C'.$row_next,$item['name']);
     $active_sheet->setCellValue('D'.$row_next,$item['email']);
     $active_sheet->setCellValue('E'.$row_next,$item['phone']);
     $active_sheet->setCellValue('G'.$row_next,$item['date']);
     $active_sheet->setCellValue('H'.$row_next,$if_dostavka);
     $active_sheet->setCellValue('I'.$row_next,$item['pay']);
     $active_sheet->setCellValue('J'.$row_next,$item['address']);
     $active_sheet->setCellValue('K'.$row_next,$order_sum);
     $active_sheet->setCellValue('L'.$row_next,$order_qty);
     $active_sheet->setCellValue('M'.$row_next,$item['status']);
     $active_sheet->setCellValue('N'.$row_next,$item['manager']);

     if ($order_sum >= DISCOUNT && $item['user_status'] == 'client') {
       $active_sheet->setCellValue('O'.$row_next,$order_sum_dis);
     }
     else{
       $active_sheet->setCellValue('O'.$row_next,'-');
     }
     if ($item['user_status'] == 'master') {
       $active_sheet->setCellValue('P'.$row_next,$order_sum_master);
     }
     else {
       $active_sheet->setCellValue('P'.$row_next,'-');
     }
     if ($item['user_status'] == 'opt') {
       $active_sheet->setCellValue('Q'.$row_next, $order_sum_opt);
     }
     else {
       $active_sheet->setCellValue('Q'.$row_next,'-');
     }
     $active_sheet->setCellValue('R'.$row_next,$item['user_status']);
     $i++;
    }
//выгружаем таблицу orders в лист1
//выгружаем таблицу orders_product в лист2
  $order_products = \R::getAll("SELECT * FROM `order_product`");
  $spreadsheet->createSheet();
  $spreadsheet->setActiveSheetIndex(1);
  $active_sheet_prod = $spreadsheet->getActiveSheet();

  //формируем шапку продуктов заказа
  $active_sheet_prod->setCellValue('A1','Уникальный код заказа');
  $active_sheet_prod->setCellValue('B1','Уникальный код товара');
  $active_sheet_prod->setCellValue('C1','Артикул');
  $active_sheet_prod->setCellValue('D1','Количество');
  $active_sheet_prod->setCellValue('E1','Название товара');
  $active_sheet_prod->setCellValue('F1','Цена товара (розница)');
  $active_sheet_prod->setCellValue('G1','Скидка');
  $active_sheet_prod->setCellValue('H1','Уникальный номер записи');
  $active_sheet_prod->setCellValue('I1','Цена товара (скидка от 500 руб)');
  $active_sheet_prod->setCellValue('J1','Цена товара (мастер)');
  $active_sheet_prod->setCellValue('K1','Цена товара (опт)');
  $active_sheet_prod->setCellValue('L1','Единицы измерения');

  $row_start = 2;
  $i = 0;
  foreach($order_products as $item) {
   $row_next = $row_start + $i;
   $active_sheet_prod->setCellValue('A'.$row_next,$item['order_id']);
   $active_sheet_prod->setCellValue('B'.$row_next,$item['product_id']);
   $active_sheet_prod->setCellValue('C'.$row_next,$item['articul']);
   $active_sheet_prod->setCellValue('D'.$row_next,$item['qty']);
   $active_sheet_prod->setCellValue('E'.$row_next,$item['title']);
   $active_sheet_prod->setCellValue('F'.$row_next,$item['price']);
   $active_sheet_prod->setCellValue('G'.$row_next,$item['discount']);
   $active_sheet_prod->setCellValue('H'.$row_next,$item['id']);
   $active_sheet_prod->setCellValue('I'.$row_next,$item['price_dis']);
   $active_sheet_prod->setCellValue('J'.$row_next,$item['price_master']);
   $active_sheet_prod->setCellValue('K'.$row_next,$item['price_opt']);
   $active_sheet_prod->setCellValue('L'.$row_next,$item['units']);
   $i++;
  }
$writer = new Xlsx($spreadsheet);
$writer->save(WWW . '/export/orders/orders' . date('d-m-Y_H-i-s') . '.xlsx');
header("Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition:attachment;filename=orders.xlsx");
$writer->save('php://output');
$_SESSION['success'] = "Заказы успешно выгружены";
}


public function exportuserAction(){
  //выгружаем таблицу user в лист1
  $user = \R::getAll("SELECT * FROM `user`");
  $spreadsheet = new Spreadsheet();
  $spreadsheet->setActiveSheetIndex(0);
  $active_sheet = $spreadsheet->getActiveSheet();
  //формируем шапку заказа
  $active_sheet->setCellValue('A1','Уникальный код клиента');
  $active_sheet->setCellValue('B1','Имя клиента');
  $active_sheet->setCellValue('C1','Телефон');
  $active_sheet->setCellValue('D1','Логин на сайте');
  $active_sheet->setCellValue('E1','Адрес');
  $active_sheet->setCellValue('F1','E-mail');
  $active_sheet->setCellValue('G1','Роль');

  $row_start = 2;
  $i = 0;
  foreach($user as $item) {
   $row_next = $row_start + $i;
   $active_sheet->setCellValue('A'.$row_next,$item['id']);
   $active_sheet->setCellValue('B'.$row_next,$item['name']);
   $active_sheet->setCellValue('C'.$row_next,$item['phone']);
   $active_sheet->setCellValue('D'.$row_next,$item['login']);
   $active_sheet->setCellValue('E'.$row_next,$item['address']);
   $active_sheet->setCellValue('F'.$row_next,$item['email']);
   $active_sheet->setCellValue('G'.$row_next,$item['role']);
   $i++;
  }
  //выгружаем таблицу user в лист1
  $writer = new Xlsx($spreadsheet);
  $writer->save(WWW . '/export/users/user' . date('d-m-Y_H-i-s') . '.xlsx');
  header("Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  header("Content-Disposition:attachment;filename=users.xlsx");
  $writer->save('php://output');
  $_SESSION['success'] = "Пользователи успешно выгружены";
}

public function exportproductAction(){
  //выгружаем таблицу product в лист1
  $product = \R::getAll("SELECT * FROM `product`");
  $spreadsheet = new Spreadsheet();
  $spreadsheet->setActiveSheetIndex(0);
  $active_sheet = $spreadsheet->getActiveSheet();
  //формируем шапку заказа
  $active_sheet->setCellValue('A1','Уникальный код товара');
  $active_sheet->setCellValue('B1','Позиция в группе');
  $active_sheet->setCellValue('C1','Уникальный код основной группы');
  $active_sheet->setCellValue('D1','Название основной группы');
  $active_sheet->setCellValue('E1','Название товара');
  $active_sheet->setCellValue('F1','Артикул');
  $active_sheet->setCellValue('G1','Валюта');
  $active_sheet->setCellValue('H1','Единицы');
  $active_sheet->setCellValue('I1','Цена');
  $active_sheet->setCellValue('J1','Наличие');
  $active_sheet->setCellValue('K1','Описание');
  $active_sheet->setCellValue('L1','Производитель');
  $active_sheet->setCellValue('M1','Страна производителя');
  $active_sheet->setCellValue('N1','Хит(да/нет)');
  $active_sheet->setCellValue('O1','Название характеристики1');
  $active_sheet->setCellValue('P1','Измерение характеристики1');
  $active_sheet->setCellValue('Q1','Значение характеристики1');
  $active_sheet->setCellValue('R1','Название характеристики2');
  $active_sheet->setCellValue('S1','Измерение характеристики2');
  $active_sheet->setCellValue('T1','Значение характеристики2');
  $active_sheet->setCellValue('U1','Название характеристики3');
  $active_sheet->setCellValue('V1','Измерение характеристики3');
  $active_sheet->setCellValue('W1','Значение характеристики3');
  $active_sheet->setCellValue('X1','Название характеристики4');
  $active_sheet->setCellValue('Y1','Измерение характеристики4');
  $active_sheet->setCellValue('Z1','Значение характеристики4');
  $active_sheet->setCellValue('AA1','Название характеристики5');
  $active_sheet->setCellValue('AB1','Измерение характеристики5');
  $active_sheet->setCellValue('AC1','Значение характеристики5');
  $active_sheet->setCellValue('AD1','Название характеристики6');
  $active_sheet->setCellValue('AE1','Измерение характеристики6');
  $active_sheet->setCellValue('AF1','Значение характеристики6');
  $active_sheet->setCellValue('AG1','Название характеристики7');
  $active_sheet->setCellValue('AH1','Измерение характеристики7');
  $active_sheet->setCellValue('AI1','Значение характеристики7');
  $active_sheet->setCellValue('AJ1','Название характеристики8');
  $active_sheet->setCellValue('AK1','Измерение характеристики8');
  $active_sheet->setCellValue('AL1','Значение характеристики8');
  $active_sheet->setCellValue('AM1','Название характеристики9');
  $active_sheet->setCellValue('AN1','Измерение характеристики9');
  $active_sheet->setCellValue('AO1','Значение характеристики9');
  $active_sheet->setCellValue('AP1','Название характеристики10');
  $active_sheet->setCellValue('AQ1','Измерение характеристики10');
  $active_sheet->setCellValue('AR1','Значение характеристики10');
  $active_sheet->setCellValue('AS1','Название характеристики11');
  $active_sheet->setCellValue('AT1','Измерение характеристики11');
  $active_sheet->setCellValue('AU1','Значение характеристики11');
  $active_sheet->setCellValue('AV1','Название характеристики12');
  $active_sheet->setCellValue('AW1','Измерение характеристики12');
  $active_sheet->setCellValue('AX1','Значение характеристики12');
  $active_sheet->setCellValue('AY1','Название характеристики13');
  $active_sheet->setCellValue('AZ1','Измерение характеристики13');
  $active_sheet->setCellValue('BA1','Значение характеристики13');
  $active_sheet->setCellValue('BB1','Название характеристики14');
  $active_sheet->setCellValue('BC1','Измерение характеристики14');
  $active_sheet->setCellValue('BD1','Значение характеристики14');
  $active_sheet->setCellValue('BE1','Название характеристики15');
  $active_sheet->setCellValue('BF1','Измерение характеристики15');
  $active_sheet->setCellValue('BG1','Значение характеристики15');
  $active_sheet->setCellValue('BH1','Название характеристики16');
  $active_sheet->setCellValue('BI1','Измерение характеристики16');
  $active_sheet->setCellValue('BJ1','Значение характеристики16');
  $active_sheet->setCellValue('BK1','Название характеристики17');
  $active_sheet->setCellValue('BL1','Измерение характеристики17');
  $active_sheet->setCellValue('BM1','Значение характеристики17');
  $active_sheet->setCellValue('BN1','Название характеристики18');
  $active_sheet->setCellValue('BO1','Измерение характеристики18');
  $active_sheet->setCellValue('BP1','Значение характеристики18');
  $active_sheet->setCellValue('BQ1','Название характеристики19');
  $active_sheet->setCellValue('BR1','Измерение характеристики19');
  $active_sheet->setCellValue('BS1','Значение характеристики19');
  $active_sheet->setCellValue('BT1','Название характеристики20');
  $active_sheet->setCellValue('BU1','Измерение характеристики20');
  $active_sheet->setCellValue('BV1','Значение характеристики20');
  $active_sheet->setCellValue('BW1','Название характеристики21');
  $active_sheet->setCellValue('BX1','Измерение характеристики21');
  $active_sheet->setCellValue('BY1','Значение характеристики21');
  $active_sheet->setCellValue('BZ1','Скидка на товар');

  $row_start = 2;
  $i = 0;
  foreach($product as $item) {
   $row_next = $row_start + $i;
   $active_sheet->setCellValue('A'.$row_next,$item['id']);
   $active_sheet->setCellValue('B'.$row_next,$item['position']);
   $active_sheet->setCellValue('C'.$row_next,$item['category_id']);
   $active_sheet->setCellValue('D'.$row_next,$item['category_title']);
   $active_sheet->setCellValue('E'.$row_next,$item['title']);
   $active_sheet->setCellValue('F'.$row_next,$item['articul']);
   $active_sheet->setCellValue('G'.$row_next,$item['currency']);
   $active_sheet->setCellValue('H'.$row_next,$item['units']);
   $active_sheet->setCellValue('I'.$row_next,$item['price']);
   $active_sheet->setCellValue('J'.$row_next,$item['is_have']);
   $active_sheet->setCellValue('K'.$row_next,$item['content']);
   $active_sheet->setCellValue('L'.$row_next,$item['manufacturer']);
   $active_sheet->setCellValue('M'.$row_next,$item['manufacturer_country']);
   $active_sheet->setCellValue('N'.$row_next,$item['hit']);
   $active_sheet->setCellValue('O'.$row_next,$item['char1']);
   $active_sheet->setCellValue('P'.$row_next,$item['mesure1']);
   $active_sheet->setCellValue('Q'.$row_next,$item['val1']);
   $active_sheet->setCellValue('R'.$row_next,$item['char2']);
   $active_sheet->setCellValue('S'.$row_next,$item['mesure2']);
   $active_sheet->setCellValue('T'.$row_next,$item['val2']);
   $active_sheet->setCellValue('U'.$row_next,$item['char3']);
   $active_sheet->setCellValue('V'.$row_next,$item['mesure3']);
   $active_sheet->setCellValue('W'.$row_next,$item['val3']);
   $active_sheet->setCellValue('X'.$row_next,$item['char4']);
   $active_sheet->setCellValue('Y'.$row_next,$item['mesure4']);
   $active_sheet->setCellValue('Z'.$row_next,$item['val4']);
   $active_sheet->setCellValue('AA'.$row_next,$item['char5']);
   $active_sheet->setCellValue('AB'.$row_next,$item['mesure5']);
   $active_sheet->setCellValue('AC'.$row_next,$item['val5']);
   $active_sheet->setCellValue('AD'.$row_next,$item['char6']);
   $active_sheet->setCellValue('AE'.$row_next,$item['mesure6']);
   $active_sheet->setCellValue('AF'.$row_next,$item['val6']);
   $active_sheet->setCellValue('AG'.$row_next,$item['char7']);
   $active_sheet->setCellValue('AH'.$row_next,$item['mesure7']);
   $active_sheet->setCellValue('AI'.$row_next,$item['val7']);
   $active_sheet->setCellValue('AJ'.$row_next,$item['char8']);
   $active_sheet->setCellValue('AK'.$row_next,$item['mesure8']);
   $active_sheet->setCellValue('AL'.$row_next,$item['val8']);
   $active_sheet->setCellValue('AM'.$row_next,$item['char9']);
   $active_sheet->setCellValue('AN'.$row_next,$item['mesure9']);
   $active_sheet->setCellValue('AO'.$row_next,$item['val9']);
   $active_sheet->setCellValue('AP'.$row_next,$item['char10']);
   $active_sheet->setCellValue('AQ'.$row_next,$item['mesure10']);
   $active_sheet->setCellValue('AR'.$row_next,$item['val10']);
   $active_sheet->setCellValue('AS'.$row_next,$item['char11']);
   $active_sheet->setCellValue('AT'.$row_next,$item['mesure11']);
   $active_sheet->setCellValue('AU'.$row_next,$item['val11']);
   $active_sheet->setCellValue('AV'.$row_next,$item['char12']);
   $active_sheet->setCellValue('AW'.$row_next,$item['mesure12']);
   $active_sheet->setCellValue('AX'.$row_next,$item['val12']);
   $active_sheet->setCellValue('AY'.$row_next,$item['char13']);
   $active_sheet->setCellValue('AZ'.$row_next,$item['mesure13']);
   $active_sheet->setCellValue('BA'.$row_next,$item['val13']);
   $active_sheet->setCellValue('BB'.$row_next,$item['char14']);
   $active_sheet->setCellValue('BC'.$row_next,$item['mesure14']);
   $active_sheet->setCellValue('BD'.$row_next,$item['val14']);
   $active_sheet->setCellValue('BE'.$row_next,$item['char15']);
   $active_sheet->setCellValue('BF'.$row_next,$item['mesure15']);
   $active_sheet->setCellValue('BG'.$row_next,$item['val15']);
   $active_sheet->setCellValue('BH'.$row_next,$item['char16']);
   $active_sheet->setCellValue('BI'.$row_next,$item['mesure16']);
   $active_sheet->setCellValue('BJ'.$row_next,$item['val16']);
   $active_sheet->setCellValue('BK'.$row_next,$item['char17']);
   $active_sheet->setCellValue('BL'.$row_next,$item['mesure17']);
   $active_sheet->setCellValue('BM'.$row_next,$item['val17']);
   $active_sheet->setCellValue('BN'.$row_next,$item['char18']);
   $active_sheet->setCellValue('BO'.$row_next,$item['mesure18']);
   $active_sheet->setCellValue('BP'.$row_next,$item['val18']);
   $active_sheet->setCellValue('BQ'.$row_next,$item['char19']);
   $active_sheet->setCellValue('BR'.$row_next,$item['mesure19']);
   $active_sheet->setCellValue('BS'.$row_next,$item['val19']);
   $active_sheet->setCellValue('BT'.$row_next,$item['char20']);
   $active_sheet->setCellValue('BU'.$row_next,$item['mesure20']);
   $active_sheet->setCellValue('BV'.$row_next,$item['val20']);
   $active_sheet->setCellValue('BW'.$row_next,$item['char21']);
   $active_sheet->setCellValue('BX'.$row_next,$item['mesure21']);
   $active_sheet->setCellValue('BY'.$row_next,$item['val21']);
   $active_sheet->setCellValue('BZ'.$row_next,$item['discount']);
   $i++;
  }
  //выгружаем таблицу product в лист1
  //выгружаем таблицу cat_product в лист2
  $cat_product = \R::getAll("SELECT * FROM `cat_product`");
  $spreadsheet->createSheet();
  $spreadsheet->setActiveSheetIndex(1);
  $active_sheet_prod = $spreadsheet->getActiveSheet();

  //формируем шапку продуктов заказа
  $active_sheet_prod->setCellValue('A1','Уникальный код группы');
  $active_sheet_prod->setCellValue('B1','Уникальный код товара');
  $active_sheet_prod->setCellValue('C1','Уникальный код записи');

  $row_start = 2;
  $i = 0;
  foreach($cat_product as $item) {
   $row_next = $row_start + $i;
   $active_sheet_prod->setCellValue('A'.$row_next,$item['cat_id']);
   $active_sheet_prod->setCellValue('B'.$row_next,$item['prod_id']);
   $active_sheet_prod->setCellValue('C'.$row_next,$item['id']);
   $i++;
  }
  //выгружаем таблицу cat_product в лист2
  //header("Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  //header("Content-Disposition:attachment;filename=simple.xlsx");
  $writer = new Xlsx($spreadsheet);
  $writer->save(WWW . '/export/products/products' . date('d-m-Y_H-i-s') . '.xlsx');
  header("Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  header("Content-Disposition:attachment;filename=products.xlsx");
  $writer->save('php://output');
  $_SESSION['success'] = "Товары успешно выгружены";
}


}
