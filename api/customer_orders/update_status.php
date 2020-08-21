<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$order = new Customer_Orders();

$order_status = htmlentities($_POST['status']);

$order_id = htmlentities($_POST['order_id']);

$current_order = $order->find_order_by_id($order_id);

if(!$current_order){
    $data['message'] = "errorOrder";
    echo json_encode($data);
    die();
}

$order->id = $current_order['id'];
$order->customer_id = $current_order['customer_id'];
$order->order_date = $current_order['order_date'];
$order->order_price = $current_order['order_price'];
$order->order_status = $order_status;
$order->order_delivery = $current_order['order_delivery'];
$order->order_total = $current_order['order_total'];
$order->created_date = $current_order['created_date'];
$order->edited_date = $d->format("Y-m-d H:i:s");

if($order->save()){
    $data['message'] = "success";
}

echo json_encode($data);