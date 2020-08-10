<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$data = array();

$d = new DateTime();

$wishlist = new Wishlist();

$item_id = htmlentities($_POST['item_id']);

$current_item = $wishlist->find_wishlist_item_by_id($item_id);

if(!$current_item){
    $data['message'] = "errorItem";
    echo json_encode($data);
    die();
}

if($wishlist->delete($current_item['id'])){
    $data['message'] = "success";
}

echo json_encode($data);