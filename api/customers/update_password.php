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

// find customer by id
$customer_id = htmlentities($_POST['customer_id']);

$current_customer = $customers->find_customer_by_id($customer_id);

if(!$current_customer){
    $data['message'] = "errorCustomer";
    echo json_encode($data);
    die();
}

// find customer by password
$customer_current_password = $customers->find_customer_by_password($current_customer['id'], $_POST['password']);

if(!$customer_current_password){
    $data['message'] = "wrongPassword";
    echo json_encode($data);
    die();
}

// enter new password

if($_POST['new_password'] !== $_POST['confirm']){
    $data['message'] = "errorPasswordMatch";
    echo json_encode($data);
    die();
}

$customers->id = $current_customer['id'];
$customers->password = $_POST['new_password'];
$customers->confirm_password = $_POST['confirm'];
$customers->edited_date = $d->format("Y-m-d H:i:s");
if($customers->update_password()){
    $data['message'] = "success";
}
echo json_encode($data);