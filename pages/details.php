<?php

// Create instance of plant
$plant = new Plant(3, "Plant 3", "plant3.jpg", "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
            dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
            clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.");

// Add plant to session
$_SESSION["plant"] = $plant;

// Assign to the template
$smarty->assign('inner_template', 'product_details');
$smarty->assign('inner_title', 'Order');
$smarty->assign('inner_product', $plant);
