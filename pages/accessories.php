<?php
global $dbDao;

// Assign to the template
$smarty->assign('inner_template', 'accessory_overview');
$smarty->assign('inner_title', 'Accessories');print_r($dbDao->getAllAccessories());
$smarty->assign('inner_accessories', $dbDao->getAllAccessories());
