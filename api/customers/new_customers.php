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

if($_POST['password'] !== $_POST['confirm']){
    $data['message'] = "errorPassword";
    echo json_encode($data);
    die();
}

$customers->customer_fullnames = $_POST['fullnames'];
$customers->customer_image = 'noimage.png';
$customers->customer_phone = $_POST['phone'];
$customers->customer_email = $_POST['email'];

// find customer by email 
$find_customer_email = $customers->find_customer_by_email($customers->customer_email);
if($find_customer_email){
    $data['message'] = "emailExists";
    echo json_encode($data);
    die();
}

$customers->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$customers->confirm_password = password_hash($_POST['confirm'], PASSWORD_DEFAULT);
$customers->created_date = $d->format("Y-m-d H:i:s");
$customers->edited_date = $d->format("Y-m-d H:i:s");
if($customers->save()){
    // find customer by id 
    $current_customer = $customers->find_customer_by_id($customers->id);
    $type = "CUSTOMER";
    $session->login($current_customer, $type);
    $data['message'] = "success";
}
echo json_encode($data);