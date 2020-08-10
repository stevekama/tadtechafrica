<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

$to_mail = "";
$username = "";
$message = "";
$link = "";
if($customers->save()){
    // find customer by id 
    $current_customer = $customers->find_customer_by_id($customers->id);
    $type = "CUSTOMER";
    $session->login($current_customer, $type);
    $to_mail = $customers->customer_email;
    $username = $customers->customer_fullnames;
    $message = "<p>YOu have successfully created an account with TadTech Africa</p>";
    $message .= "<hr/>";
    $message .= '<img src="'.public_url().'storage/logo/logo.png" alt="Logo" width="100"/>';
    $data['message'] = "customerCreated";
}

// Instantiation and passing `true` enables exception
$mail = new PHPMailer(true);

// send email after signing up 
$sendMail = new SendMail($mail);

if($data['message'] == "customerCreated"){
    // define the mail values 
    $sendMail->from = 'info@tadtechafrica.com';
    $sendMail->from_username = 'TadTech Africa';
    $sendMail->to = $to_mail;
    $sendMail->to_username = $username;
    $sendMail->subject = 'Welcome To Tadtech Africa';
    $sendMail->message = $message;
    // time email was send
    $sendMail->sendtime = $d->format('Y-m-d H:i:s');

    if($sendMail->send_mail()){
        // save email 
        if($sendMail->save()){
            $data['message'] = 'success';
            echo json_encode($data);
            die();
        }
    }
    $data['message'] = 'failed';
    $data['error'] = $sendMail->send_mail();
    echo json_encode($data);
}