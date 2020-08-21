<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Products_migration{

    private $conn;

    // table name and schema 
    private $table_name = "products";

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
        $query .= "category_id INT(11) NOT NULL, ";
        $query .= "product_name VARCHAR(100) NOT NULL, ";
        $query .= "product_image VARCHAR(200) NOT NULL, ";
        $query .= "product_details VARCHAR(200) NOT NULL, ";
        $query .= "product_description TEXT, ";
        $query .= "product_price VARCHAR(200) NOT NULL, ";
        $query .= "product_units VARCHAR(200) NOT NULL, ";
        $query .= "product_status VARCHAR(200) NOT NULL, ";
        $query .= "created_date TIMESTAMP NULL DEFAULT NULL, ";
        $query .= "edited_date TIMESTAMP NULL DEFAULT NULL";
        $query .= ")";

        // execute query 
        $this->conn->exec($query);
        return true;
    }

    public function add_classification_id()
    {
        $query = "ALTER TABLE ".$this->table_name." ";
        $query .= "ADD classification_id INT(11) NOT NULL ";
        $query .= "AFTER category_id";

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