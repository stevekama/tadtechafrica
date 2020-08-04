<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$wishlist = new Wishlist();

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
            $wishlist->customer_id = $customer_id;
            $wishlist->product_id = $current_product['id'];
            // check if customer has added product 
            $current_wishlist = $wishlist->find_wishlist_item_by_customer_id_and_product_id($wishlist->customer_id, $wishlist->product_id);
            if($current_wishlist){
                $data['message'] = "productWishlistExist";
                echo json_encode($data);
                die();
            }
            $wishlist->created_date = $d->format("Y-m-d H:i:s");
            $wishlist->edited_date = $d->format("Y-m-d H:i:s");
            if($wishlist->save()){
                $data['message'] = "success";
            }
        }else{
            $data['message'] = "userNotCustomer";
        }
    }else{
        $data['message'] = "userNotCustomer";
    }
}else{
    $data['message'] = "userNotLoggedIn";
}

echo json_encode($data);