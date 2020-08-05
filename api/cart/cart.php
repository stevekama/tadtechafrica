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
    $cart_items = $cart->find_cart_item_by_customer_id($customer_id);

    $data['total_items'] = count($cart_items);
    // loop through cart items and display them
    $output = '';
    if(count($cart_items) > 0){
        foreach($cart_items as $item){
            $output .= '<ul class="cart_list">';
            $output .= '<li class="cart_item clearfix">';
            $output .= '<div class="cart_item_image">';
            $current_product = $products->find_product_by_id($item['product_id']);
            $output .= '<img src="<?php echo public_url(); ?>storage/products/'.$current_product["product_image"].'" alt="Product">';
            $output .= '</div>';
            $output .= '<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">';
            $output .= '<div class="cart_item_name cart_info_col">';
            $output .= '<div class="cart_item_title">Name</div>';
            $output .= '<div class="cart_item_text">'.$current_product["product_name"].'</div>';
            $output .= '</div>';
            $output .= '<div class="cart_item_quantity cart_info_col">';
            $output .= '<div class="cart_item_title">Quantity</div>';
            $output .= '<div class="cart_item_text">'.$item["quantity"].'</div>';
            $output .= '</div>';
            $output .= '<div class="cart_item_price cart_info_col">';
            $output .= '<div class="cart_item_title">Price</div>';
            $output .= '<div class="cart_item_text">KSHS.'.$item["item_price"].'</div>';
            $output .= '</div>';
            $output .= '<div class="cart_item_total cart_info_col">';
            $output .= '<div class="cart_item_title">Total</div>';
            $output .= '<div class="cart_item_text">KSHS.'.$item["total_price"].'</div>';
            $output .= '</div></div> </li></ul>';
        }
    }
    $data['cart_details'] = $output;
    // read total price 
    $cart_prices = $cart->find_total_price_cart_item_by_customer_id($customer_id);
    $total = 0;
    foreach($cart_prices as $total_price){
        $total += $total_price['total'];
    }

    $data['total_price'] = $total;

    echo json_encode($data);
}