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

$customer_id = htmlentities($_POST['customer_id']);

$current_customer = $customers->find_customer_by_id($customer_id);

if(!$current_customer){
    $data['message'] = "errorCustomer";
    echo json_encode($data);
    die();
}

if($_FILES['image']['type']){

    $customers->id = $current_customer['id'];
    $customers->customer_fullnames = $current_customer['customer_fullnames'];
    $customers->attach_file($_FILES['image']);
    $customers->customer_phone = $current_customer['customer_phone'];
    $customers->customer_email = $current_customer['customer_email'];
    $customers->forgot_code = $current_customer['forgot_code'];
    $customers->created_date = $current_customer['created_date'];
    $customers->edited_date = $d->format("Y-m-d H:i:s");
    if($customers->save_customer_image()){
        $data['message'] = "success";
    }
}
echo json_encode($data);