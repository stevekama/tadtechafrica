<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Order_Delivery_migration{

    private $conn;

    // table name and schema 
    private $table_name = "order_delivery";

    // connect to  ,M M
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
        $query .= "order_id INT(11) NOT NULL, ";
        $query .= "delivery_mode_id INT(11) NOT NULL, ";
        $query .= "fullnames VARCHAR(200) NOT NULL, ";
        $query .= "phone VARCHAR(200) NOT NULL, ";
        $query .= "alt_phone VARCHAR(200) NOT NULL, ";
        $query .= "email VARCHAR(200) NOT NULL, ";
        $query .= "address TEXT NOT NULL, ";
        $query .= "city VARCHAR(200) NOT NULL, ";
        $query .= "country VARCHAR(200) NOT NULL, ";
        $query .= "delivery_amount VARCHAR(200) NOT NULL, ";
        $query .= "delivery_status VARCHAR(200) NOT NULL, ";
        $query .= "delivery_date DATE NOT NULL, ";
        $query .= "delivered_by VARCHAR(200) NOT NULL, ";
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