<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Product_Classification{
    
    private $conn;

    // table name and schema 
    private $table_name = "product_classifications";

    // table properties
    public $id;
    public $classification;
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
            $query .= "classification, created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":classification, :created_date, :edited_date";
            $query .= ")";

        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "classification = :classification, created_date = :created_date, edited_date = :edited_date ";
            $query .= "WHERE id = :id";
        }

        // prepare query 
        $stmt = $this->conn->prepare($query);

         // clean up data
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->classification = htmlentities($this->classification);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);
 
        // bindParam
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':classification', $this->classification);
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
            $classification_object = array();
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $classification_object[] = $row;
                }
            }
            return $classification_object;
        }
    }
    
    public function find_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "WHERE id = :id LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('id'=>$id))){
            $classification = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set Classification
            return $classification;
        }else{
            return false;
        }
    }

    public function find_by_classification($classification = "")
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "WHERE classification = :classification LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('classification'=>$classification))){
            // fetch classification
            $classification = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set Classification
            return $classification;
            
        }else{
            return false;
        }
    }
}