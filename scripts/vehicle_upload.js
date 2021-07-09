var checkBoxes = document.getElementsByTagName("input");
var elementsValue = document.getElementById("price");
const lastElementsValueOriginal = elementsValue.innerHTML;
init();

function init() {
    for (i = 0; i < checkBoxes.length; i++) {
        if (checkBoxes[i].type == "checkbox") {
            checkBoxes[i].addEventListener("click", calculateValue, false);
        }
    }
    let amountSelectors = document.getElementsByClassName("amountSelector");
    for (i = 0; i < amountSelectors.length;i++){
        amountSelectors[i].addEventListener("change", calculateValue, false);
    }
    calculateValue();
}

function calculateValue() {
    var value = 0.0;
    for (i = 0; i < checkBoxes.length; i++) {
        if (checkBoxes[i].checked) {
            var id = checkBoxes[i].id.split("-")[1];
            var price = parseFloat(document.getElementById("item-" + id + "-price").innerText.replace("₺", ""));
            var amount  = parseInt(document.getElementById("item-" + id + "-amount").value);
            console.log(price + "-*" + amount);
            value += (price * amount);
        }
    }
    elementsValue.innerHTML = lastElementsValueOriginal.replace("@value", value);
}