<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Cart{
    
    private $conn;

    // table name and schema 
    private $table_name = "cart";

    // table properties
    public $id;
    public $customer_id;
    public $order_id;
    public $product_id;
    public $quantity;
    public $item_price;
    public $total_price;
    public $loginstatus;
    public $cart_status;
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
            $query .= "customer_id, order_id, product_id, quantity, ";
            $query .= "item_price, total_price, loginstatus, cart_status, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":customer_id, :order_id, :product_id, :quantity, ";
            $query .= ":item_price, :total_price, :loginstatus, :cart_status, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";

        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "customer_id = :customer_id, order_id = :order_id, product_id = :product_id, quantity = :quantity, ";
            $query .= "item_price = :item_price, total_price = :total_price, loginstatus = :loginstatus, cart_status = :cart_status, "; 
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
        $this->order_id = htmlentities($this->order_id);
        $this->product_id = htmlentities($this->product_id);
        $this->quantity = htmlentities($this->quantity);
        $this->item_price = htmlentities($this->item_price);
        $this->total_price = htmlentities($this->total_price);
        $this->loginstatus = htmlentities($this->loginstatus);
        $this->cart_status = htmlentities($this->cart_status);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);
 
        // bindParam
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':item_price', $this->item_price);
        $stmt->bindParam(':total_price', $this->total_price);
        $stmt->bindParam(':loginstatus', $this->loginstatus);
        $stmt->bindParam(':cart_status', $this->cart_status);
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

    // find by order id and customer id 
    public function find_cart_items_by_customer_id_and_order_id($customer_id = 0, $order_id = 0)
    {
        $query  = "SELECT ";
        $query .= "cart.id, cart.quantity, cart.item_price, cart.total_price, ";
        $query .= "products.product_name, products.product_image "; 
        $query .= "FROM ".$this->table_name." ";
        $query .= "INNER JOIN products ON cart.product_id = products.id ";
        $query .= "WHERE cart.customer_id = :customer_id AND cart.order_id = :order_id ";
        $query .= "ORDER BY cart.id DESC";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // clean up
        $customer_id = htmlentities($customer_id);
        $order_id = htmlentities($order_id);

        // execute query
        if($stmt->execute(array("customer_id"=>$customer_id, "order_id"=>$order_id))){
            $items_object = array();
            $count_items = $stmt->rowCount();
            if($count_items > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $items_object[] = $row;
                }
            }

            return $items_object;
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

    public function find_total_price_cart_item_by_customer_id_and_cart_status($customer_id = 0, $cart_status = "")
    {
        $query = "SELECT SUM(total_price) total FROM ".$this->table_name." ";
        $query .= "WHERE customer_id = :customer_id AND cart_status = :cart_status ";
        $query .= "ORDER BY id DESC";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean up 
        $customer_id = htmlentities($customer_id);
        $cart_status = htmlentities($cart_status);

        // execute statemrent 
        if($stmt->execute(array('customer_id'=>$customer_id, 'cart_status'=>$cart_status))){
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


    public function find_cart_items_by_cart_status($customer_id = 0, $cart_status = "")
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE customer_id = :customer_id AND cart_status = :cart_status ";
        $query .= "ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        $customer_id = htmlentities($customer_id);
        $cart_status = htmlentities($cart_status);


        if($stmt->execute(array('customer_id'=>$customer_id, 'cart_status'=>$cart_status))){
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

    public function find_cart_items_by_customer_id_and_product_id_and_cart_status($customer_id=0, $product_id=0, $cart_status = "")
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE customer_id = :customer_id AND product_id = :product_id AND cart_status = :cart_status ";
        $query .= "LIMIT 1";

        // prepare stmt
        $stmt = $this->conn->prepare($query);

        // clean up
        $customer_id = htmlentities($customer_id);
        $product_id = htmlentities($product_id);
        $cart_status = htmlentities($cart_status);

        // execute
        if($stmt->execute(array('customer_id'=>$customer_id, 'product_id'=>$product_id, 'cart_status'=>$cart_status))){
            $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);
            return $cart_item;
        }
    }
}