<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialize_migrations.php');

$data = array();

$d = new DateTime();

$product_promotons = new Product_Promotion();

if($_POST['action'] == "DELETE_PROMOTION"){
    $promotion_id = htmlentities($_POST['promotion_id']);
    $current_promotion = $product_promotons->find_by_id($promotion_id);
    if(!$current_promotion){
        $data['message'] = "errorPromotion";
        echo json_encode($data);
        die();
    }

    if($product_promotons->delete($current_promotion['id'])){
        $data['message'] = "success";
    }

    echo json_encode($data);
}


if($_POST['action'] == "FETCH_PROMOTION"){
    $promotion_id = htmlentities($_POST['promotion_id']);
    $current_promotion = $product_promotons->find_by_id($promotion_id);
    if(!$current_promotion){
        $data['message'] = "errorPromotion";
        echo json_encode($data);
        die();
    }

    echo json_encode($current_promotion);
}