<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Product_Promotion{

    private $conn;

    // table name and schema 
    private $table_name = "product_promotion";

    // table properties
    public $id;
    public $classification_id;
    public $category_id;
    public $product_id;
    public $product_name;
    public $product_price;
    public $created_date;
    public $edited_date;

    // connect to db
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    // Save 
    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query .= "INSERT INTO ".$this->table_name."(";
            $query .= "classification_id, category_id, "; 
            $query .= "product_id, product_name, product_price, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":classification_id, :category_id, "; 
            $query .= ":product_id, :product_name, :product_price, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";
        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "classification_id = :classification_id, category_id = :category_id, "; 
            $query .= "product_id = :product_id, product_name = :product_name, product_price = :product_price, ";
            $query .= "created_date = :created_date, edited_date = :edited_date ";
            $query .= "WHERE id = :id";
        }

        $stmt = $this->conn->prepare($query);

        // clean up data
        if (!empty($this->id)) {
            $this->id = htmlentities($this->id);
        }
        
        $this->classification_id = htmlentities($this->classification_id);
        $this->category_id = htmlentities($this->category_id);
        $this->product_id = htmlentities($this->product_id);
        $this->product_name = htmlentities($this->product_name);
        $this->product_price = htmlentities($this->product_price);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        // bindParam
        if (!empty($this->id)) {
            $stmt->bindParam(':id', $this->id);
        }
        
        $stmt->bindParam(':classification_id', $this->classification_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':product_price', $this->product_price);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        // execute 
        if($stmt->execute()){
            if(empty($this->id)){
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        }
    }

    // find all 
    public function find_all()
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            $product_promotion_obj = array();
            // loop throught 
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $product_promotion_obj[] = $row;
                }
            }
            return $product_promotion_obj;
        }
    }

    // find by id
    public function find_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE id=:id LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $id = htmlentities($id);

        if($stmt->execute(array("id"=>$id))){
            $promotion = $stmt->fetch(PDO::FETCH_ASSOC);
            return $promotion;
        }
    }

    // delete
    public function delete($id=0)
    {
        $query = "DELETE FROM ".$this->table_name." WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $id = htmlentities($id);

        if($stmt->execute(array("id"=>$id))){
            return true;
        }
    }
}