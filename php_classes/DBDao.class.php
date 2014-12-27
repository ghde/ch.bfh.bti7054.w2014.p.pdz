<?php
/**
 * Created by IntelliJ IDEA.
 * User: Claudio
 * Date: 05.12.14
 * Time: 10:43
 */

class DBDao {

    //region plant
    /**
     * @return string
     */
    private function getPlantSelectQuery(){
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
    function getPlant($plantId) {
        global $dbConnection;

        if (empty($plantId)){
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
     * @return array of plants.
     */
    function getAllPlants() {
        global $dbConnection;

        $plants = array();
        $dbQuery = $this->getPlantSelectQuery() . "ORDER by plant.plantId";
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
    //endregion plant

    //region accessory
    /**
     * @param $plantId
     * @return string
     */
    private function getAccessorySelectQuery($plantId){
        global $language;

        $dbQuery = "
        SELECT
            a.accessoryId,
            a.pictureName,
            a.price,
            aTx.accessoryTitle,
            aTx.accessoryDescription
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
    function getAccessoriesByPlant($plantId) {
        global $dbConnection;

        if (empty($plantId)){
            return null;
        }

        $accessories = array();
        $dbQuery = $this->getAccessorySelectQuery($plantId);

        if($dbRes = $dbConnection->query($dbQuery)) {
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
    function getAllAccessories() {
        global $dbConnection;

        $accessories = array();
        $dbQuery = $this->getAccessorySelectQuery(null);
        if($dbRes = $dbConnection->query($dbQuery)) {
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
    function getAccessory($accessoryId) {
        global $dbConnection;

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

    //region config
    /**
     * @return array of language keys.
     */
    function getLanguageKeys() {
        global $dbConnection, $language;

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
    function getCustomer($accountName, $password) {
        global $dbConnection;

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
    //endregion customer

    /**
     * @param $accountName
     * @param $password
     * @return admin.
     */
    function getAdmin($accountName, $password) {
        global $dbConnection;

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

    function getSearchPreview($searchTxt){
        global $dbConnection, $language;
        if ($searchTxt !== '') {
            $searchTxt = addcslashes($dbConnection->real_escape_string($searchTxt), '%_');
            $dbQuery = "
                (SELECT
                    p.plantId AS productId,
                    p.price AS productPrice,
                    pTx.plantTitle AS productTitle,
                    pTx.plantDescription AS productDescription,
                    1 AS productType
                FROM plant p
                INNER JOIN plantTx pTx
                  ON pTx.plantId = p.plantId
                  AND pTx.language = '$language'
                  AND (pTx.plantTitle LIKE '$searchTxt%' OR pTx.plantDescription LIKE '%$searchTxt%'))
                UNION
                (SELECT
                    a.accessoryId AS productId,
                    a.price AS productPrice,
                    aTx.accessoryTitle AS productTitle,
                    aTx.accessoryDescription AS productDescription,
                    2 AS productType
                FROM accessory a
                INNER JOIN accessoryTx aTx
                  ON aTx.accessoryId = a.accessoryId
                  AND aTx.language = '$language'
                  AND (aTx.accessoryTitle LIKE '%$searchTxt%' OR aTx.accessoryDescription LIKE '%$searchTxt%'))
                ORDER BY productTitle LIMIT 10";
        }
        $products = array();
        if($dbRes = $dbConnection->query($dbQuery)) {
            while ($product = $dbRes->fetch_object("Product")) {
                array_push($products, $product);
            }
            // free result set
            $dbRes->close();
        }
        return $products;
    }
    function getSearchPreviewExt($searchTxt){
        global $dbConnection, $language;
        if ($searchTxt !== '') {
            $searchTxt = addcslashes($dbConnection->real_escape_string($searchTxt), '%_');
            $dbQuery = "
                    (SELECT
                        p.plantId AS productId,
                        p.price AS productPrice,
                        p.pictureName AS productPictureName,
                        pTx.plantTitle AS productTitle,
                        pTx.plantDescription AS productDescription,
                        1 AS productType
                    FROM plant p
                    INNER JOIN plantTx pTx
                      ON pTx.plantId = p.plantId
                      AND pTx.language = '$language'
                      AND (pTx.plantTitle LIKE '$searchTxt%' OR pTx.plantDescription LIKE '%$searchTxt%'))
                    UNION
                    (SELECT
                        a.accessoryId AS productId,
                        a.price AS productPrice,
                        a.pictureName AS productPictureName,
                        aTx.accessoryTitle AS productTitle,
                        aTx.accessoryDescription AS productDescription,
                        2 AS productType
                    FROM accessory a
                    INNER JOIN accessoryTx aTx
                      ON aTx.accessoryId = a.accessoryId
                      AND aTx.language = '$language'
                      AND (aTx.accessoryTitle LIKE '%$searchTxt%' OR aTx.accessoryDescription LIKE '%$searchTxt%'))
                    ORDER BY productTitle LIMIT 10";
        }
        $products = array();
        if($dbRes = $dbConnection->query($dbQuery)) {
            while ($product = $dbRes->fetch_object("Product")) {
                array_push($products, $product);
            }
            // free result set
            $dbRes->close();
        }
        return $products;
    }
}