<?php session_start(); ?>
<?php include_once('functions.php');?>

<html>
	<head>
	    <link rel="stylesheet" type="text/css" media="screen" href="design.css">
		<title>Plants for your home</title>
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

<Logo_and_slogan>

	<div id="logo_and_slogan">

		<img id="logo" src="Logo_Plant_Front.png" width="110" height="80" border="0">
		<h1>Plants for your home</h1>

	</div>

	<div id="sitemap">
	
		<div id="login">
		
				<a id="style_navigation_pane" href="login.html"><?php echo LOGIN;?><a/>
				<a id="style_navigation_pane" href="help.html"><?php echo HELP;?><a/>
				<a id="style_navigation_pane" href="contact.html"><?php echo CONTACT;?><a/> 
		
		</div>
	
	
		<div id="shopping_cart">
		
		<a id="style_navigation_pane" href="cart.html"><?php echo CART;?><a/>
		
		</div>


	</div>

</div>



<div id="preview_pane">


	<h3>Your Basket</h3>
	
	<?php
	
	$_SESSION['plant'] = $_GET['plant'];
	
	echo "You have ordered:" . " " . "Plant Nr." . $_SESSION['plant'];
	
	?>
	
	<div id="customizing">
	
	<h3>Continue Shopping</h3>
	
	<button type="button" onclick="window.location.href='index.php';" >Continue Shopping</button>
	
	<h3>Checkout</h3>
	
	<button type="button" onclick="window.location.href='shipping.php';" >Checkout</button>

	</div>


</div>


</body>
</html>

