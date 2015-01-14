function cancelOrder() {
    return confirm("Are you sure that this order can be cancelled? (cannot be undone!)");
}

function toggle(elemId) {
    var aElem = document.getElementById(elemId + "_toggle"),
        divElem = document.getElementById(elemId);
    if (aElem && divElem) {
        if (divElem.className == "hidden") {
            divElem.className = "";
            aElem.innerHTML = "[hide]";
        } else {
            divElem.className = "hidden";
            aElem.innerHTML = "[show]";
        }
    }
}