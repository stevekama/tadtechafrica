<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Cart{
    
    private $conn;

    // table name and schema 
    private $table_name = "cart";

    // table properties
    public $id;
    public $customer_id;
    public $product_id;
    public $quantity;
    public $item_price;
    public $total_price;
    public $loginstatus;
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
            $query .= "customer_id, product_id, quantity, ";
            $query .= "item_price, total_price, loginstatus, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":customer_id, :product_id, :quantity, ";
            $query .= ":item_price, :total_price, :loginstatus, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";

        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "customer_id = :customer_id, product_id = :product_id, quantity = :quantity, ";
            $query .= "item_price = :item_price, total_price = :total_price, loginstatus = :loginstatus, "; 
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
        $this->product_id = htmlentities($this->product_id);
        $this->quantity = htmlentities($this->quantity);
        $this->item_price = htmlentities($this->item_price);
        $this->total_price = htmlentities($this->total_price);
        $this->loginstatus = htmlentities($this->loginstatus);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);
 
        // bindParam
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':item_price', $this->item_price);
        $stmt->bindParam(':total_price', $this->total_price);
        $stmt->bindParam(':loginstatus', $this->loginstatus);
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

    public function find_cart_item_by_customer_id($customer_id = 0)
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE customer_id = :customer_id ";
        $query .= "ORDER BY id DESC";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean up 
        $customer_id = htmlentities($customer_id);

        // execute statemrent 
        if($stmt->execute(array('customer_id'=>$customer_id))){
            // fetch data
            $customer_object = array();
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $customer_object[] = $row;
                }
            }
            return $customer_object;
        }
    }

    public function find_total_price_cart_item_by_customer_id($customer_id = 0)
    {
        $query = "SELECT SUM(total_price) total FROM ".$this->table_name." ";
        $query .= "WHERE customer_id = :customer_id ";
        $query .= "ORDER BY id DESC";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean up 
        $customer_id = htmlentities($customer_id);

        // execute statemrent 
        if($stmt->execute(array('customer_id'=>$customer_id))){
            // fetch data
            $customer_object = array();
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $customer_object[] = $row;
                }
            }
            return $customer_object;
        }
    }


    public function find_cart_items_by_loginstatus($loginstatus = "")
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE loginstatus = :loginstatus ";
        $query .= "ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        $loginstatus = htmlentities($loginstatus);

        if($stmt->execute(array('loginstatus'=>$loginstatus))){
            $cart_object = array();
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $cart_object[] = $row;
                }

            }

            return $cart_object;
        }else{
            return false;
        }
    }
    
    public function find_cart_item_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "WHERE id = :id LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('id'=>$id))){
            $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $cart_item;
        }else{
            return false;
        }
    }

    public function find_cart_items_by_customer_id_and_product_id($customer_id=0, $product_id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE customer_id = :customer_id AND product_id = :product_id ";
        $query .= "LIMIT 1";

        // prepare stmt
        $stmt = $this->conn->prepare($query);

        // clean up
        $customer_id = htmlentities($customer_id);
        $product_id = htmlentities($product_id);

        // execute
        if($stmt->execute(array('customer_id'=>$customer_id, 'product_id'=>$product_id))){
            $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);
            return $cart_item;
        }
    }
}