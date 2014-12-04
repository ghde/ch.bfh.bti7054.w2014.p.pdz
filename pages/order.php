<?php

// Assign to the template
$smarty->assign('inner_template', 'product_order');
$smarty->assign('inner_title', 'Order');
$smarty->assign('inner_product', array());

if (array_key_exists("order", $_POST)) {
    $shoppingCart = new ShoppingCart;
    $shoppingCartItems = $shoppingCart->getItems();
    $_SESSION["cart"] = $shoppingCart;
    $smarty->assign('isOrderSaved', true);
} else {
    $smarty->assign('isOrderSaved', false);
}