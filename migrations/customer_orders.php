<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Orders_migration{

    private $conn;

    // table name and schema 
    private $table_name = "customer_orders";

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
        $query .= "customer_id INT(11) NOT NULL, ";
        $query .= "order_date DATE NOT NULL, ";
        $query .= "order_price VARCHAR(200) NOT NULL, ";
        $query .= "order_status VARCHAR(200) NOT NULL, ";
        $query .= "order_delivery VARCHAR(200) NOT NULL, ";
        $query .= "order_total VARCHAR(200) NOT NULL, ";
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