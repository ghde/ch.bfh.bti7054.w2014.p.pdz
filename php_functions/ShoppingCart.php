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

    public function addItem($ID, $num)
    {
        if (!isset($this->items[$ID])) $this->items[$ID] = 0;
        $this->items[$ID] += $num;
    }

    public function removeItem($ID, $num)
    {
        if (isset($this->items[$ID]) && $this->items[$ID] >= $num) {
            $this->items[$ID] -= $num;

            if ($this->items[$ID] == 0) unset($this->items[$ID]);
            return true;
        } else return false;

    }

    public function display()
    {

        echo "<table border=\"1\">";
        echo "<tr><th>Article</th><th>Items</th><th>Remove</th></tr>";
        foreach ($this->items as $ID => $num)
            $button = "<button type='button' onclick=\"window.location.href='customize.php?removeID=$ID';\">Remove</button>";
            echo "<tr><td>$ID</td><td>$num</td><td>$button</td></tr>";
        echo "</table>";

    }

    public function isEmpty()
    {
        if (sizeof($this->items) == 0) {

            return true;

        }
    }

}