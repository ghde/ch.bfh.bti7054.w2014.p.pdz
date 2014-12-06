<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Plants for your home</title>
    <link rel="stylesheet" type="text/css" media="screen" href="design.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/design.css"/>
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<div id="promise">
    {$language["OUR_PROMISE"]}
    <div id="languages">
        {foreach from=$languages key=short item=label}
            <a href="?lang={$short}">&raquo; {$label}</a>
        {/foreach}
    </div>
</div>
<div id="company">
    <div id="logo_and_slogan">
        <img id="logo" src="pictures/Logo_Plant_Front.png" width="110" height="80" border="0"/>

        <h1>Plants for your home</h1>
    </div>
    <div id="sitemap">
        <div id="login">
            {if $user->isLoggedIn()}
                {$language["LOGIN_HELLO"]} {$user->getFirstname()} {$user->getLastname()}
                <form action="{$url}" method="post">
                    <button type="submit" name="logout">Logout!</button>
                </form>
            {else}
                <form action="{$url}" method="post">
                    <label for="username">{$language["LOGIN_FORM_USERNAME"]}</label>
                    <input id="username" name="username" type="text" l/>
                    <label for="password">{$language["LOGIN_FORM_PASSWORD"]}</label>
                    <input id="password" name="password" type="password"/>
                    <button type="submit" name="login">{$language["LOGIN_FORM_LOGIN"]}</button>
                </form>
                {if $user->isFailedLoginTry()}
                    <span class="failedlogin"><strong>{$language["LOGIN_ERROR_HINT"]}
                            :</strong> {$language["LOGIN_ERROR_TEXT"]}</span>
                {/if}
            {/if}
        </div>
        <div id="shopping_cart">
            <div class="title">{$language["SHOPPING_CART_NAME"]}</div>
            {if $cart_items|@count == 0}
                {$language["SHOPPING_CART_NO_ITEMS"]}
            {else}
                {foreach from=$cart_items key=plantId item=plant}
                    <form method="POST" action="index.php?page=removefromcart">
                        <input type="hidden" name="plantID" value="{$plantId}"/>

                        <div>{$plant.num} x <strong>{$plant.name}</strong>
                            <button type="submit">X</button>
                        </div>
                    </form>
                {/foreach}
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
        <a href="index.php?page={$name}" class="navigation_pane">{$label}</a>
    {/foreach}
</div>
<div id="preview_pane">
    {include file="$inner_template.tpl"}
</div>
</body>
</html>