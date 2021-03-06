<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialize_migrations.php');

$customers_orders = new Orders_migration();

$data = array();

// create table
if($_POST['action'] == "CREATE_TABLE"){
    $table = $customers_orders->create();
    if($table){
        $data['message'] = "success";
    }
    echo json_encode($data);
}

// delete table
if($_POST['action'] == "DELETE_TABLE"){
    $table = $customers_orders->drop();
    if($table){
        $data['message'] = "success";
    }

    echo json_encode($data);
}