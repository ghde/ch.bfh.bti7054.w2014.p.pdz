<?php
	
	function setlanguage() {


	if(isset($_GET['lang'])) {

	$langURL = $_GET['lang'];

	switch ($langURL) {

	case "de":
	setcookie("language", "", time()-1);
	setcookie("language", "deutsch", time()+60);
	break;

	case "en":
	setcookie("language", "", time()-1);
	setcookie("language", "english", time()+60);
	break;

	}

	}


	if(isset($_COOKIE['language'])) {
		
		$lang = $_COOKIE['language'];
		
		switch ($lang) {
		
		case "english":
		require_once('language/english.php');
		break;
		
		case "deutsch":
		require_once('language/deutsch.php');
		break;
		}
		
		}

	else {
			
		require_once('language/english.php');
			
		}

	}
	
	setlanguage();
?>