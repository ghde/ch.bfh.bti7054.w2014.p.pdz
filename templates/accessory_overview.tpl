<div id="accessories">
    {foreach from=$inner_accessories item=accessory}
        <div>
            <h3>{$accessory->getTitle()}</h3>
            <img class="plant" src="pictures/{$accessory->getPictureName()}" width="200" height="200" border="0"/>

            <p>{$accessory->getDescription()}</p>

            <form action="index.php" method="GET">
                <input type="hidden" name="page" value="accessoryDetails"/>
                <input type="hidden" name="accessoryId" value="{$accessory->getId()}"/>
                <button type="submit">{$language["PRODUCT_SHOW_DETAILS"]}</button>
            </form>
        </div>
    {/foreach}
</div>