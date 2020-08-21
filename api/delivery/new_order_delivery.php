<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$d = new DateTime();

$data = array();

$customers = new Customers();

// find customer by id
$customer_id = htmlentities($session->user_id);

$current_customer = $customers->find_customer_by_id($customer_id);

if(!$current_customer){
    $data['message'] = "errorCustomer";
    echo  json_encode($data);
    die();
}

$delivery_mode = new Delivery_Mode();

// find delivery mode by id
$delivery_mode_id = htmlentities($_POST['delivery_mode_id']);

$current_delivery_mode = $delivery_mode->find_mode_by_id($delivery_mode_id);

if(!$current_delivery_mode){
    $data['message'] = "errorDeliveryMode";
    echo  json_encode($data);
    die();
}

// current oder
$order = new Customer_Orders();

$order_id = htmlentities($_POST['order_id']);

$current_order = $order->find_order_by_id($order_id);

if(!$current_order){
    $data['message'] = "errorOrder";
    echo  json_encode($data);
    die();
}

// bring in order delivery
$order_delivery = new Order_Delivery();

$order_delivery->customer_id = $current_customer['id'];
$order_delivery->order_id = $current_order['id'];
$order_delivery->delivery_mode_id = $current_delivery_mode['id'];

// check if current delivery exists
$check_order_delivery = $order_delivery->find_order_delivery_by_customer_id_order_id_and_delivery_mode_id($order_delivery->customer_id, $order_delivery->order_id, $order_delivery->delivery_mode_id);
if($check_order_delivery){
    $data['message'] = "success";
    echo  json_encode($data);
    die();
}
$order_delivery->fullnames = $current_customer['customer_fullnames'];
$order_delivery->phone = $current_customer['customer_phone'];
$order_delivery->alt_phone = $_POST['alt_phone'];
$order_delivery->email = $current_customer['customer_email'];
$order_delivery->address = $_POST['address'];
$order_delivery->city = $_POST['city'];
$order_delivery->country = $_POST['country'];
$order_delivery->delivery_amount = $current_delivery_mode["delivery_amount"];
$order_delivery->delivery_status = "NEW";
$order_delivery->delivery_date = $d->format("Y-m-d");
$order_delivery->delivered_by = "NULL";
$order_delivery->created_date = $d->format("Y-m-d H:i:s");
$order_delivery->edited_date = $d->format("Y-m-d H:i:s");

if($order_delivery->save()){
    $data['message'] = "order_delivery_created";
}

// update order delivery amount
if($data['message'] == "order_delivery_created"){
    // update delivery amount and status
    $order->id = $current_order['id'];
    $order->customer_id = $current_order['customer_id'];
    $order->order_date = $current_order['order_date'];
    $order->order_price = $current_order['order_price'];
    $order->order_status = "PAYMENTS";
    $order->order_delivery = $current_delivery_mode['delivery_amount'];
    $grand_total = $order->order_price + $order->order_delivery;
    $order->order_total = $grand_total;
    $order->created_date = $current_order['created_date'];
    $order->edited_date = $d->format("Y-m-d H:i:s");

    if($order->save()){
        $data['message'] = "success";
    }
}

echo  json_encode($data);