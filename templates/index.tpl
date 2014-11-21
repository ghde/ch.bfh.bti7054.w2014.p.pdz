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
            <a id="style_navigation_pane" href="login.html"></a>
            <a id="style_navigation_pane" href="help.html"></a>
            <a id="style_navigation_pane" href="contact.html"></a>
        </div>
        <div id="shopping_cart">
            <a id="style_navigation_pane" href="cart.html"></a>
        </div>
    </div>
</div>
<div id="preview_pane"></div>
</body>
</html>