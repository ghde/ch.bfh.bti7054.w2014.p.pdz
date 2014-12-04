<?php

// Error reporting
ini_set('error_reporting', E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/error-log.txt');
ini_set('display_errors', '0');

// Include functions and classes.
require_once 'php_classes/smarty/Smarty.class.php';
require_once 'php_classes/Plant.class.php';
require_once 'php_classes/ShoppingCart.class.php';
require_once 'php_classes/User.class.php';
require_once 'php_functions/functions.php';
require_once 'php_functions/authenticate.php';

// Initialize PHP Session
session_start();

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
    $shoppingCartItems = $_SESSION["cart"]->getItems();
} else {
    $shoppingCart = new ShoppingCart;
    $shoppingCartItems = $shoppingCart->getItems();
    $_SESSION["cart"] = $shoppingCart;
}

// Check & include language
$language = getLanguage();
if ($language) {
    require_once "language/$language.php";
}

// Load basic layout
$smarty = new Smarty;
$smarty->debugging = true;
$smarty->caching = false;
//$smarty->cache_lifetime = 120;

// Check page attribute
if (isset($_GET["page"]) && preg_match("/^([a-z])+$/", $_GET["page"]))
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
$smarty->assign('cart_items', $shoppingCartItems);
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