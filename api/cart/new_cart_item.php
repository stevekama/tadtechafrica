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

$product = new Products();

$product_id = htmlentities($_POST['product_id']);

$current_product = $product->find_product_by_id($product_id);

if(!$current_product){
    $data['message'] = "errorProduct";
    echo json_encode($data);
    die();
}

// check if tcustomer is logged in
if($session->is_logged_in()){
    // check if its user and customer 
    if($session->check_user()){
        if($session->user_type == "CUSTOMER"){
            $customer_id = htmlentities($session->user_id);
            $cart->customer_id = $customer_id;
            $cart->product_id = $current_product['id'];
            $cart->quantity = 1;
            $cart->created_date = $d->format("Y-m-d H:i:s");
            $cart->edited_date = $d->format("Y-m-d H:i:s");
            if($cart->save()){
                $data['message'] = "success";
            }
        }
    }
}else{
    echo json_encode(array("cart_item"=>"item"));
}