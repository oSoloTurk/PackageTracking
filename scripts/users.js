var fromPopup = false;

function openTab(to, name) {
    fromPopup = true;
    const w = window.screen.width * 0.65;
    const h = window.screen.height * 0.85;
    const y = window.top.outerHeight / 2 + window.top.screenY - (w / 2);
    const x = window.top.outerWidth / 2 + window.top.screenX - (h / 2);
    return window.open(to, name, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
}

document.body.onfocus = function () {
    if (fromPopup) {
        location.reload();
        fromPopup = false;
    }
};

document.addEventListener("DOMContentLoaded", loadPageCheck);


function loadPageCheck() {
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has("operation") && searchParams.get("operation") == "add") {
        document.getElementById("user_add").click();
        location.href = location.href.replace("?operation=add", "");
    }
}