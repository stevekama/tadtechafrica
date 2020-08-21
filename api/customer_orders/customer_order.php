
<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

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

/// 1. find customer order items
/// not this are read from customer cart 
$cart = new Cart();

$order_items = $cart->find_cart_items_by_customer_id_and_order_id($current_customer['id'], $current_order['id']);

$output_items = '';
if(count($order_items) > 0){
    $output_items .= '<ul class="cart_list">';
    foreach($order_items as $item){
        $output_items .= '<li class="cart_item clearfix">';
        $output_items .= '<div class="cart_item_image">';
        $output_items .= '<img src="'.public_url().'storage/products/'.htmlentities($item['product_image']).'" alt="">';
        $output_items .= '</div>';

        $output_items .= '<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">';
        $output_items .= '<div class="cart_item_name cart_info_col">';
        $output_items .= '<div class="cart_item_title">Name</div>';
        $output_items .= '<div class="cart_item_text">';
        $output_items .= htmlentities($item['product_name']);
        $output_items .= '</div></div>';

        $output_items .= '<div class="cart_item_quantity cart_info_col">';
        $output_items .= '<div class="cart_item_title">Quantity</div>';
        $output_items .= '<div class="cart_item_text">';
        $output_items .= htmlentities($item['quantity']);
        $output_items .= ' </div></div>';

        $output_items .= '<div class="cart_item_price cart_info_col">';
        $output_items .= '<div class="cart_item_title">Price</div>';
        $output_items .= '<div class="cart_item_text">';
        $output_items .= htmlentities($item['item_price']);
        $output_items .= '</div></div>';

        $output_items .= '<div class="cart_item_total cart_info_col">';
        $output_items .= '<div class="cart_item_title">Total</div>';
        $output_items .= '<div class="cart_item_text">';
        $output_items .= htmlentities($item['total_price']);;
        $output_items .= '</div> </div></div>';
        $output_items .= '</li>';
    }
    $output_items .= '</ul>';
}else{
    $output_items .= 'noItems';
}

// delivery mode




$data['order_items'] = $output_items;

echo json_encode($data);