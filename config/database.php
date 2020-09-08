<?php
class Database{
//     private $host = 'localhost';
//     private $username = 'tadteica_steve';
//     private $password = 'stevekama';
//     private $dbname = 'tadteica_tadtechafrica';
    
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'tadtechafrica';

    private $conn;

    public function connect()
    {
         $this->conn = null;
         try{
              $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         }catch(PDOException $e){
              echo 'Connection Error: ' . $e->getMessage();
         }
         return $this->conn;
    }
}

$database = new Database();