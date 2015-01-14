<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Plants for your home</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/design.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/design-shop.css"/>
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<div id="promise">
    {$language["OUR_PROMISE"]}
    <div id="languages">
        {foreach from=$languages key=short item=label}
            <a class="lang" href="?page=changelang&amp;lang={$short}">&raquo; {$label}</a>
        {/foreach}
    </div>
</div>
<div id="company">
    <div id="logo_and_slogan">
        <img id="logo" src="pictures/Logo_Plant_Front.png" width="110" height="90" border="0"/>
        <h1>PLANTS FOR YOUR HOME</h1>
    </div>
    <div id="sitemap">
        <div id="login">
            {if $user->isLoggedIn()}
                {$language["LOGIN_HELLO"]} {$user->getFirstname()} {$user->getLastname()}
                <form action="{$url}" method="post">
                    <button type="submit" name="logout">Logout!</button>
                </form>
            {else}
                <div>
                    <form id="loginForm" action="{$url}" method="post">
                        <label class="login" for="username">{$language["LOGIN_FORM_USERNAME"]}</label>
                        <input id="username" name="username" type="text" l/>
                        <label class="login" for="password">{$language["LOGIN_FORM_PASSWORD"]}</label>
                        <input id="password" name="password" type="password"/>
                        <button id="loginPanelButton" type="submit" name="login">{$language["LOGIN_FORM_LOGIN"]}</button>

                    </form>
                    <form action="index.php" method="GET">
                        <input type="hidden" name="page" value="signup"/>
                        <button id="loginPanelButton" type="submit">{$language["SIGNUP"]}</button><br>
                    </form>
                </div>
                {if $user->isFailedLoginTry()}
                    <span class="failedLogin"><strong>{$language["LOGIN_ERROR_HINT"]}
                            :</strong> {$language["LOGIN_ERROR_TEXT"]}</span>
                {/if}
            {/if}
        </div>
        <div id="shopping_cart">
            <div class="title">{$language["SHOPPING_CART_NAME"]}</div>
            {if $cart->getPlants()|@count == 0 && $cart->getAccessories()|@count == 0}
                {$language["SHOPPING_CART_NO_ITEMS"]}
            {else}
                <div class="elements">
                    {if $cart->getPlants()|@count > 0}
                        {foreach from=$cart->getPlants() item=plant}
                            <form method="POST" action="index.php?page=removefromcart">
                                <input type="hidden" name="plantId" value="{$plant.product->getId()}"/>

                                <div id="productInShoppingCart">{$plant.quantity} x <a
                                            href="index.php?page=details&Id={$plant.product->getId()}">{$plant.product->getTitle()}</a>
                                    <button type="submit">X</button>
                                </div>
                            </form>
                            <br>
                        {/foreach}
                    {/if}
                    {if $cart->getAccessories()|@count > 0}
                        {foreach from=$cart->getAccessories() item=accessory}
                            <form method="POST" action="index.php?page=removefromcart">
                                <input type="hidden" name="accessoryId" value="{$accessory.product->getId()}"/>

                                <div>{$accessory.quantity} x <a
                                            href="index.php?page=accessoryDetails&Id={$accessory.product->getId()}">{$accessory.product->getTitle()}</a>
                                    <button type="submit">X</button>
                                </div>
                            </form>
                        {/foreach}
                    {/if}
                </div>
                <form action="index.php" method="GET">
                    <input type="hidden" name="page" value="order"/>
                    <button type="submit">{$language["SHOPPING_CART_ORDER"]}</button>
                </form>
            {/if}
        </div>
    </div>
</div>
<div id="navigation_pane">
    {foreach from=$navigation key=name item=label}
        <a class="nav" href="index.php?page={$name}" class="navigation_pane">{$label}</a>
    {/foreach}
    <div id="search">
        <form method="GET" action="index.php">
            <input type="hidden" name="page" value="search"/>
            <input id="searchInput" name="searchInput" type="text"
                   onfocus="searchPreview(this.value)" onkeydown="checkKey(event)" oninput="searchPreview(this.value)"/>
            <input id="searchBtn" type="submit" value="" />
            <input id="previewCloseBtn" class="closeBtn" type="button" value="" onclick="closeSearch()" />
            <a href="index.php?page=plantwizard">{$language["PLANTWIZARD"]}</a>
        </form>
        <div id="searchPreview">
        </div>
    </div>
</div>
<div id="preview_pane">
    {if isset($inner_template)}
        {include file="$inner_template.tpl"}
    {else}
        Nothing here.
    {/if}
</div>
</body>
</html>