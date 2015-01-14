<?php

/**
 * Created by IntelliJ IDEA.
 * User: decla
 * Date: 30.11.2014
 * Time: 21:06
 */
class Plant extends Product
{
    private $pouringFrequency;

    private $sunlight;

    private $difficulty;

    private $plantType;

    private $plantTxArray;

    public function __construct($id, $pictureName, $title, $description,
                                $pouringFrequency, $sunlight, $difficulty, $plantType, $price)
    {
        $this->id = $id;
        $this->pictureName = $pictureName;
        $this->title = $title;
        $this->description = $description;
        $this->pouringFrequency = $pouringFrequency;
        $this->sunlight = $sunlight;
        $this->difficulty = $difficulty;
        $this->plantType = $plantType;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPictureName()
    {
        return $this->pictureName;
    }

    /**
     * @param mixed $pictureName
     */
    public function setPictureName($pictureName)
    {
        $this->pictureName = $pictureName;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPouringFrequency()
    {
        return $this->pouringFrequency;
    }

    /**
     * @param mixed $pouringFrequency
     */
    public function setPouringFrequency($pouringFrequency)
    {
        $this->pouringFrequency = $pouringFrequency;
    }

    /**
     * @return mixed
     */
    public function getSunlight()
    {
        return $this->sunlight;
    }

    /**
     * @param mixed $sunlight
     */
    public function setSunlight($sunlight)
    {
        $this->sunlight = $sunlight;
    }

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param mixed $difficulty
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return mixed
     */
    public function getPlantType()
    {
        return $this->plantType;
    }

    /**
     * @param mixed $plantType
     */
    public function setPlantType($plantType)
    {
        $this->plantType = $plantType;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param $plantTxArray
     */
    public function setPlantTxArray($plantTxArray) {
        $this->plantTxArray = $plantTxArray;
    }

    /**
     * @return mixed
     */
    public function getPlantTxArray() {
        return $this->plantTxArray;
    }

    /**
     * @return int
     */
    public function getProductType(){
        return 1;//plant
    }

    /**
     * @param mixed $productType
     */
    public function setProductType($productType){
        //do nothing
    }
}