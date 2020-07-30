<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$d = new DateTime();

$data = array();

$categories = new Categories();

if(isset($_FILES['image']['type'])){
    $categories->category_name = $_POST['category'];
    $categories->attach_file($_FILES['image']);
    $categories->created_date = $d->format("Y-m-d H:i:s");
    $categories->edited_date = $d->format("Y-m-d H:i:s");

    if($categories->save()){
        $data['message'] = "success";
    }

    echo json_encode($data);
}