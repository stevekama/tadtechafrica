<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$classification = new Product_Classification();

$classification->classification = htmlentities($_POST['classification']);
$classification->created_date = $d->format("Y-m-d H:i:s");
$classification->edited_date = $d->format("Y-m-d H:i:s");

if($classification->save()){
    $data['message'] = "success";
}

echo json_encode($data);