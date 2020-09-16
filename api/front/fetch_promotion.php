<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialize_migrations.php');

$promotions = new Product_Promotion();

$products = new Products();

$classifications = new Product_Classification();

// we are getting all products in promotion table

$product_promotions = $promotions->find_all();

// get num products

$num_product_promotions = count($product_promotions);

// fetch products 
$output = "";
if($num_product_promotions > 0){
    
    foreach($product_promotions as $product_promotion){
        // find product in products table by id
        $current_product = $products->find_product_by_id($product_promotion['product_id']);
        $output .= '<div class="hs-item set-bg" data-setbg="'.public_url().'storage/products/'.$current_product["product_image"].'">';
        $output .= '<div class="container">';
        $output .= '<div class="row">';
        $output .= '<div class="col-xl-6 col-lg-7 text-white">';
        // get product classification
        $current_classification = $classifications->find_by_id($product_promotion['classification_id']);
        $output .= '<span>'.$current_classification["classification"].'</span>';
        $output .= '<h2>'.$current_product["product_name"].'</h2>';
        $output .= '<p>'.$current_product["product_description"].'</p>';
        $output .= '<a href="'.base_url().'" class="site-btn sb-line">SHOP MORE</a>';
        $output .= '<a href="#" class="site-btn sb-white">ADD TO CART</a>';
        $output .= '</div></div>';
        $output .= '<div class="offer-card text-white">';
        $output .= '<span>Price</span>';
        $output .= '<h3>KSHS.'.$current_product["product_price"].'</h3>';
        $output .= '<p>SHOP NOW</p>';
        $output .= '</div></div></div>';
    }
}

// send json data
$data = array(
    'total_promotions' => $num_product_promotions,
    'promotion_data' => $output,
);

echo json_encode($data);