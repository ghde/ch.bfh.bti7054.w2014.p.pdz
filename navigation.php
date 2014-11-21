<html>
<head>

    <link rel="stylesheet" type="text/css" media="screen" href="design.css">
    <title>Plants for your home</title>

    <script>

        function logoutj() {

            <?php logout();?>

            alert("now logged out");
        }

    </script>

</head>

<body>

<div id="promise">

    <?php echo PROMISE;?>

    <div id="languages">

        <a href="?lang=de">&raquo; Deutsch<a/>
            <a href="?lang=en">&raquo; English<a/>

    </div>

</div>


<div id="company">

    <!Logo_and_slogan>

    <div id="logo_and_slogan">

        <img id="logo" src="pictures/Logo_Plant_Front.png" width="110" height="80" border="0">
        <h1>Plants for your home</h1>

    </div>

    <div id="sitemap">

        <div id="login">

            <a id="style_navigation_pane" href="login.html"><?php echo LOGIN;?><a/>

                <?php

                if(isset($_SESSION['user'])) {
                    echo 'Hello' . ' ' . $_SESSION['user'];
                }

                else {

                    echo '<form action="index.php" method="post">';
                    echo '<input name= "user"/>User Name <br/>';
                    echo '<input type= "password" name="pw"/> Password <br/>';
                    echo '<input type="submit" value="Login"/> <br/>';

                }

                ?>

                <button type=button onclick="logoutj()">Logout!</button>


                <a id="style_navigation_pane" href="help.html"><?php echo HELP;?><a/>
                    <a id="style_navigation_pane" href="contact.html"><?php echo CONTACT;?><a/>
        </div>



        <div id="shopping_cart">

            <a id="style_navigation_pane" href="cart.html"><?php echo CART;?></a>

                <?php


                if (isset($_SESSION['shoppingcart']))

                {

                    foreach ($_SESSION['shoppingcart'] as $key => $plant) {

                        echo "<br>";
                        echo "You have ordered: " . $plant['name'];
                        echo "<button type='button'";
                        echo "onclick=";
                        echo '"' . "window.location.href=" . "'" . "customize.php?remove_plant=". $key . "'" . ";" . '"' . ">Removal</button>";
                    }
                }

                ?>

        </div>


    </div>

</div>
