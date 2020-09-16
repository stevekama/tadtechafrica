<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialize
require_once('../../init/initialization.php');

// Database Connect
$connection = $database->connect();

$product_promotion = new Product_Promotion();

$all_promotions = $product_promotion->find_all();

$num_promotions = count($all_promotions);

// start on the query
$query = '';

// output array
$output = array();

$query .= "SELECT ";
$query .= "product_promotion.id, product_promotion.product_name, product_promotion.product_price, product_promotion.banner_image, ";
$query .= "categories.category_name, product_classifications.classification ";
$query .= "FROM product_promotion ";
$query .= "INNER JOIN categories ON product_promotion.category_id = categories.id ";
$query .= "INNER JOIN product_classifications ON product_promotion.classification_id = product_classifications.id ";

// Bring  in search query
if(isset($_POST["search"]["value"])){
	$query .= "WHERE (";
	$query .= "categories.category_name LIKE '%{$_POST["search"]["value"]}%' ";
	$query .= "OR product_classifications.classification LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR product_promotion.product_name LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR product_promotion.product_price LIKE '%{$_POST["search"]["value"]}%'";
    $query .= ") ";
}

// order query
if(isset($_POST["order"])){
	$query .= "ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
}else{
	$query .= "ORDER BY product_promotion.id DESC ";
}
// Pagging
if($_POST["length"] != -1){
	$query .= 'LIMIT '.intval($_POST["length"]).' OFFSET '.intval($_POST["start"]);
}

$statement = $connection->prepare($query);
$statement->execute();
$filtered_rows = $statement->rowCount();

// data array
$data = array();

while($row = $statement->fetch(PDO::FETCH_ASSOC)){
	$sub_array = array();
	$image = '<img src="'.public_url().'storage/banner/'.$row["banner_image"].'" alt="Product" class="img-circle img-size-32 mr-2"/>';
    $sub_array[] = $row["classification"];
    $sub_array[] = $row["category_name"];
	$sub_array[] = $row["product_name"];
	$sub_array[] = $image;
    $sub_array[] = $row["product_price"];
	$sub_array[] = '<button id="'.$row["id"].'" class="btn btn-danger delete">Delete</button>';
	$data[] = $sub_array;
}


// store results in output array
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$num_promotions,
	"data"				=>	$data
);
echo json_encode($output);