<?php

// Error reporting
ini_set('error_reporting', E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/error-log.txt');
ini_set('display_errors', '0');

// Include functions and classes.
require_once 'php_classes/smarty/Smarty.class.php';
require_once 'php_classes/Product.class.php';
require_once 'php_classes/Plant.class.php';
require_once 'php_classes/PlantType.class.php';
require_once 'php_classes/ShoppingCart.class.php';
require_once 'php_classes/User.class.php';
require_once 'php_classes/DBDao.class.php';
require_once 'php_classes/Customer.class.php';
require_once 'php_classes/Accessory.class.php';
require_once 'php_functions/functions.php';
require_once 'php_functions/authenticate.php';

// Include database connection.
require_once '_mySql.php';

// Initialize PHP Session
session_start();

// Create instance of DBDao
$dbDao = new DBDao;

// Check & include language
$language = "de";
$languageKeys = getLanguageKeys();

// Get or create user
if (array_key_exists("admin", $_SESSION)) {
    $admin = $_SESSION["admin"];
} else  {
    $admin = new User;
    $_SESSION["admin"] = $admin;
}

// Handle user login & logout
handleAdminLoginLogout();

// Get or create shopping cart
if (array_key_exists("cart", $_SESSION)) {
    $shoppingCart = $_SESSION["cart"];
    $shoppingCartItems = $_SESSION["cart"]->getItems();
} else {
    $shoppingCart = new ShoppingCart;
    $shoppingCartItems = $shoppingCart->getItems();
    $_SESSION["cart"] = $shoppingCart;
}

// Load basic layout
$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = false;
//$smarty->cache_lifetime = 120;

// Assign common attributes
$smarty->assign('url', $_SERVER["REQUEST_URI"]);
$smarty->assign('admin', $admin);
$smarty->assign('language', $languageKeys);

// Display root template
$smarty->display('admin.tpl');

// Update user objects and save
$user->setFailedLoginTry(false);
$_SESSION["user"] = $user;

// Write and close session
session_write_close();
