<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Customer_Location{
    
    private $conn;

    // table name and schema 
    private $table_name = "customer_location";

    // table properties
    public $id;
    public $customer_id;
    public $address;
    public $country;
    public $zipcode;
    public $city;
    public $state;
    public $created_date;
    public $edited_date;

    // connect to db
    public function __construct(){
        global $database;
        $this->conn = $database->connect();
    }

    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query .= "INSERT INTO ".$this->table_name."(";
            $query .= "customer_id, address, ";
            $query .= "country, zipcode, ";
            $query .= "city, state, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":customer_id, :address, ";
            $query .= ":country, :zipcode, ";
            $query .= ":city, :state, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";

        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "customer_id = :customer_id, address = :address, ";
            $query .= "country = :country, zipcode = :zipcode, ";
            $query .= "city = :city, state = :state, ";
            $query .= "created_date = :created_date, edited_date = :edited_date";
            $query .= "WHERE id = :id";
        }

        // prepare query 
        $stmt = $this->conn->prepare($query);

         // clean up data
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->customer_id = htmlentities($this->customer_id);
        $this->address = htmlentities($this->address);
        $this->country = htmlentities($this->country);
        $this->zipcode = htmlentities($this->zipcode);
        $this->city = htmlentities($this->city);
        $this->state = htmlentities($this->state);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);
 
        // bindParam
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':zipcode', $this->zipcode);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        // execute query 
        if($stmt->execute()){
            if(empty($this->id)){
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        }
    }

    // delete
    public function delete($id=0)
    {
        $query = "DELETE FROM ".$this->table_name." ";
        $query .= "WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        // clean up id
        $this->id = htmlentities($this->id);

        // execute
        if($stmt->execute(array('id'=>$id))){
            return true;
        }
    }

    public function find_all()
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "ORDER BY id DESC";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute statemrent 
        if($stmt->execute()){
            // fetch data
            $location_object = array();
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $location_object[] = $row;
                }
            }
            return $location_object;
        }
    }
    
    public function find_location_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "WHERE id = :id LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('id'=>$id))){
            $location = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $location;
        }else{
            return false;
        }
    }

    public function find_location_by_customer_id($customer_id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "WHERE customer_id = :customer_id LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('customer_id'=>$customer_id))){
            $location = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $location;
        }else{
            return false;
        }
    }
}