<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialize_migrations.php');

$d = new DateTime();

$data = array();

if(empty($_POST['category_id'])){
    $data['message'] = "emptyCategory";
    echo json_encode($data);
    die();
}

$category_id = htmlentities($_POST['category_id']);

$categories = new Categories();

$current_category = $categories->find_category_by_id($category_id);

if(!$current_category){
    $data['message'] = "errorCategory";
}

$classifications = new Product_Classification();
$classification_id = htmlentities($_POST['classification_id']);
$current_calassification = $classifications->find_by_id($classification_id);
if(!$current_calassification){
    $data['message'] = "errorClassification";
    echo json_encode($data);
    die();
}

$products = new Products();

if(!empty($_POST['product_id'])){
    $product_id = htmlentities($_POST['product_id']);
    $current_product = $products->find_product_by_id($product_id);
    if(!$current_product){
        $data['message'] = "errorProduct";
        echo json_encode($data);
        die();
    }

    $products->id = $current_product['id'];
    $products->category_id = $current_category['id'];
    $products->classification_id = $current_calassification['id'];
    $products->product_name = $_POST['product_name'];
    $products->product_details = $_POST['details'];
    $products->product_description = $_POST['description'];
    $products->product_price = $_POST['price'];
    $products->product_units = $_POST['units'];
    $products->product_status = $current_product['product_status'];
    $products->product_image = $current_product['product_image'];
    $products->created_date = $d->format("Y-m-d H:i:s");
    $products->edited_date = $d->format("Y-m-d H:i:s");
    if($products->save()){
        $data['message'] = "success";
    }
}else{
    $classifications = new Product_Classification();
    $products->category_id = $current_category['id'];
    $products->classification_id = $current_calassification['id'];
    $products->product_name = $_POST['product_name'];
    $products->product_details = $_POST['details'];
    $products->product_description = $_POST['description'];
    $products->product_price = $_POST['price'];
    $products->product_units = $_POST['units'];
    $products->product_status = "NEW";
    if($_FILES['image']['type']){
        $products->attach_file($_FILES['image']);
        $products->created_date = $d->format("Y-m-d H:i:s");
        $products->edited_date = $d->format("Y-m-d H:i:s");
        if($products->save_product_image()){
            $data['message'] = "success";
        }
    }else{
        $products->product_image = "noimage.png";
        $products->created_date = $d->format("Y-m-d H:i:s");
        $products->edited_date = $d->format("Y-m-d H:i:s");
        if($products->save()){
            $data['message'] = "success";
        }
    }
}

echo json_encode($data);