<div id="plants">
    {foreach from=$inner_products item=product}
        <div>
            <h3>{$product["name"]}</h3>
            <img class="plant" src="pictures/{$product["picture"]}" width="200" height="200" border="0"/>

            <p>{$product["description"]}</p>

            <form action="index.php" method="GET">
                <input type="hidden" name="page" value="details"/>
                <input type="hidden" name="plantID" value="{$product["id"]}"/>
                <button type="submit">{$language["PRODUCT_SHOW_DETAILS"]}</button>
            </form>
        </div>
    {/foreach}
</div>