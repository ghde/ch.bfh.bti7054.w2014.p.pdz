{if $isOrderSaved}
    <div>{$language["ORDER_SAVED"]}</div>
{elseif !$user->isLoggedIn()}
    <div>{$language["ORDER_NOTLOGGEDIN"]}</div>
{else}
    <form id="order" action="index.php?page=order" onsubmit="return validateOrderForm(this)" method="post">
        <div class="split">
            <div>
                <h3>{$language["ORDER_PERSONAL_INFO"]}</h3>

                <label for="firstname">{$language["ORDER_FIRSTNAME"]}</label><br/>
                <input id="firstname" name="firstname" type="text" value="{$user->getFirstname()}"/><br/>

                <label for="lastname">{$language["ORDER_LASTNAME"]}</label><br/>
                <input id="lastname" name="lastname" type="text" value="{$user->getLastname()}"/><br/>

                <label for="email">{$language["ORDER_EMAIL"]}</label><br/>
                <input id="email" name="email" type="text"/>
            </div>
            <div>
                <h3>{$language["ORDER_SHIPPING_ADDRESS"]}</h3>

                <label for="street">{$language["ORDER_STREET"]}</label><br/>
                <input id="street" name="street" type="text"/><br/>

                <label for="city">{$language["ORDER_CITY"]}</label><br/>
                <input id="city" name="city" type="text"/><br/>

                <label for="city">{$language["ORDER_PLZ"]}</label><br/>
                <input id="city" name="city" type="text"/><br/>

                <label for="country">{$language["ORDER_COUNTRY"]}</label><br/>
                <select id="country" name="country">
                    <option value="Switzerland">Switzerland</option>
                    <option value="Germany">Germany</option>
                    <option value="Austria" selected>Austria</option>
                </select>
            </div>
            <div>
                <h3>{$language["ORDER_COMMENT"]}</h3>
                <textarea id="comment" name="comment" rows="10" cols="30">Put your comment in here.</textarea><br/>


            </div>
        </div>
        <button type="submit" name="order">{$language["ORDER_CONFIRM"]}</button>
    </form>
{/if}
