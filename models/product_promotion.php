<?php 

require_once(INIT_PATH.DS.'initialization.php');

class Product_Promotion{

    private $conn;

    // table name and schema 
    private $table_name = "product_promotion";

    // table properties
    public $id;
    public $classification_id;
    public $category_id;
    public $product_id;
    public $product_name;
    public $banner_image;
    public $product_price;
    public $created_date;
    public $edited_date;

    // connect to db
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    // Save 
    public function save()
    {
        $query = "";
        if(empty($this->id)){
            $query .= "INSERT INTO ".$this->table_name."(";
            $query .= "classification_id, category_id, "; 
            $query .= "product_id, product_name, banner_image, product_price, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":classification_id, :category_id, "; 
            $query .= ":product_id, :product_name, :banner_image, :product_price, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";
        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "classification_id = :classification_id, category_id = :category_id, "; 
            $query .= "product_id = :product_id, product_name = :product_name, banner_image = :banner_image, product_price = :product_price, ";
            $query .= "created_date = :created_date, edited_date = :edited_date ";
            $query .= "WHERE id = :id";
        }

        $stmt = $this->conn->prepare($query);

        // clean up data
        if (!empty($this->id)) {
            $this->id = htmlentities($this->id);
        }
        
        $this->classification_id = htmlentities($this->classification_id);
        $this->category_id = htmlentities($this->category_id);
        $this->product_id = htmlentities($this->product_id);
        $this->product_name = htmlentities($this->product_name);
        $this->banner_image = htmlentities($this->banner_image);
        $this->product_price = htmlentities($this->product_price);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        // bindParam
        if (!empty($this->id)) {
            $stmt->bindParam(':id', $this->id);
        }
        
        $stmt->bindParam(':classification_id', $this->classification_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':banner_image', $this->banner_image);
        $stmt->bindParam(':product_price', $this->product_price);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        // execute 
        if($stmt->execute()){
            if(empty($this->id)){
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        }
    }

    // save with banner image
    private $temp_path;

    protected $upload_dir = "banner";

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
            $this->banner_image = basename(time() . $file['name']);
            //Dont worry about the databaseyet
            return true;
        }
    }

    // save banner
    public function save_banner()
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
        if (empty($this->banner_image) || empty($this->temp_path)) {
            $this->errors[] = "The file location was not available.";
            return false;
        }

        // 3. Determine the target_path
        $target_path = PUBLIC_PATH . DS . 'storage' . DS . $this->upload_dir . DS . $this->banner_image;

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


    // find all 
    public function find_all()
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            $product_promotion_obj = array();
            // loop throught 
            $count = $stmt->rowCount();
            if($count > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $product_promotion_obj[] = $row;
                }
            }
            return $product_promotion_obj;
        }
    }

    // find by id
    public function find_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE id=:id LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $id = htmlentities($id);

        if($stmt->execute(array("id"=>$id))){
            $promotion = $stmt->fetch(PDO::FETCH_ASSOC);
            return $promotion;
        }
    }

    // delete
    public function delete($id=0)
    {
        $query = "DELETE FROM ".$this->table_name." WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $id = htmlentities($id);

        if($stmt->execute(array("id"=>$id))){
            return true;
        }
    }
}