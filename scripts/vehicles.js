var rows = document.getElementsByTagName("a");
document.addEventListener("DOMContentLoaded", loadPageCheck);
var aElements = document.getElementsByTagName("a");
var unloadDirect = document.getElementById("verify");

for (i = 0; i < rows.length; i++) {
  if (rows[i].id.startsWith("vehicle"))
    rows[i].addEventListener("click", operationClick);
}

for (i = 0; i < aElements.length; i++) {
  if (aElements[i].id.includes("unload")) aElements[i].addEventListener("click", unloadEvent);
}

function unloadEvent(event){
  unloadDirect.setAttribute("href", "loadvehicle.php?vehicle=" + this.id.split("-")[1]);
}

function operationClick(event) {
  if (this.id.includes("edit")) {
    var formElement = document.getElementById("formGroupNameOfVehicle");
    var id = this.id.split("-")[1];
    formElement.value = document.getElementById(
      "vehicle-" + id + "-name"
    ).innerText;
    document.getElementById("edit-form-submit").setAttribute("value", id);
  } else if (this.id.includes("delete")) {
    var formElement = document.getElementById("deleteFormGroupNameOfVehicle");
    var id = this.id.split("-")[1];
    formElement.value = document.getElementById(
      "vehicle-" + id + "-name"
    ).innerText;
    document.getElementById("delete-form-submit").setAttribute("value", id);
  }
}

function loadPageCheck() {
  let searchParams = new URLSearchParams(window.location.search);
  if (searchParams.has("operation") && searchParams.get("operation") == "add") {
    document.getElementById("vehicle_add").click();
  }
}

