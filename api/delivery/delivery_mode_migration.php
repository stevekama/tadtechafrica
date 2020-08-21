<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialize_migrations.php');

$delivery_mode_migration = new Delivery_Mode_migration();

$data = array();

// create table
if($_POST['action'] == "CREATE_TABLE"){
    $table = $delivery_mode_migration->create();
    if($table){
        $data['message'] = "success";
    }
    echo json_encode($data);
}

if($_POST['action'] == "ADD_MODE_DESCRIPTION"){
    $table = $delivery_mode_migration->add_mode_description();
    if($table){
        $data['message'] = "success";
    }
    echo json_encode($data);
}

// delete table
if($_POST['action'] == "DELETE_TABLE"){
    $table = $delivery_mode_migration->drop();
    if($table){
        $data['message'] = "success";
    }

    echo json_encode($data);
}