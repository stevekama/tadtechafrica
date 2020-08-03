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

$products = new Products();

$all_products = $products->find_all();

$num_products = count($all_products);

// start on the query
$query = '';

// output array
$output = array();

$query .= "SELECT ";
$query .= "products.id, categories.category_name, products.product_name, ";
$query .= "products.product_image, products.product_price, products.product_units ";
$query .= "FROM products ";
$query .= "INNER JOIN categories ON products.category_id = categories.id ";
// Bring  in search query
if(isset($_POST["search"]["value"])){
	$query .= "WHERE (";
	$query .= "categories.category_name LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR products.product_name LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR products.product_price LIKE '%{$_POST["search"]["value"]}%' ";
    $query .= "OR products.product_units LIKE '%{$_POST["search"]["value"]}%'";
    $query .= ") ";
}

// order query
if(isset($_POST["order"])){
	$query .= "ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
}else{
	$query .= "ORDER BY products.id DESC ";
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
    $image = '<img src="'.public_url().'storage/products/'.$row["product_image"].'" alt="Product" class="img-circle img-size-32 mr-2"/>';
    $sub_array[] = $row["category_name"];
    $sub_array[] = $image;
    $sub_array[] = $row["product_name"];
    $sub_array[] = $row["product_price"];
    $sub_array[] = $row["product_units"];
	// $sub_array[] = '<button id="'.$row["id"].'" class="btn btn-info edit">Edit</button>';
	$sub_array[] = '<button id="'.$row["id"].'" class="btn btn-info view">View</button>';
	$data[] = $sub_array;
}


// store results in output array
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$num_products,
	"data"				=>	$data
);
echo json_encode($output);