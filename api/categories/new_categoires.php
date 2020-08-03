<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../init/initialization.php');

$d = new DateTime();

$data = array();

$categories = new Categories();

if(!empty($_POST['category_id'])){
    $category_id = htmlentities($_POST['category_id']);
    $current_category = $categories->find_category_by_id($category_id);
    if(!$current_category){
        $data['message'] = "errorCategory";
        echo json_encode($data);
        die();
    }

    $categories->id = $current_category['id'];
    $categories->category_name = $_POST['category'];

    // update category
    if(isset($_FILES['image']['type'])){
       
        $categories->attach_file($_FILES['image']);
        $categories->created_date = $current_category['created_date'];
        $categories->edited_date = $d->format("Y-m-d H:i:s");

        if($categories->save_category_image()){
            $data['message'] = "success";
        }

    }else{
        $categories->category_image = $current_category['category_image'];
        $categories->created_date = $current_category['created_date'];
        $categories->edited_date = $d->format("Y-m-d H:i:s");

        if($categories->save()){
            $data['message'] = "success";
        }
    }
}else{

    $categories->category_name = $_POST['category'];

    if(isset($_FILES['image']['type'])){
        $categories->attach_file($_FILES['image']);
        $categories->created_date = $d->format("Y-m-d H:i:s");
        $categories->edited_date = $d->format("Y-m-d H:i:s");

        if($categories->save_category_image()){
            $data['message'] = "success";
        }

    }else{
        $categories->category_image = "noimage.png";
        $categories->created_date = $d->format("Y-m-d H:i:s");
        $categories->edited_date = $d->format("Y-m-d H:i:s");

        if($categories->save()){
            $data['message'] = "success";
        }
    }

}
echo json_encode($data);