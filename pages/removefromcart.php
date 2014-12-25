<?php

// Get plant from session
if (array_key_exists("plantId", $_POST)) {

    $plantId = intval($_POST["plantId"]);
    $shoppingCart->removePlant($plantId);

    // Write and close session
    session_write_close();

    // Redirect to plant details
    header("Location: index.php?page=details&plantId=" . $plantId);

} else if (array_key_exists("accessoryId", $_POST)) {

    $accessoryId = intval($_POST["accessoryId"]);
    $shoppingCart->removeAccessory($accessoryId);

    // Write and close session
    session_write_close();

    // Redirect to plant details
    header("Location: index.php?page=accessory&accessoryId=" . $accessoryId);
}