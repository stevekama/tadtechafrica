<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$cart = new Cart();

if($_POST['action'] == "FETCH_NUM_ITEMS_CART"){
    // check if tcustomer is logged in
    if($session->is_logged_in()){
        // check if its user and customer 
        if($session->check_user()){
            if($session->user_type == "CUSTOMER"){
                $customer_id = htmlentities($session->user_id);
                $cart_items = $cart->find_cart_item_by_customer_id($customer_id);
                $data['total_items'] = count($cart_items);
            }else{
                $data['total_items'] = 0;
            }
        }else{
            $data['total_items'] = 0;
        }
    }else{
        $data['total_items'] = 0;
    }

    echo json_encode($data);
}