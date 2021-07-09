var allSelectCheckBox = document.getElementById("allSelect");
var checkBoxes = document.getElementsByClassName("selectNode");
var elementsValue = document.getElementById("elementsValue");
const lastElementsValueOriginal = elementsValue.innerHTML;
init();

function init(){
    allSelectCheckBox.addEventListener("click", checkBoxListener);
    for (i = 0; i < checkBoxes.length; i++) {
        checkBoxes[i].addEventListener("click", singleCheckBoxClick, false);
    }
    
    calculateValue();
}

function checkBoxListener(event){
    for (i = 0; i < checkBoxes.length; i++) {
        checkBoxes[i].checked = allSelectCheckBox.checked;
    }
    calculateValue();
}

function singleCheckBoxClick(){
    if(!this.checked && allSelectCheckBox.checked) allSelectCheckBox.checked = false;
    if(this.checked && !allSelectCheckBox.checked) {
        var broke = false;
        for (i = 0; i < checkBoxes.length; i++) {
            if(!checkBoxes[i].checked){
                broke = true;
                break;
            }
        }
        if(!broke) allSelectCheckBox.checked = true;
    }
    calculateValue();
}

function calculateValue(){
    var value = 0.0;
    for (i = 0; i < checkBoxes.length; i++) {
        if(checkBoxes[i].checked){
            value += parseFloat(document.getElementById(checkBoxes[i].id + "-value").innerHTML.replace("₺", ""));
        }
    }
    elementsValue.innerHTML = lastElementsValueOriginal.replace("@value", value);
}