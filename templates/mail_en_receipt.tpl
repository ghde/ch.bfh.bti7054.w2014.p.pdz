Dear {$user->getFirstname()},

We confirm that we received the following order of {$date|date_format:"%d.%m.%Y %H.%M"}.
You will receive an order confirmation withing two working days.

{if $cart->getPlants()|@count > 0}
    Plants ordered:
    {foreach from=$cart->getPlants() item=plant}
        {$plant.quantity} x {$plant.product->getTitle()}
    {/foreach}
{/if}

{if $cart->getAccessories()|@count > 0}
    Accessories ordered:
    {foreach from=$cart->getAccessories() item=accessory}
        {$accessory.quantity} x {$accessory.product->getTitle()}
    {/foreach}
{/if}

Total price:
CHF {$cart->getTotalPrice()|number_format:2:".":","}

Don't hesitate to contact us in case of any questions!

Sincerely,
Plants for your Home