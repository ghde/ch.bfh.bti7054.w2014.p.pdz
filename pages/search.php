<?php
global $dbDao;

if (array_key_exists("searchInput", $_GET) && !empty($_GET["searchInput"])) {
    $results = $dbDao->getSearchPreviewExt($_GET["searchInput"]);
}
else {
    $results = null;
}
// Assign to the template
$smarty->assign('inner_template', 'search_result');
$smarty->assign('inner_title', 'Search Results');
$smarty->assign('inner_results', $results);