var toast = document.getElementById("toastBar")

function toastMessage(message) {
    if (typeof (history.pushState) != "undefined") {
        var obj = { Title: document.title, Url: window.parent.location.pathname };
        history.pushState(obj, obj.Title, obj.Url);
    } else {
        window.parent.location = window.parent.location.pathname;
    }
    toast.innerText = message;
    toast.className = "show";
    setTimeout(function () {
        toast.className = toast.className.replace("show", "");
    }, 3000);
}