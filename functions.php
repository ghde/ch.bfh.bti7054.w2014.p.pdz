<?php
function setlanguage() {
    
    // Configure available/supported languages
    $availableLang = array (
            'de' => 'deutsch',
            'en' => 'english' 
    );
    
    // Default language english
    $lang = "en";
    
    // Get the language from url and check if it is supported.
    if (array_key_exists ( 'lang', $_GET )) {
        $langURL = $_GET ['lang'];
        if (array_key_exists ( $langURL, $availableLang )) {
            setcookie ( "language", "", time () - 1 );
            setcookie ( "language", $langURL, time () + 60 );
            $lang = $langURL;
        }
    } 
    
    // If not defined in url take if from the cookie (if available).
    else if (isset ( $_COOKIE ['language'] )) {
        $langCookie = $_COOKIE ['language'];
        if (array_key_exists ( $langCookie, $availableLang )) {
            $lang = $langCookie;
        }
    }
    
    require_once "language/" . $availableLang[$lang]. ".php";
}
setlanguage ();
?>