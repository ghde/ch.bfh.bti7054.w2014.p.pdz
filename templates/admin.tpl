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
        <div class="new">
            <form action="{$url}" method="post">
                <strong>Order 1:</strong> Peter Muster, Mustergasse 22, 3201
                <ul>
                    <li>Position N</li>
                    <li>Position N+1</li>
                </ul>
                <button type="submit">confirm</button>
            </form>
        </div>
    </div>
    <div><h3>Status: confirmed</h3>
        The following orders are waiting for the customer to pay.
        <div class="confirmed">
            <form action="{$url}" method="post">
                <strong>Order 1:</strong> Peter Muster, Mustergasse 22, 3201
                <ul>
                    <li>Position N</li>
                    <li>Position N+1</li>
                </ul>
                <button type="submit">payed</button>
            </form>
        </div>
    </div>
    <div><h3>Status: payed</h3>
        The following orders are waiting for delivery.
        <div class="payed">
            <form action="{$url}" method="post">
                <strong>Order 1:</strong> Peter Muster, Mustergasse 22, 3201
                <ul>
                    <li>Position N</li>
                    <li>Position N+1</li>
                </ul>
                <button type="submit">delivered</button>
            </form>
        </div>
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