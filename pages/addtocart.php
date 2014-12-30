<?php

if (array_key_exists("quantity", $_POST)) {
    $quantity = $_POST["quantity"];
}
if (!isset($quantity) || !is_numeric($quantity)){
    $quantity = 1;
}
//accessory or plant
if (array_key_exists("isAccessory", $_POST) && $_POST["isAccessory"] == 1){
    $accessory = $_SESSION["accessory"];
    $shoppingCart->addAccessory($accessory, $quantity);
    $page = "Location: index.php?page=accessoryDetails&Id=" . $accessory->getId();
}
else {
    // Get plant from session
    $plant = $_SESSION["plant"];
    $accessories = $_SESSION["accessories"];

    // Add plant to shopping cart
    $shoppingCart->addPlant($plant, $quantity);

    // Get selected accessories
    $accessoriesToAdd = array();
    foreach ($_POST as $postKey => $postValue) {
        $matches = array();
        if (preg_match("/^accessory\\_([0-9]+)$/", $postKey, $matches)) {
            if ($postValue == "on") {
                array_push($accessoriesToAdd, $matches[1]);
            }
        }
    }

    // Add accessories to shopping cart
    foreach ($accessories as $accessory) {
        if (in_array($accessory->getId(), $accessoriesToAdd)) {
            $shoppingCart->addAccessory($accessory, $quantity);
        }
    }
    $page = "Location: index.php?page=details&Id=" . $plant->getId();
}
// Close session
session_write_close();

// Redirect
header($page);