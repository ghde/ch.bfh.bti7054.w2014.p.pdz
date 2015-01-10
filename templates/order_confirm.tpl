<div id="order_confirm" class="noPadding">
{if $isOrderSaved}
    <h2>{$language["ORDER_SAVED"]}</h2>
{else}
    <form id="order" action="index.php?page=order" onsubmit="return validateOrderForm(this)" method="post">
        <div class="split">
            <div>
                <h2>{$language["USER_PERSONAL_INFO"]}</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <label for="firstName">{$language["USER_FIRSTNAME"]}: </label>
                            </td>
                            <td>
                                <input id="firstName" name="firstName" type="text" value="{$user->getFirstname()}" disabled />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="lastName">{$language["USER_LASTNAME"]}: </label>
                            </td>
                            <td>
                                <input id="lastName" name="lastName" type="text" value="{$user->getLastname()}" disabled />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">{$language["USER_EMAIL"]}: </label>
                            </td>
                            <td>
                                <input id="email" name="email" type="text" value="{$user->getUsername()}" disabled />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">{$language["USER_EMAIL"]}: </label>
                            </td>
                            <td>
                                <input id="email" name="email" type="text" value="{$user->getUsername()}" disabled />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="right">
                <h2>{$language["USER_SHIPPING_ADDRESS"]}</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <label for="streetName">{$language["USER_STREET"]}: </label>
                            </td>
                            <td>
                                <input id="streetName" name="streetName" type="text" value="{$inner_address->getStreetName()}" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="zipCode">{$language["USER_PLZ"]}: </label>
                            </td>
                            <td>
                                <input id="zipCode" name="zipCode" type="text" value="{$inner_address->getZipCode()}" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="city">{$language["USER_CITY"]}: </label>
                            </td>
                            <td>
                                <input id="city" name="city" type="text" value="{$inner_address->getCity()}" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="country">{$language["USER_COUNTRY"]}: </label>
                            </td>
                            <td>
                                <input id="country" name="country" type="text" value="{$inner_address->getCountry()}" required />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="saveAddress">{$language["ORDER_SAVEADDRESS"]}: </label>
                                <input type="checkbox" name="saveAddress" value="TRUE" checked />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <input type="submit" name="order" value="{$language["ORDER_CONFIRM"]}" />
    </form>
{/if}
</div>