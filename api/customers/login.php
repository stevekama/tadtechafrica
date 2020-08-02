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

$email = htmlentities($_POST['email']);

$password = htmlentities($_POST['password']);

$cust = $customers->authenticate_customer($email, $password);

if($cust){
    $type = "CUSTOMER";
    $session->login($cust, $type);
    if($session->is_logged_in()){
        $data['message'] = "success";   
    }
}else{
    $data['message'] = "errorCustomer";
}

echo json_encode($data);