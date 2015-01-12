<div id="preview_image">
        <img id="logo" src="pictures/{$inner_product->getPictureName()}" width="400" height="400" border="0"/>
</div>

<div id="preview_description">
        <h1>{$inner_product->getTitle()}</h1>
        <h3 class="descriptors">{$language["ORDER_DETAILS_TBL_DESC"]}:</h3>
        {$inner_product->getDescription()}
        <h3 class="descriptors">{$language["POURING_FREQUENCY"]}</h3>
        {$inner_product->getPouringFrequency()}
        <h3 class="descriptors">{$language["SUNLIGHT"]}</h3>
        {$inner_product->getSunlight()}
        <h3 class="descriptors">{$language["DIFFICULTY"]}</h3>
        {$inner_product->getDifficulty()}
        <h3 class="descriptors">{$language["ORDER_DETAILS_TBL_PRICE"]}</h3>
        {$inner_product->getPrice()}
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