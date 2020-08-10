<?php 
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$d = new DateTime('now');

$success_url = base_url().'landing/new_password.php';

$error_url = base_url();

if(!isset($_GET['code'])){
    redirect_to($error_url);
}

$forgot_code = htmlentities($_GET['code']);

// find customer by forgot code 
$customers = new Customers();

$current_customer = $customers->find_customer_by_forgot_code($forgot_code);

if(!$current_customer){
    redirect_to($error_url);
}

// update customer forget password
$customers->id = $current_customer['id'];
$customers->customer_fullnames = $current_customer['customer_fullnames'];
$customers->customer_image = $current_customer['customer_image'];
$customers->customer_phone = $current_customer['customer_phone'];
$customers->customer_email = $current_customer['customer_email'];
$customers->forgot_code = "NULL";
$customers->created_date = $current_customer['created_date'];
$customers->edited_date = $d->format("Y-m-d H:i:s");

if($customers->update()){
    redirect_to($success_url."?customer=".$customers->id);
}