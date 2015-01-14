<div id="order_confirm" class="noPadding">
{if $isOrderSaved}
    <h2>{$language["ORDER_SAVED"]}</h2>
{else}
    <form id="orderForm" action="index.php?page=order" method="post">
        <div id="confirmOrderOverlay">
            <div id="confirmOrderDialog">
                <div id="confirmOrderHead"><h2>{$language["ORDER_TERMS_TITLE"]}</h2></div>
                <div id="confirmOrderBody">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

                    Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.

                    Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.

                    Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.

                    Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.

                    At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.

                    Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus.

                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

                    Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.

                    Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                </div>
                <div id="confirmOrderFoot">
                    <button type="button" onclick="hideConfirmOrderDlg()">{$language["ORDER_TERMS_REJECT"]}</button>
                    <button name="order" type="submit">{$language["ORDER_TERMS_ACCEPT"]}</button>
                </div>
            </div>
        </div>
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
                    </tbody>
                </table>
            </div>
            <div class="right">
                <h2>{$language["USER_SHIPPING_ADDRESS"]}</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <label>{$language["ORDER_SHIPPINGMETHOD"]}: </label>
                            </td>
                            <td>
                                <label>{$language["ORDER_SHIPPINGMETHOD_STANDARD"]}</label>
                                <input name="expressDelivery" type="radio" value="0" checked>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label>{$language["ORDER_SHIPPINGMETHOD_EXPRESS"]}</label>
                                <input name="expressDelivery" type="radio" value="1">
                            </td>
                        </tr>
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
        <button name="validate" type="button" onclick="validateOrderForm()">{$language["ORDER_CONFIRM"]}</button>
    </form>
{/if}
</div>