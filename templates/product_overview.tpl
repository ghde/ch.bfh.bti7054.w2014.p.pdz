<div id="plants">
    {foreach from=$inner_plants item=plant}
        <div id="plantOverview">
            <h3>{$plant->getTitle()}</h3>
            <img class="plant" src="pictures/{$plant->getPictureName()}" width="200" height="200" border="0"/>

            <p>{$plant->getDescription()}</p>

            <form action="index.php" method="GET">
                <input type="hidden" name="page" value="details"/>
                <input type="hidden" name="Id" value="{$plant->getId()}"/>
                <button type="submit">{$language["PRODUCT_SHOW_DETAILS"]}</button>
            </form>
        </div>
    {/foreach}
</div>