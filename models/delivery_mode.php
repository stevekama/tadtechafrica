<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Delivery_Mode{
    
    private $conn;

    // table name and schema 
    private $table_name = "delivery_mode";

    // table properties
    public $id;
    public $delivery_mode;
    public $delivery_amount;
    public $mode_description;
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
            $query .= "delivery_mode, delivery_amount, mode_description, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":delivery_mode, :delivery_amount, :mode_description, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";
        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "delivery_mode = :delivery_mode, delivery_amount = :delivery_amount, mode_description = :mode_description, ";
            $query .= "created_date = :created_date, edited_date = :edited_date";
            $query .= "WHERE id = :id";
        }

        // prepare query 
        $stmt = $this->conn->prepare($query);

         // clean up data
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->delivery_mode = htmlentities($this->delivery_mode);
        $this->delivery_amount = htmlentities($this->delivery_amount);
        $this->mode_description = htmlentities($this->mode_description);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);
 
        // bindParam
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':delivery_mode', $this->delivery_mode);
        $stmt->bindParam(':delivery_amount', $this->delivery_amount);
        $stmt->bindParam(':mode_description', $this->mode_description);
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

    public function find_all()
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "ORDER BY id DESC";

        // prepare statement
        $stmt = $this->conn->prepare($query);
                                                                                                                                                                                             
        // execute statemrent 
        if($stmt->execute()){
            // fetch data
            $mode_object = array();
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $mode_object[] = $row;
                }
            }
            return $mode_object;
        }
    }

    public function find_mode_by_id($id)
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE id = :id LIMIT 1";

        // STATEMENT
        $stmt = $this->conn->prepare($query);

        /// clean up 
        $id = htmlentities($id);

        // execute
        if($stmt->execute(array("id"=>$id))){
            $mode = $stmt->fetch(PDO::FETCH_ASSOC);
            return $mode;
        }
    }
}