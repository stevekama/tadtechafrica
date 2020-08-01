<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialize_migrations.php');

$d = new DateTime();

$data = array();

$category_id = htmlentities($_POST['category_id']);

$categories = new Categories();

$current_category = $categories->find_category_by_id($category_id);

if(!$current_category){
    $data['message'] = "errorCategory";
}

$products = new Products();

if($_FILES['image']['type']){
    $products->category_id = $current_category['id'];
    $products->product_name = $_POST['product_name'];
    $products->attach_file($_FILES['image']);
    $products->product_details = $_POST['details'];
    $products->product_description = $_POST['description'];
    $products->product_price = $_POST['price'];
    $products->product_units = $_POST['units'];
    $products->product_status = $_POST['status'];
    $products->created_date = $d->format("Y-m-d H:i:s");
    $products->edited_date = $d->format("Y-m-d H:i:s");
    if($products->save()){
        $data['message'] = "success";
    }
    echo json_encode($data);
}