<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Products{
    
    private $conn;

    // table name and schema 
    private $table_name = "products";

    // table properties
    public $id;
    public $category_id;
    public $product_name;
    public $product_image;
    public $product_details;
    public $product_description;
    public $product_price;
    public $product_units;
    public $product_status;
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
            $query .= "category_id = :category_id, product_name, product_image, product_details, ";
            $query .= "product_description, product_price, product_units, ";
            $query .= "product_status, created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":product_name, :product_image, :product_details, ";
            $query .= ":product_description, :product_price, :product_units, ";
            $query .= ":product_status, :created_date, :edited_date";
            $query .= ")";

        }else{
            $query .= "UPDATE ".$this->schema.".".$this->table_name." SET ";
            $query .= "category_id = :category_id, product_name = :product_name, product_image = :product_image, product_details = :product_details, ";
            $query .= "product_description = :product_description, product_price = :product_price, product_units = :product_units, ";
            $query .= "product_status = :product_status, created_date = :created_date, edited_date = :edited_date ";
            $query .= "WHERE id = :id";
        }

        // prepare query 
        $stmt = $this->conn->prepare($query);

         // clean up data
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->category_id = htmlentities($this->category_id);
        $this->product_name = htmlentities($this->product_name);
        $this->product_image = htmlentities($this->product_image);
        $this->product_details = htmlentities($this->product_details);
        $this->product_description = htmlentities($this->product_description);
        $this->product_price = htmlentities($this->product_price);
        $this->product_units = htmlentities($this->product_units);
        $this->product_status = htmlentities($this->product_status);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);
 
        // bindParam
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':product_image', $this->product_image);
        $stmt->bindParam(':product_details', $this->product_details);
        $stmt->bindParam(':product_description', $this->product_description);
        $stmt->bindParam(':product_price', $this->product_price);
        $stmt->bindParam(':product_units', $this->product_units);
        $stmt->bindParam(':product_status', $this->product_status);
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

    // save with category image
    private $temp_path;

    protected $upload_dir = "products";

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
            $this->product_image = basename(time() . $file['name']);
            //Dont worry about the databaseyet
            return true;
        }
    }

    // save with image
    public function save_product_image()
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
        if (empty($this->product_image) || empty($this->temp_path)) {
            $this->errors[] = "The file location was not available.";
            return false;
        }

        // 3. Determine the target_path
        $target_path = PUBLIC_PATH . DS . 'storage' . DS . $this->upload_dir . DS . $this->product_image;

        // 4. make sure the file doesn't exist
        if (file_exists($target_path)) {
            return unlink($target_path) ? true : false;
        }

        // 5. Attempt to move the file
        if (move_uploaded_file($this->temp_path, $target_path)) {
            // save the file
            if ($this->save()) {
                return true;
            }
        } else {
            /*
                * File was not moved
                */
            $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the uploaded folder.";
            return false;
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
            $product_object = array();
            $count_products = $stmt->rowCount();
            if($count_products > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $product_object[] = $row;
                }
            }
            return $product_object;
        }
    }
    
    public function find_product_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->schema.".".$this->table_name." "; 
        $query .= "WHERE id = :id LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('id'=>$id))){
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $category;
        }else{
            return false;
        }
    }

    public function find_products_by_category_id($category_id = 0)
    {
        $query = "SELECT "; 
        $query .= "categories.category, products.product_name, products.product_image, ";
        $query .= "products.product_details, products.product_price, products.product_status ";
        $query .= "FROM ".$this->table_name." ";
        $query .= "INNER JOIN categories ON products.category_id = categories.id ";
        $query .= "WHERE products.category_id = :category_id ";
        $query .= "ORDER BY products.id DESC";

        // prepare stmt
        $stmt = $this->conn->prepare($query);

        // htmlentites
        $category_id = htmlentities($category_id);

        // execute 
        if($stmt->execute(array('category_id'=>$category_id))){
            $product_object = array();
            $count_products = $stmt->rowCount();
            if($count_products > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $product_object[] = $row;
                }
            }
            return $product_object;
        }else{
            return false;
        }

    }
}