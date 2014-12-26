<?php
// Error reporting
ini_set('error_reporting', E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/error-log.txt');
ini_set('display_errors', '0');

require_once 'php_classes/DBDao.class.php';
require_once 'php_classes/Product.class.php';
require_once 'php_functions/functions.php';

// Include database connection.
require_once '_mySql.php';

// Initialize PHP Session
session_start();

// Create instance of DBDao
$dbDao = new DBDao;

// Check & include language
$language = getLanguage();
$languageKeys = getLanguageKeys($language);
if (array_key_exists("q", $_REQUEST)) {
    $products = $dbDao->getSearchPreview($_REQUEST["q"]);
    //prepare html table for search preview
    $tableData = '';
    if (count($products) > 0) {
        foreach ($products as $product) {
            if ($product->getProductType() == 1){
                $page = "details";
            }
            else{
                $page = "accessoryDetails";
            }
            $link = "index.php?page=$page&Id={$product->getProductId()}";
            $tableData .= "
                <tr>
                    <td><a href=\"$link\">{$product->getProductTitle()}</a><p>{$product->getProductDescription()}</p></td>
                    <td>CHF {$product->getProductPrice()}</td>
                </tr>";
        }
    }
    else {
        $tableData = "<tr><td class=\"noResult\">{$languageKeys["SEARCH_NORESULT"]}</td></tr>";
    }
    echo "<table>$tableData</table>";
}
else if (array_key_exists("searchInput", $_GET)) {
    echo TODO;
}

// Write and close session
session_write_close();