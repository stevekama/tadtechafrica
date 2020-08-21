<?php 

require_once('initialization.php');

// bring in categories migration
require_once(MIGRATION_PATH.DS.'categories.php');

// bring in products migration
require_once(MIGRATION_PATH.DS.'products.php');

// bring in customers
require_once(MIGRATION_PATH.DS.'customers.php');

// bring in cart
require_once(MIGRATION_PATH.DS.'cart.php');

// bring in cart
require_once(MIGRATION_PATH.DS.'wishlist.php');

// bring in orders
require_once(MIGRATION_PATH.DS.'customer_orders.php');

// bring in mail
require_once(MIGRATION_PATH.DS.'mail.php');

// bring in delivery mode 
require_once(MIGRATION_PATH.DS.'delivery_mode.php');

// bring in delivery mode 
require_once(MIGRATION_PATH.DS.'order_delivery.php');

// bring in delivery mode 
require_once(MIGRATION_PATH.DS.'customer_location.php');

// bring in delivery mode 
require_once(MIGRATION_PATH.DS.'product_classifications.php');

// bring in delivery mode 
require_once(MIGRATION_PATH.DS.'product_promotion.php');