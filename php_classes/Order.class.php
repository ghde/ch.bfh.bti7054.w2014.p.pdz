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

    /**
     * @param $user User.
     * Sends payment mail.
     */
    public function sendPaymentMail($user) {
        global $smarty;

        $smarty->assign('user', $user);
        $smarty->assign('order', $this);
        $smarty->assign('price', $this->calculatePrice());

        $mailOutput = $smarty->fetch('mail_payment.tpl');
        mail($user->getAccountName(), "Plants for your Home", $mailOutput, "From: plants-for-your-home@no-host");
    }

    /**
     * @param $user User.
     * Sends payment mail.
     */
    public function sendDeliveryMail($user) {
        global $smarty;

        $smarty->assign('user', $user);
        $smarty->assign('order', $this);
        $smarty->assign('date', new DateTime());

        $mailOutput = $smarty->fetch('mail_delivery.tpl');
        mail($user->getAccountName(), "Plants for your Home", $mailOutput, "From: plants-for-your-home@no-host");
    }

    private function calculatePrice() {
        $price = 0.0;
        foreach ($this->orderPosArray as $orderPos) {
            $price += $orderPos->getQuantity() * $orderPos->getUnitPrice();
        }
        return $price;
    }
}