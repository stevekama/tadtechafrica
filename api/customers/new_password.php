<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$customers = new Customers();

$new_password = htmlentities($_POST['new_password']);
$confirm_password = htmlentities($_POST['confirm_password']);

if($new_password === $confirm_password){
    $customer_id = htmlentities($_POST['customer_id']);

    $current_customer = $customers->find_customer_by_id($customer_id);

    if(!$current_customer){
        $data['message'] = "errorCustomer";
        echo json_encode($data);
        die();
    }
    $customers->id = $current_customer['id'];
    $customers->password = $new_password;
    $customers->confirm_password = $confirm_password;
    $customers->edited_date = $d->format("Y-m-d H:i:s");
    if($customers->update_password()){
        $data['message'] = "success";
    }
}else{
    $data['message'] = "errorPassword";
}

echo json_encode($data);