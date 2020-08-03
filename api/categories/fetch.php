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
$categories = new Categories();

$all_categories = $categories->find_all();

$num_categories = count($all_categories);

// start on the query
$query = '';

// output array
$output = array();

$query .= "SELECT * FROM categories ";

// Bring  in search query
if(isset($_POST["search"]["value"])){
	$query .= "WHERE (";
	$query .= "category_name LIKE '%{$_POST["search"]["value"]}%'";
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
    $image = '<img src="'.public_url().'storage/categories/'.$row["category_image"].'" alt="Category" class="img-circle img-size-32 mr-2"/>';
	$sub_array[] = $image;
	$sub_array[] = $row["category_name"];
	// $sub_array[] = '<button id="'.$row["id"].'" class="btn btn-info edit">Edit</button>';
	$sub_array[] = '<button id="'.$row["id"].'" class="btn btn-danger delete">Delete</button>';
	$data[] = $sub_array;
}


// store results in output array
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$num_categories,
	"data"				=>	$data
);
echo json_encode($output);