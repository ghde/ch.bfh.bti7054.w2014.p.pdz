<?php

// Get plant from session
$plant = $_SESSION["plant"];
$accessories = $_SESSION["accessories"];

// Add plant to shopping cart
$shoppingCart->addPlant($plant, 1);

// Get selected accessories
$accessoriesToAdd = array();
foreach ($_POST as $postKey=>$postValue) {
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
        $shoppingCart->addAccessory($accessory, 1);
    }
}

// Close session
session_write_close();

// Redirect
header("Location: index.php?page=details&plantId=" . $plant->getId());