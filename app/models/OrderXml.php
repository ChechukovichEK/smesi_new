<?php

namespace app\models;

use ishop\App;
use DOMAttr;
use DOMDocument;

class OrderXml
{
    public static function createXml($cart)
    {
        $dom = new DOMDocument();
        $dom->encoding = 'utf-8';
        $dom->xmlVersion = '1.0';
        $dom->formatOutput = true;

        $xml_file_name = '/home/smesiby/public_html/public/xml_upload/orders/order_'.$cart->order_id.'.xml';
        $dateOrder = new \DateTimeImmutable();

        $order = $dom->createElement('OrderList');
        $order_head = $dom->createElement('OrderListHead');
        $order_number = $dom->createElement('OrderNumber', $cart->order_id);
        $order_date = $dom->createElement('OrderDate', $dateOrder->format('Y-m-d H:i:sP'));
        $order_head->appendChild($order_number);
        $order_head->appendChild($order_date);
        $order->appendChild($order_head);
        $dom->appendChild($order);
        $order_list_rows = $dom->createElement('OrderListRows');

        foreach ($cart->data as $item) {
            $order_list_row = $dom->createElement('OrderListRow');
            $order_list_rows->appendChild($order_list_row);
            $good_id = $dom->createElement('Good_id', $item->id);
            $price = $dom->createElement('Price', $item->price);
            $mount = $dom->createElement('Amount', $item->qty);
            $order_list_row->appendChild($good_id);
            $order_list_row->appendChild($price);
            $order_list_row->appendChild($mount);
            $order->appendChild($order_list_rows);
        }

        $dom->save($xml_file_name);

//        $log = print_r($cart->data, true);
//        file_put_contents('/home/smesiby/public_html/public/xml_upload/orders/log.txt', $log . PHP_EOL, FILE_APPEND);
    }
}
