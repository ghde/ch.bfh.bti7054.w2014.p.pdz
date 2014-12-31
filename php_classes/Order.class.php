<?php

/**
 * Created by IntelliJ IDEA.
 * User: pfafs1
 * Date: 30.12.2014
 * Time: 22:18
 */
class Order
{
    private $orderId;

    private $status;

    private $accountName;

    private $streetName;

    private $zipCode;

    private $city;

    private $country;

    private $orderPosArray;

    /**
     * @param $orderId
     */
    public function setId($orderId) {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->orderId;
    }

    /**
     * @param $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param $accountName
     */
    public function setAccountName($accountName) {
        $this->accountName = $accountName;
    }

    /**
     * @return mixed
     */
    public function getAccountName() {
        return $this->accountName;
    }

    /**
     * @param $streetName
     */
    public function setStreetName($streetName) {
        $this->streetName = $streetName;
    }

    /**
     * @return mixed
     */
    public function getStreetName() {
        return $this->streetName;
    }

    /**
     * @param $zipCode
     */
    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    /**
     * @return mixed
     */
    public function getZipCode() {
        return $this->zipCode;
    }

    /**
     * @param $city
     */
    public function setCity($city) {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @param $country
     */
    public function setCountry($country) {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @param $orderPosArray
     */
    public function setOrderPosArray($orderPosArray) {
        $this->orderPosArray = $orderPosArray;
    }

    /**
     * @return mixed
     */
    public function getOrderPosArray() {
        return $this->orderPosArray;
    }
}