<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize
require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$products = new Products();

if($_POST['action'] == "FETCH_PRODUCT"){
    $product_id = htmlentities($_POST['product_id']);
    $current_product = $products->find_product_by_id($product_id);
    if(!$current_product){
        $data['message'] = "errorProduct";
        echo json_encode($data);
        die();
    }
    echo json_encode($current_product);
}

if($_POST['action'] == "DELETE_PRODUCT"){
    $product_id = htmlentities($_POST['product_id']);
    $current_product = $products->find_product_by_id($product_id);
    if(!$current_product){
        $data['message'] = "errorProduct";
        echo json_encode($data);
        die();
    }

    if($products->delete($current_product['id'])){
        $data['message'] = "success";
    }
    echo json_encode($data);
}