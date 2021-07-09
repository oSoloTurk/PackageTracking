var rows = document.getElementsByTagName("a");
document.addEventListener("DOMContentLoaded", loadPageCheck);

for (i = 0; i < rows.length; i++) {
  if (rows[i].id.startsWith("item"))
    rows[i].addEventListener("click", operationClick);
}

function operationClick(event) {
  if (this.id.includes("edit")) {
    var id = this.id.split("-")[1];
    document.getElementById("formGroupNameOfItem").value = document.getElementById(
      "item-" + id + "-name"
    ).innerText;
    document.getElementById("formGroupPriceOfItem").value = document.getElementById(
      "item-" + id + "-price"
    ).innerText.replace("₺", "");
    document.getElementById("formGroupDescOfItem").value = document.getElementById(
      "item-" + id + "-desc"
    ).innerText;
    document.getElementById("edit-form-submit").setAttribute("value", id);
  } else if (this.id.includes("delete")) {
    var id = this.id.split("-")[1];
    document.getElementById("deleteFormGroupNameOfItem").value = document.getElementById(
      "item-" + id + "-name"
    ).innerText;
    document.getElementById("deleteFormGroupPriceOfItem").value = document.getElementById(
      "item-" + id + "-price"
    ).innerText.replace("₺", "");
    document.getElementById("deleteFormGroupDescOfItem").value = document.getElementById(
      "item-" + id + "-name"
    ).innerText;
    document.getElementById("delete-form-submit").setAttribute("value", id);
  }
}

function loadPageCheck() {
  let searchParams = new URLSearchParams(window.location.search);
  if (searchParams.has("operation") && searchParams.get("operation") == "add") {
    document.getElementById("product_add").click();
  }
}

