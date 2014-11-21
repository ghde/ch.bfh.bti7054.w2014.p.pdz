<?php session_start(); ?>
<?php include_once('functions.php');?>
<?php include('authenticate.php');?>
<?php include('shopping_functions.php');?>
<?php require_once('navigation.php');?>

<html>

<div id="preview_pane">


	<div id="preview_image">
	

	<?php

	switch ($_GET['plant']){
	case "1":
		$plant_image = 'plant1.jpg';
	break;
	case "2":
		$plant_image = 'plant2.jpg';
	break;
	case "3":
		$plant_image = 'plant3.jpg';
	break;
	case "4":
		$plant_image = 'plant4.jpg';
	break;
	case "5":
		$plant_image = 'plant5.jpg';
	break;
	case "6":
		$plant_image = 'plant6.jpg';
	break;
	case "7":
		$plant_image = 'plant7.jpg';
	break;
	case "8":
		$plant_image = 'plant8.jpg';
	break;
	case "9":
		$plant_image = 'plant9.jpg';
	break;
		}

	echo '<img id="logo" src="' . $plant_image . '"width="400" height="400" border="0">';
		
	?>
	
	Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam 		voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum 	dolor sit 		amet.
	
	</div>
	
	<div id="customizing">
	
	<h3>Shipping</h3>
	
	<form name="input" action="shoppingcart.php" method="get">
		<input type="radio" name="shipping" value="express">Express Versand<br>
		<input type="radio" name="shipping" value="normal">Normaler Versand
	
	<h3>Expansion</h3>
	
	<input type="hidden" name="plant" value="<?php $plant = $_GET['plant']; echo $plant;?>">
	<input type="checkbox" name="addons" value="pot">Mit Topf<br>
	<input type="checkbox" name="addons" value="wpot">Ohne Topf<br>
	<input type="checkbox" name="addons" value="spot">Mit Plantaflor<br>
	<br>
	<input type="submit" value="Submit">
	</form>	
	
	
	</div>


</div>


</body>
</html>

