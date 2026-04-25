<?php

function updateDb($db)
{
    mysqli_query($db, "START TRANSACTION");
    $q = "
            UPDATE product_temp
            INNER JOIN price_temp ptr  USING (id)
            SET product_temp.price = ptr.price, 
            product_temp.price_dis = ptr.price_dis, 
            product_temp.price_master = ptr.price_master, 
            product_temp.price_opt = ptr.price_opt
        ";
    mysqli_query($db, $q);

    mysqli_query($db, "COMMIT");
}

$config = require_once 'e:/smesi.loc/config/config_db.php';

$db = @mysqli_connect(
    'localhost',
    $config['user'],
    $config['pass'],
    'smesi'
) or die ('Ошибка! Сервер не отвечает.');
$select_db = @mysqli_select_db($db, 'smesi') or die ('Ошибка! База данных не отвечает. ');
mysqli_set_charset($db, 'utf8');

set_time_limit(0);
$docXml = new \stdClass();
$productsIdNotFind = [];

$data = simplexml_load_string(file_get_contents('e:/smesi.loc/public/xml_load/price.xml'));
$docXml->docDate = $data->PriceListHead->DocDate->__toString();
$docXml->docNumber = $data->PriceListHead->DocNumber->__toString();

foreach ($data->PriceListRows->PriceListRow as $row) {
    $el = new \stdClass();
    $el->id = $row->Good->Good_id->__toString();
    $el->name = $row->Good->Good_name->__toString();

    $el->priceRetail = $row->Priceretail->__toString();                     //price
    $el->priceRetailWholesale = $row->PriceretailWholesale->__toString();   //price_opt
    $el->priceRetailDiscount = $row->PriceretailDiscount->__toString();     //price_dis
    $el->priceRetailMaster = $row->PriceretailMaster->__toString();         //price_master
    $docXml->rows[] = $el;
}
unset($data);

mysqli_query($db, "START TRANSACTION");
mysqli_query($db, "DELETE FROM price_temp");

$total = count($docXml->rows);
foreach ($docXml->rows as $el) {
    $id = $el->id;

    $q = "
        INSERT INTO price_temp (id, price, price_dis, price_master, price_opt)
        VALUES ($id, '$el->priceRetail', '$el->priceRetailDiscount', '$el->priceRetailMaster','$el->priceRetailWholesale');
    ";

    $rez = mysqli_query($db, $q);
    $total -= empty($rez) ? 0 : 1;
    if (empty($rez)) {
        file_put_contents(__DIR__ . '/logEmpty.txt', "$id " . PHP_EOL, FILE_APPEND);
    }
}
mysqli_query($db, "COMMIT");

updateDb($db);
rename('e:/smesi.loc/public/xml_load/price.xml', 'e:/smesi.loc/public/xml_load/old/price.xml');

echo 'ok';
exit();
