<?php
class Session {

    private $logged_in = false;

    private $is_admin = false;

    private $is_user = false;

    public $user_id;

    public $user_type;
    
    public $admin_id;

    private $with_cart_items = false;

    public $cart_items;

    function __construct(){
        session_start();
        $this->check_login();
        if($this->logged_in) {
            //action to take right away if user is loggedin
            return true;
        }else{
            //action to take right away if user is not loggedin
            return false;
        }
        $this->check_cart_items();
    }

    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->user_type = $_SESSION['user_type'];
            $this->logged_in = true;
            // set user 
            $this->is_user = true;
            // remove admin 
            $this->is_admin = false;
        }elseif(isset($_SESSION['admin_id'])){
            $this->admin_id = $_SESSION['admin_id'];
            $this->logged_in = true;
            //set admin 
            $this->is_admin = true;
            //remove user
            $this->is_user = false;
        }else{
            unset($this->user_id);
            unset($this->user_type);
            unset($this->admin_id);
            $this->logged_in = false;
            $this->is_admin = false;
            $this->is_user = false;
        }
    }

    // check if cart item isset
    private function check_cart_items()
    {
        if(isset($_SESSION['cart_items'])){
            $this->cart_items = $_SESSION['cart_items'];
            $this->with_cart_items = true;
        }else{
            unset($this->cart_items);
            unset($_SESSION['cart_items']);
            $this->with_cart_items = false;
        }
    }

    // return  cart items status
    public function has_cart_items()
    {
        return $this->with_cart_items;
    }

    // set cart items 
    public function set_cart_items($status)
    {
        $this->cart_items = $_SESSION['cart_items'] = $status;
        $this->with_cart_items = true;
    }

    public function is_logged_in(){
        return $this->logged_in;
    }

    public function check_admin()
    {
        return $this->is_admin;
    }

    public function check_user()
    {
        return $this->is_user;
    }

    public function login($user, $type){
        //database should based fon username/password
        if($user){
            // unset admin 
            unset($_SESSION['admin_id']);
            unset($this->admin_id);
            $this->is_admin = false;
            // set user id 
            $this->user_id = $_SESSION['user_id'] = $user['id'];
            $this->user_type = $_SESSION['user_type'] = $type;
            $this->logged_in = true;
            $this->is_user = true;
        }
    }

    public function admin_login($admin)
    {
        if($admin){
            // unset sesion user id
            unset($_SESSION['user_id']);
            unset($_SESSION['user_type']);
            unset($this->user_id);
            unset($this->user_type);
            $this->is_user = false;
            // set admin id
            $this->admin_id = $_SESSION['admin_id'] = $admin['id'];
            $this->logged_in = true;
            $this->is_admin = true;
            
        }
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_type']);
        unset($_SESSION['admin_id']);
        unset($this->user_id);
        unset($this->user_type);
        unset($this->admin_id);
        $this->logged_in = false;
        $this->is_admin = false;
        $this->is_user = false;
        session_destroy();
    }
    
}

$session = new Session();
?>
