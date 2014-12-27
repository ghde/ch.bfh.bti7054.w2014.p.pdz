<?php

// Error reporting
ini_set('error_reporting', E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/error-log.txt');
ini_set('display_errors', '0');

// Include functions and classes.
require_once 'php_classes/smarty/Smarty.class.php';
require_once 'php_classes/Plant.class.php';
require_once 'php_classes/PlantType.class.php';
require_once 'php_classes/ShoppingCart.class.php';
require_once 'php_classes/User.class.php';
require_once 'php_classes/DBDao.class.php';
require_once 'php_classes/Customer.class.php';
require_once 'php_classes/Accessory.class.php';
require_once 'php_classes/Product.class.php';
require_once 'php_functions/functions.php';
require_once 'php_functions/authenticate.php';

// Include database connection.
require_once '_mySql.php';

// Initialize PHP Session
session_start();

// Create instance of DBDao
$dbDao = new DBDao;

// Check & include language
$language = getLanguage();
$languageKeys = getLanguageKeys($language);

// Get or create user
if (array_key_exists("user", $_SESSION)) {
    $user = $_SESSION["user"];
} else  {
    $user = new User;
    $_SESSION["user"] = $user;
}

// Handle user login & logout
handleLoginLogout();

// Get or create shopping cart
if (array_key_exists("cart", $_SESSION)) {
    $shoppingCart = $_SESSION["cart"];
} else {
    $shoppingCart = new ShoppingCart;
    $_SESSION["cart"] = $shoppingCart;
}

// Load basic layout
$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = false;
//$smarty->cache_lifetime = 120;
// Check page attribute
if (isset($_GET["page"]) && preg_match("/^([a-z])+([A-Z])?([a-z])+$/", $_GET["page"]))
{
    $pagePath = "pages/" . $_GET["page"] . ".php";
    if (file_exists($pagePath)) {
        require_once "$pagePath";
    }
    else {
        header("Location: index.php?page=home");
    }
} else {
    header("Location: index.php?page=home");
}
// Assign common attributes
$smarty->assign('url', $_SERVER["REQUEST_URI"]);
$smarty->assign('user', $user);
$smarty->assign('cart', $shoppingCart);
$smarty->assign('languages', getAvailableLanguages());
$smarty->assign('language', $languageKeys);
$smarty->assign('navigation', getNavigationElements());

// Display root template
$smarty->display('index.tpl');

// Update user objects and save
$user->setFailedLoginTry(false);
$_SESSION["user"] = $user;

// Write and close session
session_write_close();
