<div id="preview_image">
    <img id="logo" src="pictures/{$inner_product->getPictureName()}" width="400" height="400" border="0"/>
    {$inner_product->getDescription()}
</div>
<div id="customizing">
    <form action="index.php?page=addtocart" method="POST">
        <h3>{$language["DETAILS_ACCESSORY"]}</h3>

        {foreach from=$inner_accessories item=accessory}
            <input type="checkbox" name="accessory_{$accessory->getId()}" />{$accessory->getTitle()}
            <br/>
        {/foreach}
        <input type="number" id="quantity" name="quantity" value="1" />
        <input type="submit" id="addToCart" value="{$language["DETAILS_ADD_TO_CART"]}"/>
    </form>
</div>