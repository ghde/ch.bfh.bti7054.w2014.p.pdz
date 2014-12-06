<?php
/**
 * Created by IntelliJ IDEA.
 * User: Claudio
 * Date: 05.12.14
 * Time: 10:43
 */

class DBDao {

    /**
     * @return array of plants.
     */
    function getAllPlants() {
        global $dbConnection, $language;

        $plants = array();
        $dbQuery = "select plant.plantId, plant.plantTypeId price, pouringFrequency, sunlight, difficulty,
              plantTx.plantTitle, plantTx.plantDescription, plantTypeTx.plantTypeTitle, plantTypeTx.plantTypeDescription
            from plant
              inner join plantTx on plant.plantId = plantTx.plantId and plantTx.language = '$language'
              inner join plantTypeTx on plant.plantTypeId = plantTypeTx.plantTypeId and plantTypeTx.language = '$language'
            order by plant.plantId";
        $dbRes = $dbConnection->query($dbQuery);
        while ($row = $dbRes->fetch_object()) {

            // Create plant type and plant
            $plantType = new PlantType($row->plantTypeId,
                $row->plantTypeTitle,
                $row->plantTypeDescription);
            $plant = new Plant($row->plantId,
                "plant" . $row->plantId . ".jpg",
                $row->plantTitle,
                $row->plantDescription,
                $row->pouringFrequency,
                $row->sunlight,
                $row->difficulty,
                $plantType);

            array_push($plants, $plant);
        }
        return $plants;
    }

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
}