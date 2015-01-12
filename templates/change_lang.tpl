<div id="changeLang">
    <div class="errors">
        <div class="lang">
            <h3>Information in Deutsch</h3>
            <ul>
                {if $inner_isLoggedIn}
                    <li>Sie sind aktuell eingeloggt. Beim wechseln der Sprache werden Sie automatisch ausgeloggt!</li>
                {/if}
                {if $inner_hasShoppingCartItems}
                    <li>Ihr Warenkorb ist gefüllt. Beim wechseln der Sprache wird Ihr Warenkorb geleert!</li>
                {/if}
            </ul>
            <div class="force">
                Sprache trotzdem auf "{$inner_newLang}" <a
                        href="index.php?page=changelang&amp;lang={$inner_newLangKey}&amp;force=true">&auml;ndern</a>! Oder zur&uuml;ck
                zur <a href="index.php?page=home">Startseite</a>.
            </div>
        </div>
        <div class="lang">
            <h3>Information in English</h3>
            <ul>
                {if $inner_isLoggedIn}
                    <li>You are currently logged in. When you switch the language you will be automatically logged out!
                    </li>
                {/if}
                {if $inner_hasShoppingCartItems}
                    <li>Your shopping cart is filled. When you switch the language your shopping cart will be cleared
                        out!
                    </li>
                {/if}
            </ul>
            <div class="force">
                <a href="index.php?page=changelang&amp;lang={$inner_newLangKey}&amp;force=true">Switch</a> the language
                to "{$inner_newLang}" anyway! Or go back to <a href="index.php?page=home">start page</a>.
            </div>
        </div>
    </div>
</div>