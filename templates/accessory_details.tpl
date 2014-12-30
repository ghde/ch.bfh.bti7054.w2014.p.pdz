<div id="preview_image">
    <img id="logo" src="pictures/{$inner_accessory->getPictureName()}" width="400" height="400" border="0"/>
    {$inner_accessory->getDescription()}
</div>
<div id="customizing">
    <form action="index.php?page=addtocart" method="POST">
        <input type="hidden" value="1" name="isAccessory" />
        <input type="number" name="quantity" />
        <input type="submit" name="addToCart" value="{$language["DETAILS_ADD_TO_CART"]}"/>
    </form>
</div>