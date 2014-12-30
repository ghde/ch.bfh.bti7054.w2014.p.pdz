<?php

if (!array_key_exists("orderDetail", $_POST)) {
    // Assign to the template
    $smarty->assign('inner_template', 'order_details');
    $smarty->assign('inner_title', 'Order');
    $smarty->assign('inner_product', array());
}
else {
    // Assign to the template
    $smarty->assign('inner_template', 'order_confirm');
    $smarty->assign('inner_title', 'Order');
    $smarty->assign('inner_product', array());

    if (array_key_exists("order", $_POST)) {

        // TODO: save order!

        // Send order saved mail
        $shoppingCart->sendConfirmationOfReceipt();

        // Reset shopping cart.
        $shoppingCart = new ShoppingCart;
        $_SESSION["cart"] = $shoppingCart;

        // Show order saved
        $smarty->assign('isOrderSaved', true);

    } else {
        $smarty->assign('isOrderSaved', false);
    }
}