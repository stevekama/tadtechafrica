<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$d = new DateTime();

$data = array();

$delivery_mode = new Delivery_Mode();

if(isset($_POST['mode_id'])){
    if (!empty($_POST['mode_id'])) {
        $delivery_mode_id = htmlentities($_POST['mode_id']);
        
        $current_delivery_mode = $delivery_mode->find_mode_by_id($delivery_mode_id);
        if (!$current_delivery_mode) {
            $data['message'] = "errorMode";
            echo json_encode($data);
            die();
        }

        $delivery_mode->id = $current_delivery_mode['id'];
        $delivery_mode->delivery_mode = $current_delivery_mode['delivery_mode'];
        $delivery_mode->mode_description = $_POST['description'];
        $delivery_mode->delivery_amount = $_POST['delivery_amount'];
        $delivery_mode->created_date = $current_delivery_mode['created_date'];
        $delivery_mode->edited_date = $d->format('Y-m-d H:i:s');

        if ($delivery_mode->save()) {
            $data['message'] = "success";
        }
    } else {

        $delivery_mode->delivery_mode = $_POST['mode'];

        $check_mode = $delivery_mode->find_mode_by_delivery_mode($delivery_mode->delivery_mode);
        if($check_mode){
            $data['message'] = "modeExists";
            echo json_encode($data);
            die();
        }
        $delivery_mode->mode_description = $_POST['description'];
        $delivery_mode->delivery_amount = $_POST['delivery_amount'];
        $delivery_mode->created_date = $d->format('Y-m-d H:i:s');
        $delivery_mode->edited_date = $d->format('Y-m-d H:i:s');

        if ($delivery_mode->save()) {
            $data['message'] = "success";
        }
    }

    echo json_encode($data);
}