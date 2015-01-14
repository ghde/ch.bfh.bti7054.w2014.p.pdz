<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simu
 * Date: 14.01.2015
 * Time: 20:35
 */



// Error reporting
ini_set('error_reporting', E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/error-log.txt');
ini_set('display_errors', '0');

// Include functions and classes.
require_once 'php_classes/Product.class.php';
require_once 'php_classes/Plant.class.php';
require_once 'php_classes/PlantTx.class.php';
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

// Create instance of DBDao
$dbDao = new DBDao;

// Initialize PHP Session
session_start();

// Check & include language
$language = getLanguage();

//CLAUDIO -> add plant like this

$plantType = $dbDao->getAllPlantType();
$plant = new Plant(0, 'asf', 'title', 'desc', 3, 4, 2, $plantType[0], 12.23);

$plantTx = array();
$plantTxDe = new PlantTx('de', 'pflanze', 'beschreibung');
$plantTxEn = new PlantTx('en', 'plant', 'desc');
array_push($plantTx, $plantTxDe);
array_push($plantTx, $plantTxEn);
$plant->setPlantTxArray($plantTx);

$dbDao->insertPlant($plant);
// Write and close session
session_write_close();