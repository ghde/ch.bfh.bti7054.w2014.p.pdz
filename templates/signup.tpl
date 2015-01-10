<div id="signup" class="noPadding">
<form id="user" action="index.php?page=signup" onsubmit="return validateSignUpForm(this)" method="POST">
    <h1>{$language["SIGNUP_TITLE"]}</h1>
    <div class="split">
        <div>
            <h2>{$language["USER_PERSONAL_INFO"]}</h2>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <label for="gender">{$language["USER_GENDER"]}: </label>
                        </td>
                        <td>
                            <select name="gender" required>
                                <option value="m">{$language["USER_MALE"]}</option>
                                <option value="f">{$language["USER_FEMALE"]}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="firstName">{$language["USER_FIRSTNAME"]}: </label>
                        </td>
                        <td>
                            <input id="firstName" name="firstName" type="text" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="lastName">{$language["USER_LASTNAME"]}: </label>
                        </td>
                        <td>
                            <input id="lastName" name="lastName" type="text" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">{$language["USER_EMAIL"]}: </label>
                        </td>
                        <td>
                            <input id="email" name="email" type="email" required
                                   pattern='(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{ldelim}1,3{rdelim}\.[0-9]{ldelim}1,3{rdelim}\.[0-9]{ldelim}1,3{rdelim}\.[0-9]{ldelim}1,3{rdelim}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{ldelim}2,{rdelim}))' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="usrCompany">{$language["USER_COMPANY"]}: </label>
                        </td>
                        <td>
                            <input id="usrCompany" name="company" type="text" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">{$language["SIGNUP_PASSWORD"]}: </label>
                        </td>
                        <td>
                            <input id="password" name="password" type="password"
                                   required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{ldelim}4,10{rdelim}"
                                   onchange="setConfirmPattern(this.value)" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="passwordConfirm">{$language["SIGNUP_PASSWORD_CONFIRM"]}: </label>
                        </td>
                        <td>
                            <input id="passwordConfirm" name="passwordConfirm" type="password" required />
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
                            <input id="streetName" name="streetName" type="text" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="zipCode">{$language["USER_PLZ"]}: </label>
                        </td>
                        <td>
                            <input id="zipCode" name="zipCode" type="number" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="city">{$language["USER_CITY"]}: </label>
                        </td>
                        <td>
                            <input id="city" name="city" type="text" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="country">{$language["USER_COUNTRY"]}: </label>
                        </td>
                        <td>
                            <input id="country" name="country" type="text" required />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <input type="submit" name="userSignUp" value="{$language["SIGNUP"]}" />
</form>
</div>