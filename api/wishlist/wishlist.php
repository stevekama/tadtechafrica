<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

// check user is logged in 
if(!$session->is_logged_in()){
    $data['message'] = "errorCustomer";
    $data['total_items'] = 0;
    echo json_encode($data);
    die();
}

if(!$session->check_user()){
    $data['message'] = "errorCustomer";
    $data['total_items'] = 0;
    echo json_encode($data);
    die();
}

if($session->user_type != "CUSTOMER"){ 
    $data['message'] = "errorCustomer";
    $data['total_items'] = 0;
    echo json_encode($data);
    die();
}

$customer_id = htmlentities($session->user_id);

$customers = new Customers();

$current_customer = $customers->find_customer_by_id($customer_id);

if(!$current_customer){
    $data['message'] = "errorCustomer";
    $data['total_items'] = 0;
    echo json_encode($data);
    die();
}

$wishlist = new Wishlist();

$wishlist_items = $wishlist->find_cart_item_by_customer_id($customer_id);

$data['total_items'] = count($wishlist_items);

$output = '';
if(count($wishlist_items) > 0){
    $output .= '<ul class="cart_list">';
    foreach($wishlist_items as $item){
        $output .= '<li class="cart_item clearfix">';
        $output .= '<div class="cart_item_image">';
        $output .= '<img src="'.public_url().'storage/products/'.$item["product_image"].'" alt="">';
        $output .= '</div>';
        $output .= '<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">';
        $output .= '<div class="cart_item_name cart_info_col">';
        $output .= '<div class="cart_item_title">Name</div>';
        $output .= '<div class="cart_item_text">'.$item["product_name"].'</div>';
        $output .= '</div>';
        $output .= '<div class="cart_item_price cart_info_col">';
        $output .= '<div class="cart_item_title">Price</div>';
        $output .= '<div class="cart_item_text">KSHS '.$item["product_price"].'</div>';
        $output .= '</div>';
        $output .= '<div class="cart_item_price cart_info_col">';
        $output .= '<div class="cart_item_title">Remove</div>';
        $output .= '<div class="cart_item_text">'; 
        $output .= '<a href="#" id="'.htmlentities($item["id"]).'" class="btn btn-link delete">Delete</a>';
        $output .= '</div>';
    }
    $output .= '</ul>';
}

$data['wishlist_items'] = $output;

$table_output = '';
if(count($wishlist_items) > 0){
    $table_output .= '<table class="table table-hover table-striped">';
    $table_output .= '<thead><tr>';
    $table_output .= '<th>Image</th>';
    $table_output .= '<th>Product</th>';
    $table_output .= '<th>Price</th>';
    $table_output .= '</tr></thead><tbody>';
    foreach($wishlist_items as $item){
        $product_image = '<img src="'.public_url().'storage/products/'.$item["product_image"].'" class="img-thumbnail" alt="">';
        $table_output .= '<tr>';
        $table_output .= '<td class="wishlist-image">'.$product_image.'</td>';
        $table_output .= '<td>'.$item["product_name"].'</td>';
        $table_output .= '<td>'.$item["product_price"].'</td>';
        $table_output .= '</tr>';
    }
    $table_output .= '</tbody>';
    $table_output .= '</table>';
}

$data['wishlist_table'] = $table_output;

echo json_encode($data);