<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialize_migrations.php');

$d = new DateTime();

// use products and classifications

$products = new Products();

$classifications = new Product_Classification();

// load num of products 
$output = "";

$num_products = "";

if (isset($_POST['action'])) {
    // load new arrivals 
    if ($_POST['action'] == "FETCH_NEW_ARRIVALS") 
    {

        $classification = "New Arrivals";

        $current_classification = $classifications->find_by_classification($classification);

        if (!$current_classification) {
            echo json_encode(array('message' => "classificationError"));
            die();
        }

        $new_arrivals_products = $products->find_products_by_classification_id($current_classification['id']);

        $num_products .= count($new_arrivals_products);

        // fetch products 
        if($num_products > 0){
            // fetch products
            foreach($new_arrivals_products as $product){
                $output .= '<div class="product-item">';
                $output .= '<div class="pi-pic">';
                $output .= '<img src="'.public_url().'"front/images/product/1.jpg" alt="">';
                $output .= '<div class="pi-links">';
                $output .= '<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>';
                $output .= '<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>';
                $output .= '</div></div>';
                $output .= '<div class="pi-text">';
                $output .= '<h6>Kshs.'.$product["product_price"].'</h6>';
                $output .= '<p>'.htmlentities($product["product_name"]).'</p>';
                $output .= '</div></div>';
            }
        }
    }

    if($_POST['action'] == "FETCH_ALL_PRODUCTS")
    {
        // find all products 
        $all_products = $products->find_all();

        // num products
        $num_products = count($all_products);

        // fetch products 
        if($num_products > 0){
            // fetch products
            foreach($all_products as $product){
                $output .= '<div class="col-lg-3 col-sm-6">';
                $output .= '<div class="product-item">';
                $output .= '<div class="pi-pic">';
                $output .= '<img src="'.public_url().'front/images/product/5.jpg" alt="">';
                $output .= '<div class="pi-links">';
                $output .= '<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>';
                $output .= '<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>';
                $output .= '</div></div>';
                $output .= '<div class="pi-text">';
                $output .= '<h6>$35,00</h6>';
                $output .= '<p>Flamboyant Pink Top </p>';
                $output .= '</div></div></div>';
            }
        }
    }
}

$data = array(
    "num_products" => $num_products,
    "products_data" => $output
);

echo json_encode($data);