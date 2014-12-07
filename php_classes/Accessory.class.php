<?php

/**
 * Created by IntelliJ IDEA.
 * User: pfafs1
 * Date: 07.12.2014
 * Time: 13:56
 */
class Accessory
{
    private $accessoryId;

    private $pictureName;

    private $accessoryTitle;

    private $accessoryDescription;

    private $price;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->accessoryId;
    }

    /**
     * @param mixed $accessoryId
     */
    public function setId($accessoryId)
    {
        $this->accessoryId = $accessoryId;
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
        return $this->accessoryTitle;
    }

    /**
     * @param mixed $accessoryTitle
     */
    public function setTitle($accessoryTitle)
    {
        $this->accessoryTitle = $accessoryTitle;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->accessoryDescription;
    }

    /**
     * @param mixed $accessoryDescription
     */
    public function setDescription($accessoryDescription)
    {
        $this->accessoryDescription = $accessoryDescription;
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
}