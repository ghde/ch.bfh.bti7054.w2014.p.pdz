<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Plants for your home | Admin</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/design.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/design-admin.css"/>
    <script type="text/javascript" src="js/script-admin.js"></script>
</head>
<body id="aOrder">
{if $admin->isLoggedIn()}
    <div>
        <h2>Order overview <a id="orders_toggle" href="#" onclick="toggle('orders');">[hide]</a></h2>

        <div id="orders" class="">
            {if $orders|count == 0}
                No active orders found!
            {else}
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ordered items</th>
                        <th>Delivery Address</th>
                        <th>Status</th>
                        <th>Cancel</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$orders item=order}
                        <tr class="order_status_{$order->getStatus()}">
                            <th>#{$order->getId()}</th>
                            <td><strong>Items:</strong>
                                <ul>
                                    {foreach from=$order->getOrderPosArray() item=pos}
                                        {if $pos->getPlantId() != null}
                                            <li>{$pos->getQuantity()} x {$pos->getPlant()->getTitle()}
                                                (CHF {$pos->getUnitPrice()})
                                            </li>
                                        {elseif $pos->getAccessoryId() != null}
                                            <li>{$pos->getQuantity()} x {$pos->getAccessory()->getTitle()}
                                                (CHF {$pos->getUnitPrice()})
                                            </li>
                                        {/if}
                                    {/foreach}
                                </ul>
                            </td>
                            <td>
                                {$order->getStreetName()}, {$order->getZipCode()} {$order->getCity()}
                                ({$order->getCountry()})

                                {if $order->getStatus() == 3}
                                    {if !$order->isValidAddress()}
                                        <div class="invalidAddress">
                                            <strong>Address is invalid, might be:</strong><br/>
                                            {$order->getFormattedAddress()}
                                        </div>
                                    {else}
                                        <div class="validAddress">
                                            <strong>Address is valid!</strong>
                                        </div>
                                    {/if}
                                {/if}
                            </td>
                            <td>
                                <strong>Current status:</strong> {$status[$order->getStatus()]}<br/><br/>

                                <form action="admin.php" method="post">
                                    <input type="hidden" name="action" value="proceedOrder"/>
                                    <input type="hidden" name="orderId" value="{$order->getId()}"/>
                                    <input type="hidden" name="newStatus" value="{$order->getNextStatus()}"/>
                                    <button type="submit">Change status to {$status[$order->getNextStatus()]}</button>
                                </form>
                            </td>
                            <td>
                                <form action="admin.php" method="post" onsubmit="return cancelOrder()">
                                    <input type="hidden" name="action" value="cancelOrder"/>
                                    <input type="hidden" name="orderId" value="{$order->getId()}"/>
                                    <input type="hidden" name="newStatus" value="{$order->getNextStatus()}"/>
                                    <button type="submit">Cancel order</button>
                                </form>
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            {/if}
        </div>
    </div>
    <div>
        <h2>All plants <a id="plants_toggle" href="#" onclick="toggle('plants');">[show]</a></h2>

        <div id="plants" class="hidden">
            {if $plants|count == 0}
                No plants found!
            {else}
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Pouring frequency</th>
                        <th>Sunlight</th>
                        <th>Difficulty</th>
                        <th>Plant type</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$plants item=plant}
                        <tr>
                            <th>#{$plant->getId()}</th>
                            <td>{$plant->getTitle()}</td>
                            <td align="right">{$plant->getPrice()} CHF</td>
                            <td align="right">{$plant->getPouringFrequency()}</td>
                            <td align="right">{$plant->getSunlight()}</td>
                            <td align="right">{$plant->getDifficulty()}</td>
                            <td>{$plant->getPlantType()->getTitle()}</td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            {/if}
        </div>
    </div>
    <div>
        <h2>Add a new plant <a id="addPlant_toggle" href="#" onclick="toggle('addPlant');">[show]</a></h2>

        <div id="addPlant" class="hidden">
            <!-- plantTypes -->
            <form action="admin.php" method="post">

                <hr/>
                <label for="titleDE">Plant title german</label>
                <input id="titleDE" name="titleDE" type="text"/>

                <label for="descriptionDE">Plant description german</label>
                <textarea id="descriptionDE" name="descriptionDE" rows="5" cols="50">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</textarea>

                <hr/>
                <label for="titleEN">Plant title english</label>
                <input id="titleEN" name="titleEN" type="text"/>

                <label for="descriptionEN">Plant description english</label>
                <textarea id="descriptionEN" name="descriptionEN" rows="5" cols="50">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</textarea>

                <hr/>
                <label for="picture">Picture</label>
                <select id="picture" name="picture">
                    {foreach from=$pictures item=picture}
                        {if $picture|strpos:'plant'===0}
                            <option value="{$picture}">{$picture}</option>
                        {/if}
                    {/foreach}
                </select>

                <label for="price">Price</label>
                <input id="price" name="price" type="number" step="0.01"/>

                <label for="pouringFrequency">Pouring frequency</label>
                <select id="pouringFrequency" name="pouringFrequency">
                    {foreach from=$numerics item=numeric}
                        <option value="{$numeric}">{$numeric}</option>
                    {/foreach}
                </select>

                <label for="sunlight">Sunlight</label>
                <select id="sunlight" name="sunlight">
                    {foreach from=$numerics item=numeric}
                        <option value="{$numeric}">{$numeric}</option>
                    {/foreach}
                </select>

                <label for="difficulty">Difficulty</label>
                <select id="difficulty" name="difficulty">
                    {foreach from=$numerics item=numeric}
                        <option value="{$numeric}">{$numeric}</option>
                    {/foreach}
                </select>

                <label for="plantType">Plant type</label>
                <select id="plantType" name="plantType">
                    {foreach from=$plantTypes item=plantType}
                        <option value="{$plantType->getId()}">{$plantType->getTitle()}</option>
                    {/foreach}
                </select>

                <input type="hidden" name="action" value="createPlant"/>
                <input type="hidden" name="orderId" value="0"/>
                <button type="submit">Save plant</button>

            </form>
        </div>
    </div>
    <div>
        <h2>Logout</h2>

        <form action="admin.php" method="post">
            <input type="hidden" name="action" value="logout"/>
            <input type="hidden" name="orderId" value="0"/>
            <button type="submit">Logout from admin panel</button>
        </form>
    </div>
{else}
    <div>
        <h2>Login</h2>

        <form action="{$url}" method="post">
            <label for="username">{$language["LOGIN_FORM_USERNAME"]}</label>
            <input id="username" name="username" type="text" l/>
            <label for="password">{$language["LOGIN_FORM_PASSWORD"]}</label>
            <input id="password" name="password" type="password"/>
            <button type="submit" name="login">{$language["LOGIN_FORM_LOGIN"]}</button>
        </form>
    </div>
{/if}
</body>
</html>