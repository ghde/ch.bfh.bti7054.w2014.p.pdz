<?php

/**
 * Created by IntelliJ IDEA.
 * User: Claudio
 * Date: 05.12.14
 * Time: 10:43
 */
class DBDao
{

    //region plant
    /**
     * @return array
     */
    function getAllPlantType()
    {
        global $language;
        $dbConnection = getDBConnection();
            $dbQuery = "
                    SELECT
                        plantTypeId,
                        plantTypeTitle,
                        plantTypeDescription
                    FROM plantTypeTx
                    WHERE
                      language = '$language'";

            $plantTypes = array();
            if ($dbRes = $dbConnection->query($dbQuery)) {
                while ($row = $dbRes->fetch_object()) {
                    // Create plant type and plant
                    $plantType = new PlantType($row->plantTypeId,
                        $row->plantTypeTitle,
                        $row->plantTypeDescription);
                    array_push($plantTypes, $plantType);
                }
                // free result set
                $dbRes->close();
            }
            return $plantTypes;
    }
    /**
     * @return string
     */
    private function getPlantSelectQuery()
    {
        global $language;

        $dbQuery = "
            SELECT
                plant.plantId,
                plant.plantTypeId,
                price,
                pouringFrequency,
                sunlight,
                difficulty,
                pictureName,
                plantTx.plantTitle,
                plantTx.plantDescription,
                plantTypeTx.plantTypeTitle,
                plantTypeTx.plantTypeDescription
            FROM plant
            INNER JOIN plantTx
              ON plant.plantId = plantTx.plantId AND plantTx.language = '$language'
            INNER JOIN plantTypeTx
              ON plant.plantTypeId = plantTypeTx.plantTypeId AND plantTypeTx.language = '$language'";

        return $dbQuery;
    }

    /**
     * @param $plantId
     * @return Plant
     */
    function getPlant($plantId)
    {
        $dbConnection = getDBConnection();

        if (empty($plantId)) {
            return null;
        }
        $dbQuery = $this->getPlantSelectQuery() . "WHERE plant.plantId = '$plantId'";

        if ($result = $dbConnection->query($dbQuery)) {
            // fetch plant
            $row = $result->fetch_object();
            // Create plant type and plant
            $plantType = new PlantType($row->plantTypeId,
                $row->plantTypeTitle,
                $row->plantTypeDescription);
            $plant = new Plant($row->plantId,
                $row->pictureName,
                $row->plantTitle,
                $row->plantDescription,
                $row->pouringFrequency,
                $row->sunlight,
                $row->difficulty,
                $plantType,
                $row->price);
            // free result set
            $result->close();
        }
        return $plant;
    }

    /**
     * @param $plantTypeId
     * @return array of plants.
     */
    function getAllPlants($plantTypeId)
    {
        $dbConnection = getDBConnection();

        $plants = array();
        $dbQuery = $this->getPlantSelectQuery();
        if (isset($plantTypeId)) {
            $dbQuery .= "AND plantTypeTx.plantTypeId = '$plantTypeId'";
        }
        $dbQuery .= 'ORDER by plant.plantId';
        if ($dbRes = $dbConnection->query($dbQuery)) {
            while ($row = $dbRes->fetch_object()) {
                // Create plant type and plant
                $plantType = new PlantType($row->plantTypeId,
                    $row->plantTypeTitle,
                    $row->plantTypeDescription);
                $plant = new Plant($row->plantId,
                    $row->pictureName,
                    $row->plantTitle,
                    $row->plantDescription,
                    $row->pouringFrequency,
                    $row->sunlight,
                    $row->difficulty,
                    $plantType,
                    $row->price);

                array_push($plants, $plant);
            }
            $dbRes->close();
        }
        return $plants;
    }

