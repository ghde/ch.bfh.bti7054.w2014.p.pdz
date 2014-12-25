<?php

/**
 * Created by IntelliJ IDEA.
 * User: Judeaux
 * Date: 21/11/14
 * Time: 10:10
 */
class ShoppingCart
{

    private $plants = array();

    private $accessories = array();

    private $totalPrice = 0.0;

    /**
     * @param $plant Plant.
     * @param $quantity Integer.
     */
    public function addPlant($plant, $quantity)
    {
        if (array_key_exists($plant->getId(), $this->plants)) {
            $this->plants[$plant->getId()]["quantity"] += $quantity;
        } else {
            $this->plants[$plant->getId()]["plant"] = $plant;
            $this->plants[$plant->getId()]["quantity"] = $quantity;
        }
        $this->calculatePrice();
    }

    /**
     * @param $accessory Accessory.
     * @param $quantity Integer.
     */
    public function addAccessory($accessory, $quantity)
    {
        if (array_key_exists($accessory->getId(), $this->accessories)) {
            $this->accessories[$accessory->getId()]["quantity"] += $quantity;
        } else {
            $this->accessories[$accessory->getId()]["accessory"] = $accessory;
            $this->accessories[$accessory->getId()]["quantity"] = $quantity;
        }
        $this->calculatePrice();
    }

    /**
     * @param $plantId Integer.
     */
    public function removePlant($plantId)
    {
        if (array_key_exists($plantId, $this->plants)) {
            unset($this->plants[$plantId]);
            $this->calculatePrice();
        }
    }

    /**
     * @param $accessoryId Integer.
     */
    public function removeAccessory($accessoryId)
    {
        if (array_key_exists($accessoryId, $this->accessories)) {
            unset($this->accessories[$accessoryId]);
            $this->calculatePrice();
        }
    }

    private function calculatePrice() {
        $this->totalPrice = 0.0;
        foreach ($this->plants as $plantData) {
            $quantity = doubleval($plantData["quantity"]);
            $plantPrice = doubleval($plantData["plant"]->getPrice());
            $this->totalPrice += ($quantity * $plantPrice);
        }
        foreach ($this->accessories as $accessoryData) {
            $quantity = doubleval($accessoryData["quantity"]);
            $accessoryPrice = doubleval($accessoryData["accessory"]->getPrice());
            $this->totalPrice += ($quantity * $accessoryPrice);
        }
    }

    /**
     * @return array Plant.
     */
    public function getPlants()
    {
        return $this->plants;
    }

    /**
     * @return array Accessory.
     */
    public function getAccessories()
    {
        return $this->accessories;
    }

    /**
     * @return float total price.
     */
    public function getTotalPrice() {
        return $this->totalPrice;
    }

    /**
     * Sends a confirmation email to the purchaser.
     */
    public function sendConfirmationOfReceipt() {
        global $smarty, $user, $language;

        $smarty->assign('user', $user);
        $smarty->assign('cart', $this);
        $smarty->assign('date', new DateTime());

        $mailOutput = $smarty->fetch('mail_' . $language . '_receipt.tpl');
        mail($user->getUsername(), "Plants for your Home", $mailOutput, "From: plants-for-your-home@no-host");
    }

}