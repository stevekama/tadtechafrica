<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Product_Promotion_migration{

    private $conn;

    // table name and schema 
    private $table_name = "product_promotion";

    // connect to db
    public function __construct(){
        global $database;
        $this->conn = $database->connect();
    }

    // create table
    public function create()
    {
        $query = "CREATE TABLE IF NOT EXISTS ".$this->table_name."(";
        $query .= "id INT(11) UNSIGNED  NOT NULL PRIMARY KEY AUTO_INCREMENT, ";
        $query .= "classification_id INT(11) NOT NULL, ";
        $query .= "category_id INT(11) NOT NULL, ";
        $query .= "product_id INT(11) NOT NULL, ";
        $query .= "product_name VARCHAR(200) NOT NULL, ";
        $query .= "banner_image VARCHAR(200) NOT NULL, ";
        $query .= "product_price VARCHAR(200) NOT NULL, ";
        $query .= "created_date TIMESTAMP NULL DEFAULT NULL, ";
        $query .= "edited_date TIMESTAMP NULL DEFAULT NULL";
        $query .= ")";

        // execute query 
        $this->conn->exec($query);
        
        return true;
    }

     // drop table 
     public function drop()
     {
        $query = "DROP TABLE ".$this->table_name;

       $this->conn->exec($query);
       return true;
     }


}