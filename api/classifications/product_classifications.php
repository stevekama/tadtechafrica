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

if($_POST['action'] == "DELETE_CLASSIFICATION"){

    $classification_id = htmlentities($_POST['classification_id']);

    $current_classification = $classification->find_by_id($classification_id);

    if(!$current_classification){
        $data['message'] = "errorClassification";
        echo json_encode($data);
        die();
    }

    if($classification->delete($current_classification['id'])){
        $data['message'] = "success";
    }

    echo json_encode($data);
}

if($_POST['action'] == "FETCH_CLASSIFICATION"){
    $classification_id = htmlentities($_POST['classification_id']);
    $current_classification = $classification->find_by_id($classification_id);
    if(!$current_classification){
        $data['message'] = "errClassification";
        echo json_encode($data);
        die();
    }

    echo json_encode($current_classification);
}