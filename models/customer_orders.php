<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Customer_Orders{
    
    private $conn;

    // table name and schema 
    private $table_name = "customer_orders";

    // table properties
    public $id;
    public $customer_id;
    public $order_date;
    public $order_price;
    public $order_status;
    public $order_delivery;
    public $order_total;
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
            $query .= "customer_id, order_date, ";
            $query .= "order_price, order_status, ";
            $query .= "order_delivery, order_total, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":customer_id, :order_date, ";
            $query .= ":order_price, :order_status, ";
            $query .= ":order_delivery, :order_total, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";

        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "customer_id = :customer_id, order_date = :order_date, ";
            $query .= "order_price = :order_price, order_status = :order_status, ";
            $query .= "order_delivery = :order_delivery, order_total = :order_total, ";
            $query .= "created_date = :created_date, edited_date = :edited_date ";
            $query .= "WHERE id = :id";
        }

        // prepare query 
        $stmt = $this->conn->prepare($query);

         // clean up data
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->customer_id = htmlentities($this->customer_id);
        $this->order_date = htmlentities($this->order_date);
        $this->order_price = htmlentities($this->order_price);
        $this->order_status = htmlentities($this->order_status);
        $this->order_delivery = htmlentities($this->order_delivery);
        $this->order_total = htmlentities($this->order_total);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);
 
        // bindParam
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':order_date', $this->order_date);
        $stmt->bindParam(':order_price', $this->order_price);
        $stmt->bindParam(':order_status', $this->order_status);
        $stmt->bindParam(':order_delivery', $this->order_delivery);
        $stmt->bindParam(':order_total', $this->order_total);
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
            $order_object = array();
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $order_object[] = $row;
                }
            }
            return $order_object;
        }
    }
    
    public function find_order_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "WHERE id = :id LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('id'=>$id))){
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $order;
        }else{
            return false;
        }
    }
}