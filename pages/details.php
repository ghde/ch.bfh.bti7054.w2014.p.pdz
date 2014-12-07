<?php
global $dbDao;

if (array_key_exists("plantId", $_GET)) {
    //get plant by id
    $plant = $dbDao->getPlant($_GET["plantId"]);
    $accessories = $dbDao->getAccessoriesByPlant($_GET["plantId"]);
} else {
    $plant = null;
    $accessories = null;
}
// Add plant to session
$_SESSION["plant"] = $plant;

// Assign to the template
$smarty->assign('inner_template', 'product_details');
$smarty->assign('inner_title', 'Order');
$smarty->assign('inner_product', $plant);
$smarty->assign('inner_accessories', $accessories);
