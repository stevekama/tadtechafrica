<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$d = new DateTime();

$data = array();

$customers = new Customers();

if($_POST['action'] == "LOGOUT"){
    if($session->is_logged_in()){
        $session->logout();
        $data['message'] = 'success';
        echo json_encode($data);
    }else{
        $session->logout();
        $data['message'] = 'userNotLoggin';
        echo json_encode($data);
    }
}