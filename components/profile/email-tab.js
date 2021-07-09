/* Email Page Fields */
var email_emailElement = document.getElementById("formGroupNewMailInput");
var email_button = document.getElementById("btn-newemail");
var email_error_mail = document.getElementById("vld-email-email");
var email_emailValidation = false;

/* Email Page Events */
email_emailElement.onkeyup = function () {
    if (
        !validateElement(email_error_mail, validateEmail(email_emailElement.value))
    )
        email_emailValidation = false;
    else email_emailValidation = true;
    email_checkValidations();
};

/* Email Page Functions */
function email_checkValidations() {
    if (email_emailValidation) email_button.classList.remove("disabled");
    else {
        if (!email_button.classList.contains("disabled"))
            email_button.classList.add("disabled");
    }
}

function validateElement(element, isValid) {
    if (isValid) {
        if (!element.classList.contains("deactive"))
            element.classList.add("deactive");
    } else if (element.classList.contains("deactive"))
        element.classList.remove("deactive");
    return isValid;
}

function validateEmail(email) {
    const re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}