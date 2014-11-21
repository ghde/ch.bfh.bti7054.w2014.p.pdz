<?php

if(isset($_POST["user"])) {

if($_POST["user"]=="John" && $_POST["pw"]=="php"
|| $_POST["user"]=="Alice" && $_POST["pw"]=="mysql") 
	{ $_SESSION["user"]=$_POST["user"];
} 

}

function logout() {

session_destroy();

}

?>