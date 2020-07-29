<?php
class Database{
//     private $host = 'ec2-107-21-214-222.compute-1.amazonaws.com';
//     private $username = 'oknpdplmvajclv';
//     private $password = '03e49128caa781faf978dc2cf5f0b04ce1f9cb085b7d681e6570ca508bf78881';
//     private $dbname = 'dfllb4f144eou6';
    
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'tadtech_ecommas';

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