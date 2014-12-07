<?php
global $dbDao;

if (array_key_exists("accessoryId", $_GET)) {
    //get plant by id
    $accessory = $dbDao->getAccessory($_GET["accessoryId"]);
} else {
    $accessory = null;
}

// Assign to the template
$smarty->assign('inner_template', 'accessory_details');
$smarty->assign('inner_title', 'Order');
$smarty->assign('inner_accessory', $accessory);
