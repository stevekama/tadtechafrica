<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$delivery_mode = new Delivery_Mode();

if($_POST['action'] == "FETCH_MODE"){
    $delivery_mode_id = htmlentities($_POST['delivery_mode_id']);
    $current_mode = $delivery_mode->find_mode_by_id($delivery_mode_id);
    if(!$current_mode){
        $data['message'] = "errorMode";
        echo json_encode($data);
        die();
    }
    echo json_encode($current_mode);
}