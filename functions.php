<?php
	
function setlanguage() {


	if(isset($_GET['lang'])) {

		$langURL = $_GET['lang'];
	
		switch ($langURL) {
	
			case "de":
				setcookie("language", "", time()-1);
				setcookie("language", "de", time()+60);
				break;
		
			case "en":
				setcookie("language", "", time()-1);
				setcookie("language", "en", time()+60);
				break;
	
		}

	}

	if(isset($_GET['lang']) || isset($_COOKIE['language'])) {

		$lang = array_key_exists('lang', $_GET) ? $_GET['lang'] : null;
        if ($lang == null) {
        	$lang = $_COOKIE['language'];
        }
		
		switch ($lang) {
		
			case "en":
				require_once('language/english.php');
				break;
			
			case "de":
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