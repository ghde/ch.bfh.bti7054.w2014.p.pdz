<?php

/**
 * Created by IntelliJ IDEA.
 * User: Judeaux
 * Date: 21/11/14
 * Time: 10:10
 */
class ShoppingCart
{

    private $items = array();

    public function addItem($articleId, $articleName, $numberOfUnits)
    {
        if (array_key_exists($articleId, $this->items)) {
            $this->items[$articleId]["num"] += $numberOfUnits;
        } else {
            $this->items[$articleId]["name"] = $articleName;
            $this->items[$articleId]["num"] = $numberOfUnits;
        }
    }

    public function removeItem($articleId)
    {
        if (array_key_exists($articleId, $this->items)) {
            unset($this->items[$articleId]);
        }
    }

    public function getItems()
    {
        return $this->items;
    }

}