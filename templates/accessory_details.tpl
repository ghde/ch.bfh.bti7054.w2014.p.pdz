<div id="preview_image">
    <img id="logo" src="pictures/{$inner_accessory->getPictureName()}" width="400" height="400" border="0"/>
</div>
<div>
    {$inner_accessory->getDescription()}
</div>
<div id="customizing">
    <form action="index.php?page=addtocart" method="POST">
        <input type="hidden" value="1" name="isAccessory" />
        <input type="number" id="quantity" name="quantity" value="1" />
        <input type="submit" id="addToCart" name="addToCart" value="{$language["DETAILS_ADD_TO_CART"]}"/>
    </form>
</div>