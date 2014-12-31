
function validateOrderForm(form) {
    var street = form.streetName.value;
    if (street == null || street.length === 0) {
        return false;
    }

    var city = form.city.value;
    if (city == null || city.length === 0) {
        return false;
    }

    var zipCode = form.zipCode.value;
    if (zipCode == null || zipCode.length === 0) {
        return false;
    }

    var country = form.country.value;
    if (country == null || country.length === 0) {
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