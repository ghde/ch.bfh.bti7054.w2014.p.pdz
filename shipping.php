<?php include_once('functions.php');?>

<html>
	<head>
	    <link rel="stylesheet" type="text/css" media="screen" href="design.css">
		<title>Plants for your home</title>
		
<script>

function validateForm()
{
	var fname = document.forms["shippinginfo"]["firstname"].value;
	if (fname==null || fname=="")
	{
		alert("First name must be filled out");
		return false;
		}
		
	var lname = document.forms["shippinginfo"]["lastname"].value;
	if (lname==null || lname=="")
	{
		alert("Laste name must be filled out");
		return false;
	}
	
	var email=document.forms["shippinginfo"]["email"].value;
	var atpos=email.indexOf("@");
	var dotpos=email.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
	{
		alert("Not a valid e-mail address");
		return false;
	}
	
	var streetn = document.forms["shippinginfo"]["shipping"].value;
	if (streetn==null || streetn=="")
	{
		alert("Street name must be filled out");
		return false;
	}
	
	var cityn = document.forms["shippinginfo"]["city"].value;
	if (cityn==null || cityn=="")
	{
		alert("City must be filled out");
		return false;
	}
	
	var cityc = document.forms["shippinginfo"]["citycode"].value;
	if (cityc==null || cityc=="")
	{
		alert("City code must be provided");
		return false;
	}
	
	var countryn = document.forms["shippinginfo"]["country"].value;
	if (countryn==null || countryn=="")
	{
		alert("City code must be provided");
		return false;
	}
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

<?php 

$vaddons = $_GET['addons'];
$vshipping = $_GET['shipping'];

echo 'You have chosen: ' . $vshipping;
echo '<br>';
echo 'You have chosen: ' . $vaddons;


?>


<h3>Enter your personal information:</h3>

<form name="shippinginfo" id="shippinginfo" action="confirmation.php" onsubmit="return validateForm()" method="get">
<input type="hidden" name="shipping" value="<?php $vshipping = $_GET['shipping']; echo $vshipping;?>">
<input type="hidden" name="addons" value="<?php $vaddons = $_GET['addons']; echo $vaddons;?>"> 
<div class="attribute"><label for="firstname">First name: </label> <input id="firstname" type="text" name="firstname"></div>
<div class="attribute"><label for="lastname">Last name:</label> <input type="text" name="lastname"></div>

<div class="attribute"><label for="email">E-Mail:</label> <input type="text" name="email"></div>
<h3>Shipping Address</h3>
Street name: <input type="text" name="shipping"> <br>
City: <input type="text" name="city"> <br>
Post Code: <input type="text" name="citycode"> <br>
Country: 
<select name="country">		
<option value="Switzerland">Switzerland</option>
<option value="Germany">Germany</option>
<option value="Austria" selected>Austria</option><br>
Comment:
<textarea rows="10" cols="30">
Put your comment in here
</textarea> <br>
<input type="submit" value="Submit">
</form>

</div>


</body>
</html

