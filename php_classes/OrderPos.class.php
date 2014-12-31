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

    private $plantId;

    private $accessoryId;

    private $quantity;

    private $unitPrice;

    /**
     * @param $orderPosId
     */
    public function setId($orderPosId) {
        $this->orderPosId = $orderPosId;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->orderPosId;
    }

    /**
     * @param $orderId
     */
    public function setOrderId($orderId) {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getOrderId() {
        return $this->orderId;
    }

    /**
     * @param $plantId
     */
    public function setPlantId($plantId) {
        $this->plantId = $plantId;
    }

    /**
     * @return mixed
     */
    public function getPlantId() {
        return $this->plantId;
    }

    /**
     * @param $accessoryId
     */
    public function setAccessoryId($accessoryId) {
        $this->accessoryId = $accessoryId;
    }

    /**
     * @return mixed
     */
    public function getAccessoryId() {
        return $this->accessoryId;
    }

    /**
     * @param $quantity
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * @param $unitPrice
     */
    public function setUnitPrice($unitPrice) {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return mixed
     */
    public function getUnitPrice() {
        return $this->unitPrice;
    }
}