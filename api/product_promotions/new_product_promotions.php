<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialize_migrations.php');

$data = array();

$d = new DateTime();

// productions 
$productions = new Products();

$product_id = htmlentities($_POST['product_id']);

$current_product = $productions->find_product_by_id($product_id);

if(!$current_product){
    $data['message'] = "errorProduct";
    echo json_encode($data);
    die();
}

$product_promotion = new Product_Promotion();

if ($_FILES['banner_image']['type']) {
    $product_promotion->classification_id = $current_product['classification_id'];
    $product_promotion->category_id = $current_product['category_id'];
    $product_promotion->product_id = $current_product['id'];
    $product_promotion->product_name = $current_product['product_name'];
    $product_promotion->attach_file($_FILES['banner_image']);
    $product_promotion->product_price = $current_product['product_price'];
    $product_promotion->created_date = $current_product['created_date'];
    $product_promotion->edited_date = $d->format("Y-m-d H:i:s");
    if($product_promotion->save_banner()){
        $data['message'] = "success";
    }
}


echo json_encode($data);