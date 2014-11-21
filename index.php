<?php

// Error reporting
ini_set('error_reporting', E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/error-log.txt');
ini_set('display_errors', '0');

// Include functions and classes.
require_once 'php_classes/smarty/Smarty.class.php';
require_once 'php_functions/functions.php';

// Initialize PHP Session
session_start();

// Load basic layout
$smarty = new Smarty;
$smarty->debugging = true;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

$smarty->assign('language', array("OUR_PROMISE" => PROMISE));
$smarty->assign('languages', array("de" => "Deutsch", "en" => "English"));
$smarty->display('index.tpl');


// Write and close session
session_write_close();

