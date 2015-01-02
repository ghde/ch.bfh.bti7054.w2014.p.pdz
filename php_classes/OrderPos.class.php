<?php

/**
 * Created by IntelliJ IDEA.
 * User: pfafs1
 * Date: 30.12.2014
 * Time: 22:18
 */
class OrderPos
{
    private $orderPosId;

    private $orderId;

    private $plant;

    private $plantId;

    private $accessory;

    private $accessoryId;

    private $quantity;

    private $unitPrice;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->orderPosId;
    }

    /**
     * @param mixed $orderPosId
     */
    public function setId($orderPosId)
    {
        $this->orderPosId = $orderPosId;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getPlant()
    {
        return $this->plant;
    }

    /**
     * @param mixed $plant
     */
    public function setPlant($plant)
    {
        $this->plant = $plant;
    }

    /**
     * @return mixed
     */
    public function getPlantId()
    {
        return $this->plantId;
    }

    /**
     * @param mixed $plantId
     */
    public function setPlantId($plantId)
    {
        $this->plantId = $plantId;
    }

    /**
     * @return mixed
     */
    public function getAccessory()
    {
        return $this->accessory;
    }

    /**
     * @param mixed $accessory
     */
    public function setAccessory($accessory)
    {
        $this->accessory = $accessory;
    }

    /**
     * @return mixed
     */
    public function getAccessoryId()
    {
        return $this->accessoryId;
    }

    /**
     * @param mixed $accessoryId
     */
    public function setAccessoryId($accessoryId)
    {
        $this->accessoryId = $accessoryId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param mixed $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

}