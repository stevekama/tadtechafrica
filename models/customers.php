<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Customers{
    
    private $conn;

    // table name and schema 
    private $table_name = "customers";

    // table properties
    public $id;
    public $customer_fullnames;
    public $customer_image;
    public $customer_phone;
    public $customer_email;
    public $password;
    public $confirm_password;
    public $forgot_code;
    public $created_date;
    public $edited_date;

    // connect to db
    public function __construct(){
        global $database;
        $this->conn = $database->connect();
    }

    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query .= "INSERT INTO ".$this->table_name."(";
            $query .= "customer_fullnames, customer_phone, customer_email, "; 
            $query .= "customer_image, password, confirm_password, forgot_code, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":customer_fullnames, :customer_phone, :customer_email, "; 
            $query .= ":customer_image, :password, :confirm_password, :forgot_code, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";

        }

        // prepare query 
        $stmt = $this->conn->prepare($query);

         // clean up data
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->customer_fullnames = htmlentities($this->customer_fullnames);
        $this->customer_image = htmlentities($this->customer_image);
        $this->customer_phone = htmlentities($this->customer_phone);
        $this->customer_email = htmlentities($this->customer_email);
        $this->password = htmlentities($this->password);
        $this->forgot_code = htmlentities($this->forgot_code);
        $this->confirm_password = htmlentities($this->confirm_password);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);
 
        // bindParam
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':customer_fullnames', $this->customer_fullnames);
        $stmt->bindParam(':customer_image', $this->customer_image);
        $stmt->bindParam(':customer_phone', $this->customer_phone);
        $stmt->bindParam(':customer_email', $this->customer_email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':confirm_password', $this->confirm_password);
        $stmt->bindParam(':forgot_code', $this->forgot_code);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        // execute query 
        if($stmt->execute()){
            if(empty($this->id)){
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        }
    }

    public function update()
    {
        $query = "";
        if(!empty($this->id)){
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "customer_fullnames=:customer_fullnames, customer_phone=:customer_phone, ";
            $query .= "customer_email=:customer_email, customer_image=:customer_image, "; 
            $query .= "forgot_code = :forgot_code, created_date=:created_date, edited_date=:edited_date ";
            $query .= "WHERE id = :id";
        }

         // prepare query 
         $stmt = $this->conn->prepare($query);

         // clean up data
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->customer_fullnames = htmlentities($this->customer_fullnames);
        $this->customer_image = htmlentities($this->customer_image);
        $this->customer_phone = htmlentities($this->customer_phone);
        $this->customer_email = htmlentities($this->customer_email);
        $this->forgot_code = htmlentities($this->forgot_code);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);
 
        // bindParam
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':customer_fullnames', $this->customer_fullnames);
        $stmt->bindParam(':customer_image', $this->customer_image);
        $stmt->bindParam(':customer_phone', $this->customer_phone);
        $stmt->bindParam(':customer_email', $this->customer_email);
        $stmt->bindParam(':forgot_code', $this->forgot_code);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        // execute query 
        if($stmt->execute()){
            return true;
        }
    }

    // find customer by password
    public function find_customer_by_password($id=0, $password="")
    {
        $customer = $this->find_customer_by_id($id);
        if($customer){
            // find password
            if(password_verify($password, $customer['password'])){
                return $customer;
            }
        }else{
            return false;
        }
    }

    // update customer password
    public function update_password()
    {
        $query = "";
        if(!empty($this->id)){
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "password = :password, confirm_password = :confirm_password, ";
            $query .= "edited_date = :edited_date ";
            $query .= "WHERE id=:id";
        }

        $stmt = $this->conn->prepare($query);

        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->confirm_password = password_hash($this->confirm_password, PASSWORD_DEFAULT);
        $this->edited_date = htmlentities($this->edited_date);

        // bind statement
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':confirm_password', $this->confirm_password);
        $stmt->bindParam(':edited_date', $this->edited_date);

        // execute
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }


    // save with category image
    private $temp_path;

    protected $upload_dir = "customers";

    // store errors
    public $errors = array();

    //upload errors
    protected $upload_errors = array(
         //http://www.php.net/manual/en/features.file-upload.errors.php
         UPLOAD_ERR_OK => "No errors.",
         UPLOAD_ERR_INI_SIZE => "Large than upload_max_filesize",
         UPLOAD_ERR_FORM_SIZE => "Large than form max_size",
         UPLOAD_ERR_PARTIAL => "Partial upload",
         UPLOAD_ERR_NO_FILE => "No file",
         UPLOAD_ERR_NO_TMP_DIR => "No temporary directory",
         UPLOAD_ERR_CANT_WRITE => "Cant write to disk",
         UPLOAD_ERR_EXTENSION => "File upload stopped by extension. "
    );
 
    //attach file removing all errors
    public function attach_file($file)
    {
        /*
        * Perform error checking on the form parameters
        * set object attributes to form parameters
        * dont worry about saving anything to the database yet.
        */
        //perform error checking on the form parameters
        if (!$file || empty($file) || !is_array($file)) {
            //error: nothing uploaded or wrong argument usage
            $this->errors[] = "No file was uploaded. ";
            return false;
        } elseif ($file['error'] != 0) {
            // error: report what PHP says went wrong
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        } else {
            // Set object attributes to the form parameters
            $this->temp_path = $file['tmp_name'];
            $this->customer_image = basename(time() . $file['name']);
            //Dont worry about the databaseyet
            return true;
        }
    }

    // save with image
    public function save_customer_image()
    {
        /*
        * Make sure there are no errors
        * Attempt to move the file
        * Save corresponding entry to the database
        */
        // 1. make sure there are no errors
        if (!empty($this->errors)) {
            return false;
        }

        //2. cant see without filename and tempt location
        if (empty($this->customer_image) || empty($this->temp_path)) {
            $this->errors[] = "The file location was not available.";
            return false;
        }

        // 3. Determine the target_path
        $target_path = PUBLIC_PATH . DS . 'storage' . DS . $this->upload_dir . DS . $this->customer_image;

        // 4. make sure the file doesn't exist
        if (file_exists($target_path)) {
            return unlink($target_path) ? true : false;
        }

        // 5. Attempt to move the file
        if (move_uploaded_file($this->temp_path, $target_path)) {
            // save the file
            if(empty($this->id)){
                if ($this->save()) {
                    return true;
                }
            }else{
                if($this->update()){
                    return true;
                }
            }
        } else {
            /*
                * File was not moved
                */
            $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the uploaded folder.";
            return false;
        }
    }

    // delete
    public function delete($id=0)
    {
        $query = "DELETE FROM ".$this->table_name." ";
        $query .= "WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        // clean up id
        $this->id = htmlentities($this->id);

        // execute
        if($stmt->execute(array('id'=>$id))){
            return true;
        }
    }

    public function find_all()
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "ORDER BY id DESC";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute statemrent 
        if($stmt->execute()){
            // fetch data
            $customer_object = array();
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $customer_object[] = $row;
                }
            }
            return $customer_object;
        }
    }
    
    public function find_customer_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "WHERE id = :id LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('id'=>$id))){
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $customer;
        }else{
            return false;
        }
    }

    public function find_customer_by_email($customer_email=0)
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "WHERE customer_email = :customer_email LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('customer_email'=>$customer_email))){
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $customer;
        }else{
            return false;
        }
    }

    public function find_customer_by_forgot_code($forgot_code=0)
    {
        $query = "SELECT * FROM ".$this->table_name." "; 
        $query .= "WHERE forgot_code = :forgot_code LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('forgot_code'=>$forgot_code))){
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $customer;
        }else{
            return false;
        }
    }


    public function authenticate_customer($customer_email="", $password="")
    {
        // find customer by email
        $customer = $this->find_customer_by_email($customer_email);
        if($customer){
            // check password
            if(password_verify($password, $customer['password'])){
                return $customer;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}