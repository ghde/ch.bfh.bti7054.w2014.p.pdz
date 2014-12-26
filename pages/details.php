<?php
global $dbDao;

if (array_key_exists("Id", $_GET)) {
    //get plant by id
    $plant = $dbDao->getPlant($_GET["Id"]);
    $accessories = $dbDao->getAccessoriesByPlant($_GET["Id"]);
} else {
    $plant = null;
    $accessories = null;
}
// Add plant to session
$_SESSION["plant"] = $plant;
$_SESSION["accessories"] = $accessories;

// Assign to the template
$smarty->assign('inner_template', 'product_details');
$smarty->assign('inner_title', 'Order');
$smarty->assign('inner_product', $plant);
$smarty->assign('inner_accessories', $accessories);
