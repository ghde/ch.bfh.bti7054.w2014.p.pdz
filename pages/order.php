<?php
global $dbDao, $user;
if ($shoppingCart->isEmpty()) {
    header("Location: index.php?page=home");
}
else if ((!array_key_exists("orderDetail", $_POST) && !array_key_exists("order", $_POST)) || !isset($user) || !$user->isLoggedIn() ) {
    // Assign to the template
    $smarty->assign('inner_template', 'order_details');
    $smarty->assign('inner_title', 'Order');
    $smarty->assign('inner_products', array_merge($shoppingCart->getPlants(), $shoppingCart->getAccessories()));
    $smarty->assign('inner_totalPrice', $shoppingCart->getTotalPrice());
}
else {
    // Assign to the template
    $smarty->assign('inner_template', 'order_confirm');
    $smarty->assign('inner_title', 'Order');

    //check required data for save
    if (array_key_exists("order", $_POST)
        && array_key_exists("streetName", $_POST)
        && array_key_exists("zipCode", $_POST)
        && array_key_exists("city", $_POST)
        && array_key_exists("country", $_POST)
        && array_key_exists("expressDelivery", $_POST)) {

        //check save address
        if (array_key_exists("saveAddress", $_POST)) {
            $customerAddress = new CustomerAddress();
            $customerAddress->setAccountName($user->getUsername());
            $customerAddress->setStreetName($_POST["streetName"]);
            $customerAddress->setZipCode($_POST["zipCode"]);
            $customerAddress->setCity($_POST["city"]);
            $customerAddress->setCountry($_POST["country"]);

            $dbDao->updateCustomerAddress($customerAddress);
        }

        //prepare order
        $order = new Order();
        $order->setAccountName($user->getUsername());
        $order->setStreetName($_POST["streetName"]);
        $order->setZipCode($_POST["zipCode"]);
        $order->setCity($_POST["city"]);
        $order->setCountry($_POST["country"]);
        $order->setExpressDelivery($_POST["expressDelivery"]);

        $orderPosArray = array();
        foreach (array_merge($shoppingCart->getPlants(), $shoppingCart->getAccessories()) as $productData) {
            $orderPos = new OrderPos();
            $product = $productData["product"];
            if ($product->getProductType() === 1) {
                $orderPos->setPlantId($product->getId());
            }
            else {
                $orderPos->setAccessoryId($product->getId());
            }
            $orderPos->setUnitPrice($product->getPrice());
            $orderPos->setQuantity($productData["quantity"]);
            array_push($orderPosArray, $orderPos);
        }
        $order->setOrderPosArray($orderPosArray);

        //save order with order pos
        $dbDao->insertOrder($order);

        // Send order saved mail
        $shoppingCart->sendConfirmationOfReceipt();

        // Reset shopping cart.
        $shoppingCart = new ShoppingCart;
        $_SESSION["cart"] = $shoppingCart;

        // Show order saved
        $smarty->assign('isOrderSaved', true);

    }
    else {
        $smarty->assign('inner_address', $dbDao->getCustomerAddress($user->getUsername()));
        $smarty->assign('isOrderSaved', false);
    }
}