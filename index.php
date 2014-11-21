<?php session_start(); ?>
<?php include_once('functions.php');?>
<?php include('authenticate.php');?>
<?php include('shoppingcartfunctions.php');?>
<?php require_once('navigation.php');?>

<html>


<div id="navigation_pane">

<?php

$navigation = array
(
array("index.php?page=home", HOME),
array("index.php?page=livingroom", ROOM0),
array("index.php?page=bathroom", ROOM1),
array("index.php?page=bedroom", ROOM2),
array("index.php?page=garden", ROOM3),
array("index.php?page=stairwell", ROOM4),
array("index.php?page=pots", POTS),
array("index.php?page=fertilizers", FERTILIZERS),
array("index.php?page=accessories", ACCESSORIES)
);

$array_length = count($navigation);


for ($x=0; $x<$array_length; $x++) 
{	
	echo '<a class="navigation_pane"';
	echo 'href="';
	echo $navigation[$x][0];
	echo '">';
	echo $navigation[$x][1];
	echo '<a/>';
	echo ' ';
}

?>

</div>

<div id="preview_pane">

	<?php
	
	if(isSet($_GET['page'])) {
	
	$p = $_GET['page'];
	switch ($p){
	case "home":
		include('pages/home.php');
	break;
	case "livingroom":
		include('pages/livingroom.php');
	break;
	case "bathroom":
		include('pages/bathroom.php');
	break;
	case "bedroom":
		include('pages/bedroom.php');
	break;
	case "garden":
		include('pages/garden.php');
	break;
	case "stairwell":
		include('pages/stairwell.php');
	break;
	case "pots":
		include('pages/pots.php');
	break;
	case "fertilizers":
		include('pages/fertilizers.php');
	break;
	case "accessories":
		include('pages/accessories.php');
	break;
	default:
		include('pages/home.php');
	}
	}
	
	else 
	{
	 include ('pages/home.php');
	}
	?>

</div>


</body>
</html>


