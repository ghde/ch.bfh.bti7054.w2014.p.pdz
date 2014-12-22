<?php

// Get plant from session
$plant = $_SESSION["plant"];

// Add element to shopping cart
$shoppingCart->addItem($plant->getId(), $plant->getTitle(), 1);

// Close session
session_write_close();

// Redirect
header("Location: index.php?page=details&plantId=" . $plant->getId());