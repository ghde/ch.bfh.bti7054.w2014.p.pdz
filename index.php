<?php session_start(); ?>
<?php include_once('functions.php');?>
<?php include('authenticate.php');?>

<html>
	<head>
	    <link rel="stylesheet" type="text/css" media="screen" href="design.css">
		<title>Plants for your home</title>
		
		<script>
		
		
		function logoutj() {
			
			alert("<?php logout(); ?>");
			
		}
		
		</script>
		
		
	</head>

<body>

<div id="promise">

<?php echo PROMISE;?> 

<?php
				
if (isset($_COOKIE["language"]))
				
	echo "Language is" . " " . $_COOKIE["language"];
				
?>

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
		
		<a id="style_navigation_pane" href="shoppingcart.php"><?php echo CART;?><a/>
		
		<?php
	
			if (isset($_SESSION['plant']))
			
			{
		
			echo "You have ordered:" . " " . "Plant Nr." . $_SESSION['plant'];
			
			}
	
			?>
	
		</div>


	</div>

</div>



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


