<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$order = new Customer_Orders();

if($_POST['action'] == "FETCH_ORDER_BY_ID"){
    $order_id = htmlentities($_POST['order_id']);
    $current_order = $order->find_order_by_id($order_id);
    if(!$current_order){
        $data['message'] = "errorOrder";
        echo json_encode($data);
        die();
    }

    echo json_encode($current_order);
}