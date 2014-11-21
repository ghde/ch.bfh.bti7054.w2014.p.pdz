<?php include_once('functions.php');?>
<?php include_once('php_functions/functions.php');?>
<?php include('php_functions/authenticate.php');?>
<?php include('php_functions/shopping_functions.php');?>

<html>
	<head>
	    <link rel="stylesheet" type="text/css" media="screen" href="design.css">
		<title>Plants for your home</title>
		
		<script type="text/javascript">
			function agreement() 
			{
				var decision;
				decision = window.confirm("You are about to enter a binding contract. Are you sure you want to proceed with this order?");
		
				if (decision) {
					window.alert("You will receive an email");	
				}
				else {
					location.href = "index.php";		
				}
		
			}
		</script>
	</head>

<body onload="agreement()">

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
				<a id="style_navigation_pane" href="help.html"><?php echo HELP;?><a/>
				<a id="style_navigation_pane" href="contact.html"><?php echo CONTACT;?><a/> 
		
		</div>
	
	
		<div id="shopping_cart">
		
		<a id="style_navigation_pane" href="cart.html"><?php echo CART;?><a/>
		
		</div>


	</div>

</div>



<div id="preview_pane">

<?php
$vaddons = $_GET['addons'];
$vshipping = $_GET['shipping'];

echo 'You have chosen: ' . $vshipping;
echo '<br>';
echo 'You have chosen: ' . $vaddons;

echo 'Your name is' . ' ' . $_GET['firstname'] . ' ' . $_GET['lastname'];
?>




</div>


</body>
</html>

