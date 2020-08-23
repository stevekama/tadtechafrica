<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

// check if customer is logged in
if(!$session->is_logged_in()){
    $data['message'] = "userNotLoggedIn";
    echo json_encode($data);
    die();
}

if(!$session->check_user()){
    $data['message'] = "userNotLoggedIn";
    echo json_encode($data);
    die();
}

if($session->user_type != "CUSTOMER"){
    $data['message'] = "userNotLoggedIn";
    echo json_encode($data);
    die();
}

// create orders tables
$customer_id = htmlentities($session->user_id);

$cart = new Cart();

$cart_status = "NEW";

$cart_item_prices = $cart->find_total_price_cart_item_by_customer_id_and_cart_status($customer_id, $cart_status);

$order_price = 0;

foreach($cart_item_prices as $cart_item_price){
    $order_price += $cart_item_price['total'];
}

$order = new Customer_Orders();

$order->customer_id = $customer_id;
$order->order_date = $d->format("Y-m-d");
$order->order_price = $order_price;
$order->order_status = "NEW";
$order->order_delivery = 0;
$order->order_total = $order_price;
$order->created_date = $d->format("Y-m-d H:i:s");
$order->edited_date = $d->format("Y-m-d H:i:s");
if($order->save()){
    $data['message'] = "orderCreated";
    $data['order_id'] = $order->id;
}

// update cart items order id
// find in cart where status is new and customer id


$cart_items = $cart->find_cart_items_by_cart_status($customer_id, $cart_status);

if(count($cart_items) > 0){
    foreach($cart_items as $item){
        // $data['item'] = $item;
        $cart->id = $item['id'];
        $cart->customer_id = $item['customer_id'];
        $cart->order_id = $data['order_id'];
        $cart->product_id = $item['product_id'];
        $cart->quantity = $item['quantity'];
        $cart->item_price = $item['item_price'];
        $cart->total_price = $item['total_price'];
        $cart->loginstatus = $item['loginstatus'];
        $cart->cart_status = "ORDERED";
        $cart->created_date = $item['created_date'];
        $cart->edited_date = $item['edited_date'];
        if($cart->save()){
            $success[] = "message";
        }
    }
}

// send success message with order id
$data['message'] = "success";

echo json_encode($data);