    /**
     * @param $plant
     */
    function insertPlant($plant) {
        $dbConnection = getDBConnection();

        if (isset($plant) && $plant instanceof Plant) {
            $plantTxArray = $plant->getPlantTxArray();
            if (!empty($plantTxArray)) {
                //set autocommit off
                $dbConnection->autocommit(FALSE);
                $dbQuery = "
                  INSERT INTO `plant`
                  (
                      price,
                      pouringFrequency,
                      sunlight,
                      difficulty,
                      pictureName,
                      plantTypeId
                  )
                  VALUES
                  (
                    '{$plant->getPrice()}',
                    '{$plant->getPouringFrequency()}',
                    '{$plant->getSunlight()}',
                    '{$plant->getDifficulty()}',
                    '{$plant->getPictureName()}',
                    '{$plant->getPlantType()->getId()}'
                  )";
                if ($dbConnection->query($dbQuery) === TRUE) {
                    //success
                    $plant->setId($dbConnection->insert_id);
                    //prepare statement
                    $plantId = $plant->getId();
                    $language = null;
                    $title = null;
                    $description = null;
                    $stmt = $dbConnection->prepare("
                        INSERT INTO `plantTx`
                        (
                            plantId,
                            language,
                            plantTitle,
                            plantDescription
                        )
                        VALUES(?,?,?,?)");
                    //bind variables --> set in foreach
                    $stmt->bind_param('isss', $plantId, $language, $title, $description);
                    foreach($plantTxArray as $plantTx) {
                        $language = $plantTx->getLanguage();
                        $title = $plantTx->getTitle();
                        $description = $plantTx->getDescription();
                        if ($stmt->execute() === TRUE) {
                            //success
                        }
                        else {
                            echo($dbConnection->error);
                            $dbConnection->rollback();
                            $dbConnection->close();
                            return;
                        }
                    }
                    $dbConnection->commit();
                }
                else {
                    echo($dbConnection->error);
                }
                $dbConnection->close();
            }
        }
    }

    //endregion plant

    //region accessory
    /**
     * @param $plantId
     * @return string
     */
    private function getAccessorySelectQuery($plantId)
    {
        global $language;

        $dbQuery = "
        SELECT
            a.accessoryId AS id,
            a.pictureName,
            a.price,
            aTx.accessoryTitle AS title,
            aTx.accessoryDescription AS description
        FROM accessory a";

        if (!empty($plantId)) {
            $dbQuery .= " INNER JOIN plant_accessory pa ON pa.accessoryId = a.accessoryId AND pa.plantId = '$plantId'";
        }
        $dbQuery .= " INNER JOIN accessoryTx aTx ON aTx.accessoryId = a.accessoryId AND aTx.language = '$language'";

        return $dbQuery;
    }

    /**
     * @param $plantId
     * @return array of accessories
     */
    function getAccessoriesByPlant($plantId)
    {
        $dbConnection = getDBConnection();

        if (empty($plantId)) {
            return null;
        }

        $accessories = array();
        $dbQuery = $this->getAccessorySelectQuery($plantId);

        if ($dbRes = $dbConnection->query($dbQuery)) {
            while ($accessory = $dbRes->fetch_object("Accessory")) {
                array_push($accessories, $accessory);
            }
            // free result set
            $dbRes->close();
        }
        return $accessories;
    }

    /**
     * @return array of accessories
     */
    function getAllAccessories()
    {
        $dbConnection = getDBConnection();

        $accessories = array();
        $dbQuery = $this->getAccessorySelectQuery(null);
        if ($dbRes = $dbConnection->query($dbQuery)) {
            while ($accessory = $dbRes->fetch_object("Accessory")) {
                array_push($accessories, $accessory);
            }
            // free result set
            $dbRes->close();
        }
        return $accessories;
    }

    /**
     * @param $accessoryId
     * @return array of accessories
     */
    function getAccessory($accessoryId)
    {
        $dbConnection = getDBConnection();

        $dbQuery = $this->getAccessorySelectQuery(null);
        $dbQuery .= "WHERE a.accessoryId = '$accessoryId'";
        if ($dbRes = $dbConnection->query($dbQuery)) {
            $accessory = $dbRes->fetch_object("Accessory");
            // free result set
            $dbRes->close();
        }
        return $accessory;
    }
    //endregion accessory

    //region order
    function getOrder($orderId)
    {
        $dbConnection = getDBConnection();

        $orderRes = $dbConnection->query("SELECT * FROM `order` WHERE orderId = $orderId");
        $order = $orderRes->fetch_object('Order');

        $orderPosArr = array();
        $orderPosRes = $dbConnection->query("SELECT * FROM orderPos WHERE orderId = '{$order->getId()}' ORDER BY orderPosId");
        while ($orderPos = $orderPosRes->fetch_object('OrderPos')) {
            if ($orderPos->getPlantId() != null) {
                $orderPos->setPlant($this->getPlant($orderPos->getPlantId()));
            } else if ($orderPos->getAccessoryId() != null) {
                $orderPos->setAccessory($this->getAccessory($orderPos->getAccessoryId()));
            }
            array_push($orderPosArr, $orderPos);
        }
        $order->setOrderPosArray($orderPosArr);
        return $order;
    }

    function deleteOrder($orderId)
    {
        $dbConnection = getDBConnection();

        $deleteOrderPosQuery = "DELETE FROM orderPos WHERE orderId = $orderId";
        $deleteOrderQuery = "DELETE FROM `order` WHERE orderId = $orderId";

        $dbConnection->autocommit(FALSE);
        if ($dbConnection->query($deleteOrderPosQuery) === TRUE) {
            if ($dbConnection->query($deleteOrderQuery) === TRUE) {
                $dbConnection->commit();
            } else {
                echo($dbConnection->error);
                $dbConnection->rollback();
            }
        }
        $dbConnection->close();
    }

    function setOrderStatus($orderId, $newStatus)
    {
        getDBConnection()->query("UPDATE `order` SET `status` = $newStatus WHERE orderId = $orderId");
    }

    function getActiveOrders()
    {
        $dbConnection = getDBConnection();

        $orderArr = array();
        $orderRes = $dbConnection->query("SELECT * FROM `order` WHERE `status` < 4 ORDER BY status ASC, orderId ASC");
        while ($order = $orderRes->fetch_object('Order')) {
            $orderPosArr = array();
            $orderPosRes = $dbConnection->query("SELECT * FROM orderPos WHERE orderId = '{$order->getId()}' ORDER BY orderPosId");
            while ($orderPos = $orderPosRes->fetch_object('OrderPos')) {
                if ($orderPos->getPlantId() != null) {
                    $orderPos->setPlant($this->getPlant($orderPos->getPlantId()));
                } else if ($orderPos->getAccessoryId() != null) {
                    $orderPos->setAccessory($this->getAccessory($orderPos->getAccessoryId()));
                }
                array_push($orderPosArr, $orderPos);
            }
            $order->setOrderPosArray($orderPosArr);
            array_push($orderArr, $order);
        }
        return $orderArr;
    }

    /**
     * @param $order
     */
    function insertOrder($order)
    {
        $dbConnection = getDBConnection();

        if (isset($order) && $order instanceof Order) {
            $orderPosArray = $order->getOrderPosArray();
            if (!empty($orderPosArray)) {
                //set autocommit off
                $dbConnection->autocommit(FALSE);
                $dbQuery = "
                  INSERT INTO `order`
                  (
                    accountName,
                    streetName,
                    zipCode,
                    city,
                    country,
                    expressDelivery
                  )
                  VALUES
                  (
                    '{$order->getAccountName()}',
                    '{$order->getStreetName()}',
                    '{$order->getZipCode()}',
                    '{$order->getCity()}',
                    '{$order->getCountry()}',
                    '{$order->getExpressDelivery()}'
                  )";

                if ($dbConnection->query($dbQuery) === TRUE) {
                    //success
                    $order->setId($dbConnection->insert_id);
                    //prepare statement
                    $orderId = $order->getId();
                    $orderPlantId = null;
                    $accessoryId = null;
                    $quantity = null;
                    $unitPrice = null;
                    $stmt = $dbConnection->prepare("
                        INSERT INTO `orderPos`
                        (
                            orderId,
                            plantId,
                            accessoryId,
                            quantity,
                            unitPrice
                        )
                        VALUES(?,?,?,?,?)");
                    //bind variables --> set in foreach
                    $stmt->bind_param('iiiid', $orderId, $orderPlantId, $accessoryId, $quantity, $unitPrice);
                    foreach ($orderPosArray as $orderPos) {
                        $orderPlantId = $orderPos->getPlantId();
                        $accessoryId = $orderPos->getAccessoryId();
                        $quantity = $orderPos->getQuantity();
                        $unitPrice = $orderPos->getUnitPrice();
                        if ($stmt->execute() === TRUE) {
                            //success
                            $orderPos->setId($dbConnection->insert_id);
                        } else {
                            echo($dbConnection->error);
                            $dbConnection->rollback();
                            $dbConnection->close();
                            return;
                        }
                    }
                    $dbConnection->commit();
                } else {
                    echo($dbConnection->error);
                }
                $dbConnection->close();
            }
        }
    }
    //endregion order

    //region config
    /**
     * @return array of language keys.
     */
    function getLanguageKeys()
    {
        global $language;
        $dbConnection = getDBConnection();

        $langKeys = array();
        $dbQuery = "select messageKey, message from messages where language = '$language'";
        $dbRes = $dbConnection->query($dbQuery);
        while ($row = $dbRes->fetch_object()) {
            $langKeys[$row->messageKey] = $row->message;
        }
        return $langKeys;
    }
    //endregion config

    //region customer
    /**
     * @param $accountName
     * @param $password
     * @return customer.
     */
    function getCustomer($accountName, $password)
    {
        $dbConnection = getDBConnection();

        $customer = null;

        if ($accountName !== '' && $password !== '') {
            //real_escape_string --> else sql code can be injected (password like 'or'1'='1 will work...)
            $accountName = $dbConnection->real_escape_string($accountName);
            $password = $dbConnection->real_escape_string($password);
            $dbQuery = "
              SELECT
                c.accountName,
                c.firstName,
                c.lastName,
                c.gender,
                c.company
              FROM customer c
              WHERE
                c.accountName = '$accountName'
                AND c.accountPassword = '$password';";

            if ($result = $dbConnection->query($dbQuery)) {
                // fetch customer
                $customer = $result->fetch_object("Customer");
                // free result set
                $result->close();
            }
        }
        return $customer;
    }

    /**
     * @param $accountName
     * @return null|object|stdClass
     */
    function getCustomerByAccountName($accountName)
    {
        $dbConnection = getDBConnection();

        $customer = null;
        $accountName = $dbConnection->real_escape_string($accountName);
        $dbQuery = "
          SELECT
            c.accountName,
            c.firstName,
            c.lastName,
            c.gender,
            c.company
          FROM customer c
          WHERE
            c.accountName = '$accountName';";

        if ($result = $dbConnection->query($dbQuery)) {
            // fetch customer
            $customer = $result->fetch_object("Customer");
            // free result set
            $result->close();
        }
        return $customer;
    }

    /**
     * inserts a new customer with a new customer address
     * @param $customer customer with customer address
     */
    function insertCustomer($customer)
    {
        $dbConnection = getDBConnection();

        if (isset($customer) && $customer instanceof Customer) {
            $customerAddress = $customer->getCustomerAddress();
            if (isset($customerAddress) && $customerAddress instanceof CustomerAddress) {
                //set autocommit off
                $dbConnection->autocommit(FALSE);

                //insert customer
                $dbQuery = "
                  INSERT INTO `customer`
                  (
                      accountName,
                      accountPassword,
                      firstName,
                      lastName,
                      gender,
                      company
                  )
                  VALUES
                  (
                    '{$customer->getAccountName()}',
                    '{$customer->getPassword()}',
                    '{$customer->getFirstName()}',
                    '{$customer->getLastName()}',
                    '{$customer->getGender()}',
                    '{$customer->getCompany()}'
                  )";

                if ($dbConnection->query($dbQuery) === TRUE) {
                    //insert customer address
                    $dbQuery = "
                      INSERT INTO `customerAddress`
                      (
                          accountName,
                          streetName,
                          zipCode,
                          city,
                          country
                      )
                      VALUES
                      (
                        '{$customerAddress->getAccountName()}',
                        '{$customerAddress->getStreetName()}',
                        '{$customerAddress->getZipCode()}',
                        '{$customerAddress->getCity()}',
                        '{$customerAddress->getCountry()}'
                      )";

                    if ($dbConnection->query($dbQuery) === TRUE) {
                        $dbConnection->commit();
                    } else {
                        echo($dbConnection->error);
                        $dbConnection->rollback();
                    }
                } else {
                    echo($dbConnection->error);
                }
                $dbConnection->close();
            }
        }
    }

    /**
     * @param $accountName
     * @return null|object|stdClass
     */
    function getCustomerAddress($accountName)
    {
        $dbConnection = getDBConnection();

        $customerAddress = null;

        if ($accountName !== '') {
            //real_escape_string --> else sql code can be injected
            $accountName = $dbConnection->real_escape_string($accountName);
            $dbQuery = "
              SELECT
                a.accountName,
                a.streetName,
                a.zipCode,
                a.city,
                a.country
              FROM customerAddress a
              WHERE
                a.accountName = '$accountName'";

            if ($result = $dbConnection->query($dbQuery)) {
                // fetch customer address
                $customerAddress = $result->fetch_object("CustomerAddress");
                // free result set
                $result->close();
            }
        }
        return $customerAddress;
    }

    /**
     * @param $customerAddress
     */
    function updateCustomerAddress($customerAddress)
    {
        $dbConnection = getDBConnection();

        if (isset($customerAddress) && $customerAddress instanceof CustomerAddress) {
            $dbQuery = "
              UPDATE customerAddress
              SET
                streetName = '{$customerAddress->getStreetName()}',
                zipCode = '{$customerAddress->getZipCode()}',
                city = '{$customerAddress->getCity()}',
                country = '{$customerAddress->getCountry()}'
              WHERE
                accountName = '{$customerAddress->getAccountName()}'";

            if ($dbConnection->query($dbQuery) === TRUE) {
                //success
            } else {
                echo $dbConnection->error;
            }
            $dbConnection->close();
        }
    }
    //endregion customer

    //region admin
    /**
     * @param $accountName
     * @param $password
     * @return admin.
     */
    function getAdmin($accountName, $password)
    {
        $dbConnection = getDBConnection();

        if ($accountName !== '' && $password !== '') {
            //real_escape_string --> else sql code can be injected (password like 'or'1'='1 will work...)
            $accountName = $dbConnection->real_escape_string($accountName);
            $password = $dbConnection->real_escape_string($password);
            $dbQuery = "
              SELECT
                a.accountName
              FROM admin a
              WHERE
                a.accountName = '$accountName'
                AND a.accountPassword = '$password';";

            if ($result = $dbConnection->query($dbQuery)) {
                // fetch customer
                $customer = $result->fetch_object("Customer");
                // free result set
                $result->close();
            }
        }
        return $customer;
    }
    //endregion admin

    //region search
    function getSearchPreview($searchTxt)
    {
        global $language;
        $dbConnection = getDBConnection();
        if ($searchTxt !== '') {
            $searchTxt = addcslashes($dbConnection->real_escape_string($searchTxt), '%_');
            $dbQuery = "
                (SELECT
                    p.plantId AS id,
                    p.price AS price,
                    pTx.plantTitle AS title,
                    pTx.plantDescription AS description,
                    1 AS productType
                FROM plant p
                INNER JOIN plantTx pTx
                  ON pTx.plantId = p.plantId
                  AND pTx.language = '$language'
                  AND (pTx.plantTitle LIKE '$searchTxt%' OR pTx.plantDescription LIKE '%$searchTxt%'))
                UNION
                (SELECT
                    a.accessoryId AS id,
                    a.price AS price,
                    aTx.accessoryTitle AS title,
                    aTx.accessoryDescription AS description,
                    2 AS productType
                FROM accessory a
                INNER JOIN accessoryTx aTx
                  ON aTx.accessoryId = a.accessoryId
                  AND aTx.language = '$language'
                  AND (aTx.accessoryTitle LIKE '%$searchTxt%' OR aTx.accessoryDescription LIKE '%$searchTxt%'))
                ORDER BY title LIMIT 10";
        }
        $products = array();
        if ($dbRes = $dbConnection->query($dbQuery)) {
            while ($product = $dbRes->fetch_object("Product")) {
                array_push($products, $product);
            }
            // free result set
            $dbRes->close();
        }
        return $products;
    }

    function getSearchPreviewExt($searchTxt)
    {
        global $language;
        $dbConnection = getDBConnection();
        if ($searchTxt !== '') {
            $searchTxt = addcslashes($dbConnection->real_escape_string($searchTxt), '%_');
            $dbQuery = "
                    (SELECT
                        p.plantId AS id,
                        p.price AS price,
                        p.pictureName AS pictureName,
                        pTx.plantTitle AS title,
                        pTx.plantDescription AS description,
                        1 AS productType
                    FROM plant p
                    INNER JOIN plantTx pTx
                      ON pTx.plantId = p.plantId
                      AND pTx.language = '$language'
                      AND (pTx.plantTitle LIKE '$searchTxt%' OR pTx.plantDescription LIKE '%$searchTxt%'))
                    UNION
                    (SELECT
                        a.accessoryId AS id,
                        a.price AS price,
                        a.pictureName AS pictureName,
                        aTx.accessoryTitle AS title,
                        aTx.accessoryDescription AS description,
                        2 AS productType
                    FROM accessory a
                    INNER JOIN accessoryTx aTx
                      ON aTx.accessoryId = a.accessoryId
                      AND aTx.language = '$language'
                      AND (aTx.accessoryTitle LIKE '%$searchTxt%' OR aTx.accessoryDescription LIKE '%$searchTxt%'))
                    ORDER BY title";
        }
        $products = array();
        if ($dbRes = $dbConnection->query($dbQuery)) {
            while ($product = $dbRes->fetch_object("Product")) {
                array_push($products, $product);
            }
            // free result set
            $dbRes->close();
        }
        return $products;
    }

    /**
     * search for plants matching the specified criteria
     * @param $sunlight
     * @param $pouringfreq
     * @param $difficulty
     * @return array of Product
     */
    function getSearchPreviewForWizard($sunlight, $pouringfreq, $difficulty)
    {
        global $language;
        $dbConnection = getDBConnection();
        if (is_numeric($sunlight) && is_numeric($pouringfreq) && is_numeric($difficulty)) {
            $dbQuery = "
                    SELECT
                        p.plantId AS id,
                        p.price AS price,
                        p.pictureName AS pictureName,
                        pTx.plantTitle AS title,
                        pTx.plantDescription AS description,
                        1 AS productType
                    FROM plant p
                    INNER JOIN plantTx pTx
                      ON pTx.plantId = p.plantId
                      AND pTx.language = '$language'
                    WHERE
                      p.sunlight <= '$sunlight'
                      AND p.pouringFrequency <= '$pouringfreq'
                      AND p.difficulty <= '$difficulty'";
        }
        $products = array();
        if ($dbRes = $dbConnection->query($dbQuery)) {
            while ($product = $dbRes->fetch_object("Product")) {
                array_push($products, $product);
            }
            // free result set
            $dbRes->close();
        }
        return $products;
    }
    //endregion search
}