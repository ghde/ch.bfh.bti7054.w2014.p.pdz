<?php

/**
 * Function which returns the available languages.
 *
 * @return array containing the available languages.
 */
function getAvailableLanguages()
{
    return array("de" => "Deutsch", "en" => "English");
}

/**
 * Function which determines the language from cookie or page attribute and stores it in a cookie again.
 * After language was detected the corresponding language file is included.
 */
function getLanguage()
{

    // Configure available/supported languages
    $availableLang = array(
        "de" => "deutsch",
        "en" => "english"
    );

    // Default language english
    $lang = "en";

    // Get the language from url and check if it is supported.
    if (array_key_exists('lang', $_GET)) {
        $langURL = $_GET ['lang'];
        if (array_key_exists($langURL, $availableLang)) {
            setcookie("language", "", time() - 1);
            setcookie("language", $langURL, time() + 60);
            $lang = $langURL;
        }
    } // If not defined in url take if from the cookie (if available).
    else if (isset ($_COOKIE ['language'])) {
        $langCookie = $_COOKIE ['language'];
        if (array_key_exists($langCookie, $availableLang)) {
            $lang = $langCookie;
        }
    }

    return $availableLang[$lang];
}

/**
 * Function which returns the navigation elements as an array.
 *
 * @return array containing all navigation elements.
 */
function getNavigationElements()
{
    global $languageKeys;

    return array(
        "home" => $languageKeys["NAVIGATION_HOME"],
        "livingroom" => $languageKeys["NAVIGATION_ROOM_LIVING"],
        "bathroom" => $languageKeys["NAVIGATION_ROOM_BATH"],
        "bedroom" => $languageKeys["NAVIGATION_ROOM_BED"],
        "garden" => $languageKeys["NAVIGATION_GARDEN"],
        "stairwell" => $languageKeys["NAVIGATION_STAIRWELL"],
        "pots" => $languageKeys["NAVIGATION_POTS"],
        "fertilizers" => $languageKeys["NAVIGATION_FERTILIZERS"],
        "accessories" => $languageKeys["NAVIGATION_ACCESSORIES"]
    );
}



define('PROMISE', 'Plants for your home - delivered to your home');
define('LOGIN', 'Login');
define('HELP', 'Help');
define('CONTACT', 'Contact');
define('CART', 'Cart');
