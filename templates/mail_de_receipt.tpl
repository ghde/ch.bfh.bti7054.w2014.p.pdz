Hallo {$user->getFirstname()},

Hiermit bestaetigen wir den Empfang ihrer Bestellung vom {$date|date_format:"%d.%m.%Y %H.%M"}.
Eine Auftragsbestaetigung erhalten Sie in der Regeln innerhalb von 2 Arbeitstagen.

{if $cart->getPlants()|@count > 0}
    Bestellte Pflanzen:
    {foreach from=$cart->getPlants() item=plant}
        {$plant.quantity} x {$plant.product->getTitle()}
    {/foreach}
{/if}

{if $cart->getAccessories()|@count > 0}
    Bestelltes Zubehoer:
    {foreach from=$cart->getAccessories() item=accessory}
        {$accessory.quantity} x {$accessory.product->getTitle()}
    {/foreach}
{/if}

Totaler Preis:
CHF {$cart->getTotalPrice()|number_format:2:".":","}

Fuer weitere Fragen stehen wir ihnen jederzeit zur Verfuegung!

Freundliche Gruesse
Plants for your Home