<?php 

require_once('initialization.php');

// bring in categories migration
require_once(MIGRATION_PATH.DS.'categories.php');

// bring in products migration
require_once(MIGRATION_PATH.DS.'products.php');

// bring in customers
require_once(MIGRATION_PATH.DS.'customers.php');