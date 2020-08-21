<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Delivery_Mode_migration{
    private $conn;

    // table name and schema 
    private $table_name = "delivery_mode";

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
        $query .= "delivery_mode VARCHAR(100) NOT NULL, ";
        $query .= "delivery_amount VARCHAR(200) NOT NULL, ";
        $query .= "created_date TIMESTAMP NULL DEFAULT NULL, ";
        $query .= "edited_date TIMESTAMP NULL DEFAULT NULL";
        $query .= ")";

        // execute query 
        $this->conn->exec($query);
        return true;
    }


    public function add_mode_description()
    {
        $query = "ALTER TABLE ".$this->table_name." ";
        $query .= "ADD mode_description TEXT NOT NULL ";
        $query .= "AFTER delivery_mode";

        // execute query 
        $this->conn->exec($query);
        return true;
    }

    // drop table 
    public function drop()
    {
        $query = "DROP TABLE " . $this->table_name;

        $this->conn->exec($query);
        return true;
    }
}