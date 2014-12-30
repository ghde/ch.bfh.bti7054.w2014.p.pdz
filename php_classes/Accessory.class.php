<?php

/**
 * Created by IntelliJ IDEA.
 * User: pfafs1
 * Date: 07.12.2014
 * Time: 13:56
 */
class Accessory extends Product
{
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $accessoryId
     */
    public function setId($accessoryId)
    {
        $this->id = $accessoryId;
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
     * @param mixed $accessoryTitle
     */
    public function setTitle($accessoryTitle)
    {
        $this->title = $accessoryTitle;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $accessoryDescription
     */
    public function setDescription($accessoryDescription)
    {
        $this->description = $accessoryDescription;
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
     * @return int
     */
    public function getProductType(){
        return 2;//accessory
    }

    /**
     * @param mixed $productType
     */
    public function setProductType($productType){
        //do nothing
    }
}