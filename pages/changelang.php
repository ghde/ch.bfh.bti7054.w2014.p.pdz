<?php
if (array_key_exists("lang", $_GET) && array_key_exists($_GET["lang"], getAvailableLanguages())) {
    if ($language == $_GET["lang"]) {

        // Language is already correct, nothing to do.
        header("Location: index.php?page=home");

    } else if (array_key_exists("force", $_GET)) {

        // Language switch is enforced by url, so do it.
        forceLanguageSwitch($_GET["lang"]);

    } else if ($user->isLoggedIn() || count($shoppingCart->getAccessories()) > 0 || count($shoppingCart->getPlants()) > 0) {

        // Check if the user is logged in or has items im shopping cart
        // ... inform user that he will be logged out
        // ... and his shopping cart will be cleaned
        $smarty->assign('inner_newLang', getAvailableLanguages()[$_GET["lang"]]);
        $smarty->assign('inner_newLangKey', $_GET["lang"]);
        $smarty->assign('inner_template', 'change_lang');
        $smarty->assign("inner_isLoggedIn", $user->isLoggedIn());
        $smarty->assign("inner_hasShoppingCartItems", count($shoppingCart->getAccessories()) > 0 || count($shoppingCart->getPlants()) > 0);

    } else if (array_key_exists("lang", $_GET)) {

        // Force the switch of language
        forceLanguageSwitch($_GET["lang"]);
    }
} else {

    // Unspecified action, redirect to home
    header("Location: index.php?page=home");
}