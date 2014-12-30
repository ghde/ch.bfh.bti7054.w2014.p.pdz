<div id="order_details">
    {foreach from=$inner_results item=result}
        <div>
            <img class="plant" src="pictures/{$result->getProductPictureName()}" width="100" height="100" border="0"/>
            <a href="index.php?page={if $result->getProductType() eq 1}details{else}accessoryDetails{/if}&Id={$result->getProductId()}">{$result->getProductTitle()} - CHF {$result->getProductPrice()}</a>
            <p>{$result->getProductDescription()}</p>
        </div>
    {/foreach}
    <form action="index.php?page=order" method="post">
        <input type="submit" name="orderDetail" value="{$language["ORDER_CONTINUE"]}" />
    </form>
</div>