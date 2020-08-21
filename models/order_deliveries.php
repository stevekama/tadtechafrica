<?php

require_once(INIT_PATH . DS . 'initialization.php');

class Order_Delivery
{
    private $conn;

    // table name and schema 
    private $table_name = "order_delivery";

    // table properties
    public $id;
    public $customer_id;
    public $order_id;
    public $delivery_mode_id;
    public $fullnames;
    public $phone;
    public $alt_phone;
    public $email;
    public $address;
    public $city;
    public $country;
    public $delivery_amount;
    public $delivery_status;
    public $delivery_date;
    public $delivered_by;
    public $created_date;
    public $edited_date;

    // connect to db
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    public function save()
    {
        $query = "";
        if (empty($this->id)) {
            $query .= "INSERT INTO " . $this->table_name . "(";
            $query .= "customer_id, order_id, delivery_mode_id, ";
            $query .= "fullnames, phone, alt_phone, email, ";
            $query .= "address, city, country, ";
            $query .= "delivery_amount, delivery_status, delivery_date, ";
            $query .= "delivered_by, created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":customer_id, :order_id, :delivery_mode_id, ";
            $query .= ":fullnames, :phone, :alt_phone, :email, ";
            $query .= ":address, :city, :country, ";
            $query .= ":delivery_amount, :delivery_status, :delivery_date, ";
            $query .= ":delivered_by, :created_date, :edited_date";
            $query .= ")";
        } else {
            $query .= "UPDATE " . $this->table_name . " SET ";
            $query .= "customer_id = :customer_id, order_id = :order_id, delivery_mode_id = :delivery_mode_id, ";
            $query .= "fullnames = :fullnames, phone = :phone, alt_phone = :alt_phone, email = :email, ";
            $query .= "address = :address, city = :city, country = :country, ";
            $query .= "delivery_amount = :delivery_amount, delivery_status = :delivery_status, delivery_date = :delivery_date, ";
            $query .= "delivered_by = :delivered_by, created_date = :created_date, edited_date = :edited_date";
            $query .= "WHERE id = :id";
        }

        // prepare query 
        $stmt = $this->conn->prepare($query);

        // clean up data
        if (!empty($this->id)) {
            $this->id = htmlentities($this->id);
        }
        $this->customer_id = htmlentities($this->customer_id);
        $this->order_id = htmlentities($this->order_id);
        $this->delivery_mode_id = htmlentities($this->delivery_mode_id);
        $this->fullnames = htmlentities($this->fullnames);
        $this->phone = htmlentities($this->phone);
        $this->alt_phone = htmlentities($this->alt_phone);
        $this->email = htmlentities($this->email);
        $this->address = htmlentities($this->address);
        $this->city = htmlentities($this->city);
        $this->country = htmlentities($this->country);
        $this->delivery_amount = htmlentities($this->delivery_amount);
        $this->delivery_status = htmlentities($this->delivery_status);
        $this->delivery_date = htmlentities($this->delivery_date);
        $this->delivered_by = htmlentities($this->delivered_by);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        // bindParam
        if (!empty($this->id)) {
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':delivery_mode_id', $this->delivery_mode_id);
        $stmt->bindParam(':fullnames', $this->fullnames);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':alt_phone', $this->alt_phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':delivery_amount', $this->delivery_amount);
        $stmt->bindParam(':delivery_status', $this->delivery_status);
        $stmt->bindParam(':delivery_date', $this->delivery_date);
        $stmt->bindParam(':delivered_by', $this->delivered_by);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        // execute query 
        if ($stmt->execute()) {
            if (empty($this->id)) {
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        }
    }

    // delete 
    public function delete($id = 0)
    {
        $query = "DELETE FROM " . $this->table_name . " ";
        $query .= "WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // htmlentities
        $id = htmlentities($id);

        // execute 
        if ($stmt->execute(array('id' => $id))) {
            return true;
        }
    }

    // find all by id 
    public function find_by_id($id = 0)
    {
        $query = "SELECT * FROM " . $this->table_name . " ";
        $query .= "WHERE id = :id LIMIT 1";

        // prepare statement 
        $stmt = $this->conn->prepare($query);

        // cleanup id 
        $id = htmlentities($id);

        if ($stmt->execute(array("id" => $id))) {
            // fetch delivery 
            $delivery = $stmt->fetch(PDO::FETCH_ASSOC);
            // return delivery 
            return $delivery;
        }
    }

    // find customer order by mode of delivery
    public function find_order_delivery_by_customer_id_order_id_and_delivery_mode_id($customer_id=0, $order_id=0, $delivery_mode_id=0){
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE customer_id = :customer_id AND order_id = :order_id AND delivery_mode_id = :delivery_mode_id ";
        $query .= "LIMIT 1";

        $stmt = $this->conn->prepare($query);

        // clean up data
        $customer_id = htmlentities($customer_id);
        $order_id = htmlentities($order_id);
        $delivery_mode_id = htmlentities($delivery_mode_id);

        if($stmt->execute(array("customer_id"=>$customer_id, "order_id"=>$order_id, "delivery_mode_id"=>$delivery_mode_id))){
            $order_delivery = $stmt->fetch(PDO::FETCH_ASSOC);
            return $order_delivery;
        }
    }
}