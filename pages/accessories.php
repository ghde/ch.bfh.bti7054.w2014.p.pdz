<?php
global $dbDao;

// Assign to the template
$smarty->assign('inner_template', 'accessory_overview');
$smarty->assign('inner_title', 'Accessories');
$smarty->assign('inner_accessories', $dbDao->getAllAccessories());
