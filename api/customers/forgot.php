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

$data = array();

$d = new DateTime();

$customers = new Customers();

//find customer by email
$customer_email = htmlentities($_POST['email']);

$current_customer = $customers->find_customer_by_email($customer_email);

if(!$current_customer){
    $data['message'] = "errorCustomer";
    echo json_encode($data);
    die();
}

///generate random code 
$bytes = 6;
$code = bin2hex(random_bytes($bytes));

$to_mail = "";
$username = "";
$message = "";
$link = "";

// update customer forget password
$customers->id = $current_customer['id'];
$customers->customer_fullnames = $current_customer['customer_fullnames'];
$customers->customer_image = $current_customer['customer_image'];
$customers->customer_phone = $current_customer['customer_phone'];
$customers->customer_email = $current_customer['customer_email'];
$customers->forgot_code = $code;
$customers->created_date = $current_customer['created_date'];
$customers->edited_date = $d->format("Y-m-d H:i:s");

if($customers->update()){
    $to_mail .= $customers->customer_email;
    $username .= $customers->customer_fullnames;
    $message .= "<p>Your request to change password has been received. </p>";
    $message .= "<p>Please click the following link to continue.</p>";
    $message .= "<hr/>";
    // define the mail values
    $link .= "<p><a href=".base_url()."api/customers/confirm_url.php?code=".$customers->forgot_code.">".base_url()."api/customers/confirm_url.php?code=".$customers->forgot_code."</a></p>";
    $message .= $link;
    $data['message'] = "codeUpdated";
}

// Instantiation and passing `true` enables exception
$mail = new PHPMailer(true);

// send email after signing up 
$sendMail = new SendMail($mail);

if($data['message'] == "codeUpdated"){
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