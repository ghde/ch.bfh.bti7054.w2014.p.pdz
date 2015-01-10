function setConfirmPattern(pattern) {
    var passwordConfirm = document.getElementById("passwordConfirm");
    passwordConfirm.pattern = pattern;
}
function validateSignUpForm(form) {

    var gender  = form.gender.value;
    if (gender == null || gender.length !== 1) {
        form.gender.focus();
        return false;
    }

    var firstName  = form.firstName.value;
    if (firstName == null || firstName.length === 0) {
        form.firstName.focus();
        return false;
    }

    var lastName = form.lastName.value;
    if (lastName == null || lastName.length === 0) {
        form.lastName.focus();
        return false;
    }

    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!regex.test(form.email.value)) {
        form.email.focus();
        return false;
    }

    var company = form.company.value;
    if (company == null || company.length === 0) {
        form.company.focus();
        return false;
    }

    regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}$/;
    if(!regex.test(form.password.value)) {
        form.password.focus();
        return false;
    }
    regex = form.password.value;
    if(!regex.test(form.passwordConfirm.value)) {
        form.passwordConfirm.focus();
        return false;
    }

    var street = form.streetName.value;
    if (street == null || street.length === 0) {
        form.streetName.focus();
        return false;
    }

    var city = form.city.value;
    if (city == null || city.length === 0) {
        form.city.focus();
        return false;
    }

    var zipCode = form.zipCode.value;
    if (zipCode == null || zipCode.length === 0) {
        form.zipCode.focus();
        return false;
    }

    var country = form.country.value;
    if (country == null || country.length === 0) {
        form.country.focus();
        return false;
    }
}
function validateOrderForm(form) {
    var street = form.streetName.value;
    if (street == null || street.length === 0) {
        form.streetName.focus();
        return false;
    }

    var city = form.city.value;
    if (city == null || city.length === 0) {
        form.city.focus();
        return false;
    }

    var zipCode = form.zipCode.value;
    if (zipCode == null || zipCode.length === 0) {
        form.zipCode.focus();
        return false;
    }

    var country = form.country.value;
    if (country == null || country.length === 0) {
        form.country.focus();
        return false;
    }
}

function searchPreview(str) {
    var preview = document.getElementById("searchPreview");
    var closeBtn = document.getElementById("previewCloseBtn");
    if (str.length < 2) {
        preview.innerHTML = "";
        preview.visibility = "hidden";
        closeBtn.visibility = "hidden";
        return;
    } else {
        preview.visibility = "visible";
        closeBtn.visibility = "visible";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                preview.innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "quickSearch.php?q=" + str, true);
        xmlhttp.send();
    }
}
function checkKey(keyEvent)
{
    var pressedKeyValue = keyEvent.keyCode;
    if(pressedKeyValue == 27)
    {
        closeSearch();
    }
}
function closeSearch(){
    searchPreview('');
}