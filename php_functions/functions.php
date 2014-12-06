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
 */
function getLanguage()
{

    // Configure available/supported languages
    $availableLang = array("de", "en");

    // Default language english
    $lang = "en";

    // Get the language from url and check if it is supported.
    if (array_key_exists("lang", $_GET)) {
        $langURL = $_GET ["lang"];
        if (in_array($langURL, $availableLang)) {
            setcookie("language", "", time() - 1);
            setcookie("language", $langURL, time() + 60);
            $lang = $langURL;
        }
    } // If not defined in url take if from the cookie (if available).
    else if (isset ($_COOKIE ["language"])) {
        $langCookie = $_COOKIE ["language"];
        if (in_array($langCookie, $availableLang)) {
            $lang = $langCookie;
        }
    }

    return $lang;
}

/**
 * Gets the appropriate language keys from session or fills it to the session.
 */
function getLanguageKeys()
{
    global $dbDao, $language;

    if (array_key_exists("lang", $_SESSION)
        && array_key_exists("lang_keys", $_SESSION)
        && $_SESSION["lang"] == $language
    ) {
        return $_SESSION["lang_keys"];
    } else {
        $languageKeys = $dbDao->getLanguageKeys();
        $_SESSION["lang"] = $language;
        $_SESSION["lang_keys"] = $languageKeys;
        return $languageKeys;
    }
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
