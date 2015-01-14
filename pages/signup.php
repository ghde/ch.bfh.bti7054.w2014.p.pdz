<?php
global $dbDao, $user;

if ($user->isLoggedIn()) {
    header("Location: index.php?page=home");
}
else if (!array_key_exists("userSignUp", $_POST)) {
    // Assign to the template
    $smarty->assign('inner_template', 'signup');
}
else {
    //check required data for save
    if (array_key_exists("firstName", $_POST)
        && array_key_exists("lastName", $_POST)
        && array_key_exists("email", $_POST)
        && array_key_exists("gender", $_POST)
        && array_key_exists("company", $_POST)
        && array_key_exists("password", $_POST)
        && array_key_exists("passwordConfirm", $_POST)
        && array_key_exists("streetName", $_POST)
        && array_key_exists("zipCode", $_POST)
        && array_key_exists("city", $_POST)
        && array_key_exists("country", $_POST)
        && $_POST["password"] === $_POST["passwordConfirm"]) {

        $patternPW = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}/';
        $patternEmail = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/';
        if (preg_match($patternPW, $_POST["password"]) === 1
            && preg_match($patternEmail, $_POST["email"]) === 1) {

            //save customer and customer address
            $customer = new Customer();
            $customer->setFirstName($_POST["firstName"]);
            $customer->setLastName($_POST["lastName"]);
            $customer->setAccountName($_POST["email"]);
            $customer->setGender($_POST["gender"]);
            $customer->setCompany($_POST["company"]);
            $customer->setPassword($_POST["password"]);

            $customerAddress = new CustomerAddress();
            $customerAddress->setAccountName($customer->getAccountName());
            $customerAddress->setStreetName($_POST["streetName"]);
            $customerAddress->setZipCode($_POST["zipCode"]);
            $customerAddress->setCity($_POST["city"]);
            $customerAddress->setCountry($_POST["country"]);

            //save address with customer (same transaction)
            $customer->setCustomerAddress($customerAddress);
            $dbDao->insertCustomer($customer);

            header("Location: index.php?page=home");
        }
    }
}