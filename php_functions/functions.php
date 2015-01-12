<?php

/**
 * Function which returns the available languages.
 *
 * @return array containing the available languages.
 */
function getAvailableLanguages()
{
    return array("en" => "English", "de" => "Deutsch");
}

/**
 * Function which determines the language from cookie or page attribute and stores it in a cookie again.
 */
function getLanguage()
{
    // Default language english
    $lang = "en";

    // Get the language from the cookie.
    if (array_key_exists("language", $_COOKIE)) {
        $langCookie = $_COOKIE ["language"];
        if (array_key_exists($langCookie, getAvailableLanguages())) {
            $lang = $langCookie;

            // Update the Cookie and make it live for longer
            setLanguageCookie($lang);
        }
    }

    return $lang;
}

/**
 * Function which forces the language switch.
 *
 * @param $lang the language to switch to.
 */
function forceLanguageSwitch($lang)
{
    setLanguageCookie($lang);
    session_destroy();
    header("Location: index.php?page=home");
}

/**
 * @param $lang the language for the cookie
 */
function setLanguageCookie($lang)
{
    $cookieLifetime = 60 * 3600;
    setcookie("language", $lang, time() + $cookieLifetime);
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
        //"pots" => $languageKeys["NAVIGATION_POTS"],
        //"fertilizers" => $languageKeys["NAVIGATION_FERTILIZERS"],
        "accessories" => $languageKeys["NAVIGATION_ACCESSORIES"]
    );
}
