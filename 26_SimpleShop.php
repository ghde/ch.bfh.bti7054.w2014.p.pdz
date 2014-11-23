<?php
	include("Cart.inc.php");
	session_start();
	if (!isset($_SESSION["cart"]))
		$_SESSION["cart"] = new Cart;
	if (isset($_GET["art"]) && isset($_GET["num"]))
		$_SESSION["cart"]->addItem($_GET["art"],$_GET["num"]);
?>
<html><body>
	<h3>Shopping Cart:</h3>
	<?php $_SESSION["cart"]->display(); ?>
	<form action="26_SimpleShop.php" method="get">
		<input name="art" />Article<br />
		<input name="num" value="1" />Items<br />
		<input type="submit" value="Add" />
	</form>
</body></html>
