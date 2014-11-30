<?php

// Get plant from session
$plantID = $_POST["plantID"];

// Add element to shopping cart
$shoppingCart->removeItem($plantID);

// Close session
session_write_close();

// Redirect
header("Location: index.php?page=details&plantID=" . $plantID);