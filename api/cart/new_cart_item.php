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
    // check if its user
    if($session->check_user()){
        // check if the user == customer
        if($session->user_type == "CUSTOMER"){

            // set $_SESSION['cart_items'] == EMPTY
            $session->set_cart_items('EMPTY');

            // create product item in cart
            $customer_id = htmlentities($session->user_id);
            $cart->customer_id = $customer_id;
            $cart->order_id = htmlentities(0);
            $cart->product_id = $current_product['id'];
            // check if product is in the cart
            $product_item = $cart->find_cart_items_by_customer_id_and_product_id_and_cart_status($cart->customer_id, $cart->product_id, 'NEW');
            if ($product_item) {
                $data['message'] = "productAdded";
                echo json_encode($data);
                die();
            }
            $cart->quantity = htmlentities($_POST['quantity']);
            $cart->item_price = $current_product['product_price'];
            $product_price_str = $cart->item_price;
            $con_price = str_replace(',', '', $product_price_str);
            $product_price = intval($con_price);
            $total_price = $cart->quantity * $product_price;
            $cart->total_price = $total_price;
            // set isloggedIn to be true
            $cart->loginstatus = "TRUE";
            $cart->cart_status = "NEW";
            $cart->created_date = $d->format("Y-m-d H:i:s");
            $cart->edited_date = $d->format("Y-m-d H:i:s");

            if($cart->save()){
                $data['message'] = "success";
            }
        } else {
            // save user and not logged in
            // set $_SESSION['cart_items'] == EMPTY
            $session->set_cart_items('FULL');

            // create product item in cart
            $customer_id = htmlentities(0);
            $cart->customer_id = $customer_id;
            $cart->order_id = htmlentities(0);
            $cart->product_id = $current_product['id'];
            // check if product is in the cart
            $product_item = $cart->find_cart_items_by_customer_id_and_product_id_and_cart_status($cart->customer_id, $cart->product_id, 'NEW');
            if ($product_item) {
                $data['message'] = "productAdded";
                echo json_encode($data);
                die();
            }
            $cart->quantity = 1;
            $cart->item_price = $current_product['product_price'];
            $product_price_str = $cart->item_price;
            $con_price = str_replace(',', '', $product_price_str);
            $product_price = intval($con_price);
            $total_price = $cart->quantity * $product_price;
            $cart->total_price = $total_price;
            // set isloggedIn to be true
            $cart->loginstatus = "FALSE";
            $cart->cart_status = "NEW";
            $cart->created_date = $d->format("Y-m-d H:i:s");
            $cart->edited_date = $d->format("Y-m-d H:i:s");

            if ($cart->save()) {
                $data['message'] = "success";
            }
        }
    }else{
        // save user and not logged in
        // set $_SESSION['cart_items'] == EMPTY
        $session->set_cart_items('FULL');

        // create product item in cart
        $customer_id = htmlentities(0);
        $cart->customer_id = $customer_id;
        $cart->order_id = 0;
        $cart->product_id = $current_product['id'];
        // check if product is in the cart
        $product_item = $cart->find_cart_items_by_customer_id_and_product_id_and_cart_status($cart->customer_id, $cart->product_id, 'NEW');
        if ($product_item) {
            $data['message'] = "productAdded";
            echo json_encode($data);
            die();
        }
        $cart->quantity = 1;
        $cart->item_price = $current_product['product_price'];
        $product_price_str = $cart->item_price;
        $con_price = str_replace(',', '', $product_price_str);
        $product_price = intval($con_price);
        $total_price = $cart->quantity * $product_price;
        $cart->total_price = $total_price;
        // set isloggedIn to be true
        $cart->loginstatus = "FALSE";
        $cart->cart_status = "NEW";
        $cart->created_date = $d->format("Y-m-d H:i:s");
        $cart->edited_date = $d->format("Y-m-d H:i:s");

        if ($cart->save()) {
            $data['message'] = "success";
        }
    }
}else{
    // save user and not logged in
    // set $_SESSION['cart_items'] == EMPTY
    $session->set_cart_items('FULL');

    // create product item in cart
    $customer_id = htmlentities(0);
    $cart->customer_id = $customer_id;
    $cart->order_id = 0;
    $cart->product_id = $current_product['id'];
    // check if product is in the cart
    $product_item = $cart->find_cart_items_by_customer_id_and_product_id_and_cart_status($cart->customer_id, $cart->product_id, 'NEW');
    if($product_item){
        $data['message'] = "productAdded";
        echo json_encode($data);
        die();
    }
    $cart->quantity = 1;
    $cart->item_price = $current_product['product_price'];
    $product_price_str = $cart->item_price;
    $con_price = str_replace(',', '', $product_price_str);
    $product_price = intval($con_price);
    $total_price = $cart->quantity * $product_price;
    $cart->total_price = $total_price;
    // set isloggedIn to be true
    $cart->loginstatus = "FALSE";
    $cart->cart_status = "NEW";
    $cart->created_date = $d->format("Y-m-d H:i:s");
    $cart->edited_date = $d->format("Y-m-d H:i:s");
    
    if($cart->save()){
        $data['message'] = "success";
    }
}

echo json_encode($data);