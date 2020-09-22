<?php

require_once('../../init/initialization.php');

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

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

$customers = new Customers();

$customer_id = htmlentities($session->user_id);

$current_customer = $customers->find_customer_by_id($customer_id);

if(!$current_customer){
    $data['message'] = "errorCustomer";
    echo json_encode($data);
    die();
}

$customer_order = new Customer_Orders();

$order_id = htmlentities($_POST['order_id']);

$current_order = $customer_order->find_order_by_id($order_id);

if(!$current_order){
    $data['message'] = "errorOrder";
    echo json_encode($data);
    die();
}

$cart = new Cart();

// order cart items 
$cart_items = $cart->find_cart_items_by_customer_id_and_order_id($current_customer['id'], $current_order['id']);

$cart_output = '';
if(count($cart_items) > 0){
    $cart_output = '<ul class="product-list">';
    foreach($cart_items as $item){
        $cart_output .= '<li>';
        $cart_output .= '<div class="pl-thumb">';
        $cart_output .= '<img src="'.public_url().'storage/products/'.$item["product_image"].'" alt="">';
        $cart_output .= '</div>';
        $cart_output .= '<h6>'.htmlentities($item["product_name"]).'</h6>';
        $cart_output .= '<p>KSHS'.htmlentities($item["total_price"]).'</p>';
        $cart_output .= '</li>';
    }
    $cart_output .= '</ul>';
}

$data['cart_items'] = $cart_output;

// total proce for items 
$total_price_items = $cart->find_sum_cart_items_by_customer_id_and_order_id($current_customer['id'], $current_order['id']);

foreach($total_price_items as $total_price){
    $data['total_price'] = "KSHS".$total_price['total'];
}

echo json_encode($data);