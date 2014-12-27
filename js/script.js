
function validateOrderForm(form) {
    var fname = form.firstname.value;
    if (fname == null || fname == "") {
        alert("First name must be filled out");
        return false;
    }

    var lname = form.lastname.value;
    if (lname == null || lname == "") {
        alert("Laste name must be filled out");
        return false;
    }

    var email = form.email.value;
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
        alert("Not a valid e-mail address");
        return false;
    }

    var streetn = form.shipping.value;
    if (streetn == null || streetn == "") {
        alert("Street name must be filled out");
        return false;
    }

    var cityn = form.city.value;
    if (cityn == null || cityn == "") {
        alert("City must be filled out");
        return false;
    }

    var cityc = form.citycode.value;
    if (cityc == null || cityc == "") {
        alert("City code must be provided");
        return false;
    }

    var countryn = form.country.value;
    if (countryn == null || countryn == "") {
        alert("City code must be provided");
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
        xmlhttp.open("GET", "search.php?q=" + str, true);
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