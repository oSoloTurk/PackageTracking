var loaded = false;

document.addEventListener("DOMContentLoaded", function () {
    loaded = true;
    loadPageCheck();
});

function loadPageCheck() {
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has("msg")) swapPage(searchParams.get("msg"));
}

