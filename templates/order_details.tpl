<div id="order_details" class="noPadding">
    <h1>{$language["ORDER_DETAILS_TITLE"]}</h1>
    <table>
        <thead>
            <th>{$language["ORDER_DETAILS_TBL_TITLE"]}</th>
            <th>{$language["ORDER_DETAILS_TBL_DESC"]}</th>
            <th>{$language["ORDER_DETAILS_TBL_PRICE"]}</th>
            <th>{$language["ORDER_DETAILS_TBL_QUAN"]}</th>
            <th>{$language["ORDER_DETAILS_TBL_TOT"]}</th>
        </thead>
        <tbody>
    {foreach from=$inner_products item=product}
            <tr>
                <td>
                    <a href="index.php?page={if $product.product->getProductType() eq 1}details{else}accessoryDetails{/if}&Id={$product.product->getId()}">{$product.product->getTitle()}</a>
                </td>
                <td>
                    {$product.product->getDescription()}
                </td>
                <td class="right">
                    {number_format($product.product->getPrice(), 2)}
                </td>
                <td class="right">
                    {$product.quantity}
                </td>
                <td class="right">
                    {number_format($product.quantity * $product.product->getPrice(), 2)}
                </td>
            </tr>
    {/foreach}
        </tbody>
        <tfoot>
            <td />
            <td />
            <td />
            <td />
            <td class="right">
                CHF {number_format($inner_totalPrice, 2)}
            </td>
        </tfoot>
    </table>
    {if !isset($user) || !$user->isLoggedIn()}
        <p class="loginRequired">{$language["LOGIN_REQUIRED"]}</p>
    {/if}
    <form action="index.php?page=order" method="post">
        <input type="submit" name="orderDetail" value="{$language["ORDER_CONTINUE"]}" {if !isset($user) || !$user->isLoggedIn() || $inner_products|@count == 0}style="display: none;"{/if} />
    </form>
</div>