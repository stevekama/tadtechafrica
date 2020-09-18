<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Customers_migration{

    private $conn;

    // table name and schema 
    private $table_name = "customers";

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
        $query .= "customer_fullnames VARCHAR(100) NOT NULL, ";
        $query .= "customer_image VARCHAR(200) NOT NULL, ";
        $query .= "customer_phone VARCHAR(200) NOT NULL, ";
        $query .= "customer_email VARCHAR(200) NOT NULL, ";
        $query .= "customer_address VARCHAR(200) NOT NULL, ";
        $query .= "password VARCHAR(200) NOT NULL, ";
        $query .= "confirm_password VARCHAR(200) NOT NULL, ";
        $query .= "forgot_code VARCHAR(200) NOT NULL, ";
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