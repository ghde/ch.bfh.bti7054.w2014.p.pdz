<?php

if (isset($_GET['plantID'])) {

$current_plant_ID = $_GET['plantID'];

}


if (isset($_GET['plantName'])) {

    $plant_name = $_GET['plantName'];

}


$_SESSION['shoppingcart'][$current_plant_ID] = array('name'=>$plant_name, 'shipping'=>$_GET['shipping']);


// $current_plant_ID => expansion => ID of expansion


if (isset($_GET['remove_plant'])) {
    
    $remove = $_GET['remove_plant'];
    
    unset($_SESSION['shoppingcart'][$remove]);
    
}

function remove_plant() {



}


?>