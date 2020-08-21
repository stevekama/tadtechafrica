<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialize_migrations.php');

$order_delivery_migration = new Order_Delivery_migration();

$data = array();

// create table
if($_POST['action'] == "CREATE_TABLE"){
    $table = $order_delivery_migration->create();
    if($table){
        $data['message'] = "success";
    }
    echo json_encode($data);
}

// delete table
if($_POST['action'] == "DELETE_TABLE"){
    $table = $order_delivery_migration->drop();
    if($table){
        $data['message'] = "success";
    }

    echo json_encode($data);
}