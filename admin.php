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
    $validation = array_key_exists("validation", $_SESSION) ? $_SESSION["validation"] : array();
} else {
    $admin = new User;
    $validation = array();
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
if (array_key_exists("action", $_POST) && array_key_exists("orderId", $_POST)) {

    // Read admin params
    $action = $_POST["action"];
    $orderId = intval($_POST["orderId"]);

    // Handle proceed order function
    if ("proceedOrder" == $action && array_key_exists("newStatus", $_POST)) {

        // Read new status
        $newStatus = intval($_POST["newStatus"]);

        // Read requested order and user
        $order = $dbDao->getOrder($orderId);
        $user = $dbDao->getCustomerByAccountName($order->getAccountName());

        // Decide whether to send a mail notification
        if ($newStatus == 2) {
            $order->sendPaymentMail($user);
        } else if ($newStatus == 4) {
            $order->sendDeliveryMail($user);
        }

        // Update order status
        $dbDao->setOrderStatus($orderId, $newStatus);

    }

    // Handle cancel order function
    if ("cancelOrder" == $action) {
        $dbDao->deleteOrder($orderId);
    }

    // Handle logout function
    if ("logout" == $action) {
        session_destroy();
    }

    // Force reload of admin UI to loose POST params.
    header("Location: " . $_SERVER["REQUEST_URI"]);
}

// Fetch orders & plants & accessories
$orders = $dbDao->getActiveOrders();
$plants = $dbDao->getAllPlants(null);
$accessories = $dbDao->getAllAccessories();

// Validate order address if not in session
$googleApiUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={address}&sensor=false";
foreach ($orders as $order) {

    // Check if address was previously validated (validation result stored in session).
    if (!array_key_exists($order->getId(), $validation)) {

        // Get address parts.
        $streetName = $order->getStreetName();
        $zipCode = $order->getZipCode();
        $city = $order->getCity();
        $country = $order->getCountry();

        // Url encode address and call googleapis.
        $addressToCheck = urlencode($streetName . ", " . $zipCode . ' ' . $city . ', ' . $country);
        $currentGoogleApiUrl = str_replace("{address}", $addressToCheck, $googleApiUrl);
        $jsonObject = json_decode(file_get_contents($currentGoogleApiUrl));
        if ($jsonObject && $jsonObject->status == "OK") {
            $result = $jsonObject->results[0];

            $gStreetNumber = null;
            $gStreetName = null;
            $gStreet = null;
            $gLocality = null;
            $gCountry = null;
            $gPostalCode = null;

            foreach ($result->address_components as $addressComponent) {
                if (in_array("street_number", $addressComponent->types)) {
                    $gStreetNumber = $addressComponent->long_name;
                } else if (in_array("route", $addressComponent->types)) {
                    $gStreetName = $addressComponent->long_name;
                } else if (in_array("locality", $addressComponent->types)) {
                    $gLocality = $addressComponent->long_name;
                } else if (in_array("country", $addressComponent->types)) {
                    $gCountry = $addressComponent->long_name;
                } else if (in_array("postal_code", $addressComponent->types)) {
                    $gPostalCode = $addressComponent->long_name;
                }
            }

            // Set formatted address
            $order->setFormattedAddress($result->formatted_address);
            $validation[$order->getId()] = $result->formatted_address;

            // Check validity of address
            if ($gStreetNumber != null && $gStreetName != null && $gLocality != null && $gCountry != null && $gPostalCode != null) {
                $gStreet = $gStreetName . " " . $gStreetNumber;
                if ($streetName == $gStreet && $zipCode == $gPostalCode && $city == $gLocality && $country == $gCountry) {
                    $order->setValidAddress(true);
                    $validation[$order->getId()] = "";
                }
            }
        }
    } else {

        // Address was already validated.
        $validatedAddress = $validation[$order->getId()];
        if ($validatedAddress == "") {

            // Address was valid
            $order->setValidAddress(true);

        } else {

            // Address was not valid
            $order->setValidAddress(false);
            $order->setFormattedAddress($validatedAddress);
        }
    }
}

// Assign common attributes
$smarty->assign('url', $_SERVER["REQUEST_URI"]);
$smarty->assign('admin', $admin);
$smarty->assign('language', $languageKeys);
$smarty->assign('plants', $plants);
$smarty->assign('accessories', $accessories);
$smarty->assign('orders', $orders);
$smarty->assign('status', array(
    1 => "new",
    2 => "confirmed",
    3 => "payed",
    4 => "delivered"
));

// Display root template
$smarty->display('admin.tpl');

// Update user objects and save
$admin->setFailedLoginTry(false);
$_SESSION["admin"] = $admin;

// Write and close session
$_SESSION["validation"] = $validation;
session_write_close();
