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

$products = new Products();

if($_POST['action'] == "FETCH_CART_ITEMS"){
    $customer_id = 0;

    if($session->is_logged_in()){
        // check if its user and customer 
        if($session->check_user()){
            if($session->user_type == "CUSTOMER"){
                $customer_id = htmlentities($session->user_id);  
            }
        }
    }

    // check is if isset cart_items
    if(!isset($_SESSION['cart_items']) && $customer_id <= 0){
        $data['message'] = "noCartItems";
        echo json_encode($data);
        die();
    }

    // check is if cart_items is not set but customer_id > 0
    if(!isset($_SESSION['cart_items']) && $customer_id > 0){
        $customer_id = $customer_id;
    }
    // check cart items status 
    $cart_status = "";
    if(isset($_SESSION['cart_items'])){
        $cart_status = htmlentities($_SESSION['cart_items']);
    }

    // check if user is logged in and cart items == FULL
    if($customer_id > 0 && $cart_status == "FULL"){
        // update the fields: customer id, logginstatus and cart_items == EMPTY
        // find cart items by loggedinstatus
        $loggedStatus = "FALSE";
        $customer_items = $cart->find_cart_items_by_loginstatus($loggedStatus);
        foreach($customer_items as $items){
            $cart->id = $items['id'];
            $cart->customer_id = $customer_id;
            $cart->product_id = $items['product_id'];
            $cart->quantity = $items['quantity'];
            $cart->item_price = $items['item_price'];
            $cart->total_price = $items['total_price'];
            $cart->loginstatus = "TRUE";
            $cart->created_date = $items['created_date'];
            $cart->edited_date = $d->format("Y-m-d H:i:s");
            if($cart->save()){
                $success[] = "cartUpdated";
            }
        }

        $_SESSION['cart_items'] = "EMPTY";

    }
    
    // Read cart items for customer
    $cart_status = "NEW";
    $cart_items = $cart->find_cart_items_by_cart_status($customer_id, $cart_status);

    $data['total_items'] = count($cart_items);
    // loop through cart items and display them
    $output = '<div class="cart-table-warp">';
    if(count($cart_items) > 0){
        $output .= '<table>';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th class="product-th">Product</th>';
        $output .= '<th class="quy-th">Quantity</th>';
        // $output .= '<th class="size-th">Price</th>';
        $output .= '<th class="total-th">Total Price</th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';
        foreach($cart_items as $item){
            $current_product = $products->find_product_by_id($item['product_id']);
            $output .= '<tr>';

            $output .= ' <td class="product-col">';
            $output .= '<img src="'.public_url().'storage/products/'.$current_product["product_image"].'" alt="Item Image">';
            $output .= '<div class="pc-title">';
            $output .= '<h4>'.htmlentities($current_product['product_name']).'</h4>';
            $output .= '<p>KSHS.'.htmlentities($item["item_price"]).'</p>';
            $output .= '</div>';
            $output .= '</td>';

            $output .= '<td class="quy-col">';
            $output .= '<div class="quantity">';
            $output .= htmlentities($item["quantity"]);
            $output .= '</div>';
            $output .= '</td>';

            $output .= '<td class="total-col">';
            $output .= '<h4>KSHS'.$item["total_price"].'</h4>';
            $output .= '</td>';

            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';
    }
    $output .= '</div>';
    $data['cart_details'] = $output;
    // read total price 
    $cart_prices = $cart->find_total_price_cart_item_by_customer_id_and_cart_status($customer_id, "NEW");
    $total = 0;
    foreach($cart_prices as $total_price){
        $total += $total_price['total'];
    }

    $data['total_price'] = 'KSHS'.$total;

    echo json_encode($data);
}

if($_POST['action'] == "FETCH_ITEM_BY_ID"){
    $cart_id = htmlentities($_POST['cart_id']);
    $current_cart = $cart->find_cart_item_by_id($cart_id);
    if(!$current_cart){
        $data['message'] = "errCart";
        echo json_encode($data);
        die();
    }
    echo json_encode($current_cart);
}

if($_POST['action'] == "DELETE_ITEM"){
    $cart_id = htmlentities($_POST['cart_id']);
    $current_cart = $cart->find_cart_item_by_id($cart_id);
    if(!$current_cart){
        $data['message'] = "errCart";
        echo json_encode($data);
        die();
    }
    if($cart->delete($current_cart['id'])){
        $data['message'] = "success";
    }
    echo json_encode($data);
}