<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Plants for your home | Admin</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/design.css"/>
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body id="aOrder">
{if $admin->isLoggedIn()}
    <div>
        <h3>Status: new</h3>
        The following orders are waiting for an order confirmation.
        {foreach from=$orders item=order}
            {if $order->getStatus() == 1}
                <div class="new">
                    <form action="{$url}" method="post">
                        <input type="hidden" name="proceedOrder" value=""/>
                        <input type="hidden" name="orderId" value="{$order->getId()}"/>
                        <input type="hidden" name="newStatus" value="2"/>
                        <strong>Order {$order->getId()}:</strong> {$order->getStreetName()}
                        , {$order->getZipCode()} {$order->getCity()} ({$order->getCountry()})
                        <ul>
                            {foreach from=$order->getOrderPosArray() item=pos}
                                {if $pos->getPlantId() != null}
                                    <li><strong>Position {$pos->getId()}:</strong> {$pos->getQuantity()}
                                        x {$pos->getPlant()->getTitle()} (CHF {$pos->getUnitPrice()})
                                    </li>
                                {elseif $pos->getAccessoryId() != null}
                                    <li><strong>Position {$pos->getId()}:</strong> {$pos->getQuantity()}
                                        x {$pos->getAccessory()->getTitle()} (CHF {$pos->getUnitPrice()})
                                    </li>
                                {/if}
                            {/foreach}
                        </ul>
                        <button type="submit">confirm</button>
                    </form>
                </div>
            {/if}
        {/foreach}
    </div>
    <div><h3>Status: confirmed</h3>
        The following orders are waiting for the customer to pay.
        {foreach from=$orders item=order}
            {if $order->getStatus() == 2}
                <div class="confirmed">
                    <form action="{$url}" method="post">
                        <input type="hidden" name="proceedOrder" value=""/>
                        <input type="hidden" name="orderId" value="{$order->getId()}"/>
                        <input type="hidden" name="newStatus" value="3"/>
                        <strong>Order {$order->getId()}:</strong> {$order->getStreetName()}
                        , {$order->getZipCode()} {$order->getCity()} ({$order->getCountry()})
                        <ul>
                            {foreach from=$order->getOrderPosArray() item=pos}
                                {if $pos->getPlantId() != null}
                                    <li><strong>Position {$pos->getId()}:</strong> {$pos->getQuantity()}
                                        x {$pos->getPlant()->getTitle()} (CHF {$pos->getUnitPrice()})
                                    </li>
                                {elseif $pos->getAccessoryId() != null}
                                    <li><strong>Position {$pos->getId()}:</strong> {$pos->getQuantity()}
                                        x {$pos->getAccessory()->getTitle()} (CHF {$pos->getUnitPrice()})
                                    </li>
                                {/if}
                            {/foreach}
                        </ul>
                        <button type="submit">payed</button>
                    </form>
                </div>
            {/if}
        {/foreach}
    </div>
    <div><h3>Status: payed</h3>
        The following orders are waiting for delivery.
        <div class="apiKey">
            <strong>Validate the delivery addresses with google</strong><br/><br/>

            <form action="{$url}" method="post">
                <input type="hidden" name="validateDeliveryAddresses"/>
                <button type="submit">Validate delivery addresses</button>
            </form>
        </div>
        {foreach from=$orders item=order}
            {if $order->getStatus() == 3}
                <div class="payed">
                    <form action="{$url}" method="post">
                        <input type="hidden" name="proceedOrder" value=""/>
                        <input type="hidden" name="orderId" value="{$order->getId()}"/>
                        <input type="hidden" name="newStatus" value="4"/>
                        <input type="hidden" name="googleApiKey" value="4"/>
                        <strong>Order {$order->getId()}:</strong>
                            {$order->getStreetName()}, {$order->getZipCode()} {$order->getCity()} ({$order->getCountry()})
                        {if $order->isValidAddress()}
                            <strong>-> valid!</strong>
                        {elseif $order->getFormattedAddress()}
                            <div class="invalidAddress">
                                <strong>Address is invalid, it might be:</strong><br/>
                                {$order->getFormattedAddress()}
                            </div>
                        {/if}
                        <ul>
                            {foreach from=$order->getOrderPosArray() item=pos}
                                {if $pos->getPlantId() != null}
                                    <li><strong>Position {$pos->getId()}:</strong> {$pos->getQuantity()}
                                        x {$pos->getPlant()->getTitle()} (CHF {$pos->getUnitPrice()})
                                    </li>
                                {elseif $pos->getAccessoryId() != null}
                                    <li><strong>Position {$pos->getId()}:</strong> {$pos->getQuantity()}
                                        x {$pos->getAccessory()->getTitle()} (CHF {$pos->getUnitPrice()})
                                    </li>
                                {/if}
                            {/foreach}
                        </ul>
                        <button type="submit">delivered</button>
                    </form>
                </div>
            {/if}
        {/foreach}
    </div>
    <div>
        <h3>Reload admin UI</h3>
        <form action="admin.php" method="get">
            <button type="submit">reload</button>
        </form>
    </div>
{else}
    <form action="{$url}" method="post">
        <label for="username">{$language["LOGIN_FORM_USERNAME"]}</label>
        <input id="username" name="username" type="text" l/>
        <label for="password">{$language["LOGIN_FORM_PASSWORD"]}</label>
        <input id="password" name="password" type="password"/>
        <button type="submit" name="login">{$language["LOGIN_FORM_LOGIN"]}</button>
    </form>
{/if}
</body>
</html>