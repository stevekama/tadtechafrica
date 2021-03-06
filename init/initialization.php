<?php
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
// defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'app');
// defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'home2'.DS.'tadteica'.DS.'public_html');
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'app');
// defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'tadtechafrica');
defined('CONFIG_PATH') ? null : define('CONFIG_PATH', SITE_ROOT.DS.'config');
defined('INIT_PATH') ? null : define('INIT_PATH', SITE_ROOT.DS.'init');
defined('MODELS_PATH') ? null : define('MODELS_PATH', SITE_ROOT.DS.'models');
defined('VENDOR_PATH') ? null : define('VENDOR_PATH', SITE_ROOT.DS.'vendor');
defined('PUBLIC_PATH') ? null : define('PUBLIC_PATH', SITE_ROOT.DS.'public');
defined('MIGRATION_PATH') ? null : define('MIGRATION_PATH', SITE_ROOT.DS.'migrations');

// $site_url = "https://tadtechafrica.com/";
$site_url = "https://tadtechafrica.herokuapp.com/";
// $site_url = "http://localhost/tadtechafrica/";

// db connections
require_once(CONFIG_PATH.DS.'database.php');

// load sessions 
require_once(CONFIG_PATH.DS.'sessions.php');

// load all system functions
require_once(CONFIG_PATH.DS.'functions.php');

// app auth api
// require_once(CONFIG_PATH.DS.'auth.php');

// load mail()
require_once(VENDOR_PATH.DS.'autoload.php');

// load send mail
require_once(MODELS_PATH.DS.'categories.php');

// bring in customer type
require_once(MODELS_PATH.DS.'products.php');

// bring in customer type
require_once(MODELS_PATH.DS.'customers.php');

// bring in customer type
require_once(MODELS_PATH.DS.'cart.php');

// bring in wishlist
require_once(MODELS_PATH.DS.'wishlist.php');

// bring in customer orders
require_once(MODELS_PATH.DS.'customer_orders.php');

// bring in send mail
require_once(MODELS_PATH.DS.'send_mail.php');

// bring in sdelivery mode
require_once(MODELS_PATH.DS.'delivery_mode.php');

// bring in sdelivery mode
require_once(MODELS_PATH.DS.'order_deliveries.php');

// bring in cuatomer location
require_once(MODELS_PATH.DS.'customer_location.php');

// bring in product classification
require_once(MODELS_PATH.DS.'product_classification.php');

// bring in product promotion
require_once(MODELS_PATH.DS.'product_promotion.php');