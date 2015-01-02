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
require_once 'php_classes/CustomerAddress.class.php';
require_once 'php_classes/Accessory.class.php';
require_once 'php_classes/Order.class.php';
require_once 'php_classes/OrderPos.class.php';
require_once 'php_functions/functions.php';
require_once 'php_functions/authenticate.php';

// Include database connection.
require_once '_mySql.php';

// Initialize PHP Session
session_start();

// Create instance of DBDao
$dbDao = new DBDao;

// Check & include language
$language = "en";
$languageKeys = getLanguageKeys();

// Get or create user);
if (array_key_exists("admin", $_SESSION) && $_SESSION["admin"] instanceof User) {
    $admin = $_SESSION["admin"];
} else  {
    $admin = new User;
    $_SESSION["admin"] = $admin;
}

// Handle user login & logout
handleAdminLoginLogout();

// Load basic layout
$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = false;
//$smarty->cache_lifetime = 120;

// Handle admin requests
if (array_key_exists("proceedOrder", $_POST)
    || array_key_exists("orderId", $_POST)
    || array_key_exists("newStatus", $_POST)) {

    $orderId = intval($_POST["orderId"]);
    $newStatus = intval($_POST["newStatus"]);
    $order = $dbDao->getOrder($orderId);
    $user = $dbDao->getCustomerByAccountName($order->getAccountName());

    if ($newStatus == 2) {
        $order->sendPaymentMail($user);
    } else if ($newStatus == 4) {
        $order->sendDeliveryMail($user);
    }

    $dbDao->setOrderStatus($orderId, $newStatus);

    // Redirect user.
    header("Location: " . $_SERVER["REQUEST_URI"]);
}

// Fetch orders
$orders = $dbDao->getActiveOrders();

// Assign common attributes
$smarty->assign('url', $_SERVER["REQUEST_URI"]);
$smarty->assign('admin', $admin);
$smarty->assign('language', $languageKeys);
$smarty->assign('orders', $orders);

// Display root template
$smarty->display('admin.tpl');

// Update user objects and save
$admin->setFailedLoginTry(false);
$_SESSION["admin"] = $admin;

// Write and close session
session_write_close();
