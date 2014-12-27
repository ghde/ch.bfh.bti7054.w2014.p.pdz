<?php

// Assign to the template
$smarty->assign('inner_template', 'product_overview');
$smarty->assign('inner_title', 'Garden');
$smarty->assign('inner_plants', $dbDao->getAllPlants(4));
