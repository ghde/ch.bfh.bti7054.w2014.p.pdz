<div id="preview_image">
    <img id="logo" src="pictures/{$inner_product->getPicture()}" width="400" height="400" border="0"/>
    {$inner_product->getDescription()}
</div>
<div id="customizing">
    <form action="index.php?page=addtocart" method="POST">
        <h3>{$language["DETAILS_EXPANSION"]}</h3>

        <input type="hidden" name="plant" value="{$product["id"]}"/>
        <input type="checkbox" name="addons" value="pot"/>{$language["DETAILS_EXPANSION_POT"]}<br/>
        <input type="checkbox" name="addons" value="wpot"/>{$language["DETAILS_EXPANSION_NOPOT"]}<br/>
        <input type="checkbox" name="addons" value="spot"/>{$language["DETAILS_EXPANSION_PLANTA"]}<br/>
        <br/>
        <input type="submit" value="{$language["DETAILS_ADD_TO_CART"]}"/>
    </form>
</div>