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

if($_POST['action'] == "FETCH_CUSTOMER"){
    if($session->is_logged_in()){
        if($session->check_user()){
            if($session->user_type == "CUSTOMER"){
                $customer_id = htmlentities($session->user_id);
                $current_customer = $customers->find_customer_by_id($customer_id);
                if(!$current_customer){
                    $data['message'] = "errorCustomer";
                    echo json_encode($data);
                    die();
                }

                $data['customer'] = $current_customer;
            }else{
                $data['message'] = "errorCustomer";
            }
        }else{
            $data['message'] = "errorCustomer";
        }
    }else{
        $data['message'] = 'errorCustomer';
    }

    echo json_encode($data);
}

