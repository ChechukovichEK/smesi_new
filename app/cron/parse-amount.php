<?php

function updateDb($db)
{
    mysqli_query($db, "START TRANSACTION");
    $q = "
            UPDATE product
            INNER JOIN amount_temp amount  USING (id)
            SET product.amount = amount.amount 
        ";
    mysqli_query($db, $q);

    mysqli_query($db, "COMMIT");
}

$config = require_once '/home/smesiby/public_html/config/config_db.php';

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

$data = simplexml_load_string(file_get_contents('e:/smesi.loc/public/xml_load/amount.xml'));

if(is_bool($data)){
    echo 'Нет данных';
    exit();
}

foreach ($data->RemainsRows->RemainsRow as $row) {
    $el = new \stdClass();

    $el->id = $row->Good_id->__toString();
    $el->amount = $row->Amount->__toString();

    $docXml->rows[] = $el;
}
unset($data);

mysqli_query($db, "START TRANSACTION");
mysqli_query($db, "DELETE FROM amount_temp");

$total = count($docXml->rows);
foreach ($docXml->rows as $el) {
    $id = $el->id;

    $q = "
        INSERT INTO amount_temp (id, amount)
        VALUES ($id, $el->amount);
    ";

    $rez = mysqli_query($db, $q);
    $total -= empty($rez) ? 0 : 1;
    if (empty($rez)) {
        file_put_contents(__DIR__ . '/logEmptyAmount.txt', "$id " . PHP_EOL, FILE_APPEND);
    }
}
mysqli_query($db, "COMMIT");

updateDb($db);

rename('e:/smesi.loc/public/xml_load/amount.xml', 'e:/smesi.loc/public/xml_load/old/amount.xml');

echo 'ok';
exit();
