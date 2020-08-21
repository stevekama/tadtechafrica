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

// find all categories
$classifications = new Product_Classification();

$product_classifications = $classifications->find_all();

$num_classifications = count($product_classifications);

// start on the query
$query = '';

// output array
$output = array();

$query .= "SELECT * FROM product_classifications ";

// Bring  in search query
if(isset($_POST["search"]["value"])){
	$query .= "WHERE (";
	$query .= "classification LIKE '%{$_POST["search"]["value"]}%'";
	$query .= ") ";
}

// order query
if(isset($_POST["order"])){
	$query .= "ORDER BY ".$_POST['order']['0']['column']." ".$_POST['order']['0']['dir']." ";
}else{
	$query .= "ORDER BY id DESC ";
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
	$sub_array[] = $row["classification"];
	// $sub_array[] = '<button id="'.$row["id"].'" class="btn btn-info edit">Edit</button>';
	$sub_array[] = '<button id="'.$row["id"].'" class="btn btn-danger delete">Delete</button>';
	$data[] = $sub_array;
}


// store results in output array
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$num_classifications,
	"data"				=>	$data
);
echo json_encode($output);