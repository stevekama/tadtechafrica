<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$categories = new Categories();

if($_POST['action'] == "DELETE_CATEGORY"){
    // find category by id 
    $category_id = htmlentities($_POST['category_id']);
    $current_category = $categories->find_category_by_id($category_id);
    if(!$current_category){
        $data['message'] = "errorCategory";
        echo json_encode($data);
        die();
    }

    // delete category
    if($categories->delete($current_category['id'])){
        $data['message'] = "success";
    }
    echo json_encode($data);
}

if($_POST['action'] == "FETCH_CATEGORY"){
    $category_id = htmlentities($_POST['category_id']);
    $current_category = $categories->find_category_by_id($category_id);
    if(!$current_category){
        $data['message'] = "errorCategory";
        echo json_encode($data);
        die();
    }

    echo json_encode($current_category);
}