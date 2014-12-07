<div id="preview_image">
    <img id="logo" src="pictures/{$inner_accessory->getPictureName()}" width="400" height="400" border="0"/>
    {$inner_accessory->getDescription()}
</div>
<div id="customizing">
    <form action="index.php?page=addtocart" method="POST">
        <input type="submit" value="{$language["DETAILS_ADD_TO_CART"]}"/>
    </form>
</div>