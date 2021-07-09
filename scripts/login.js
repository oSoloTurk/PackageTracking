var emailElement = document.getElementById("formGroupEmailInput");
var passwordElement = document.getElementById("formGroupPasswordInput");
var emailValidation = false;
var passwordValidation = false;

emailElement.onkeydown = emailElement.onkeyup = emailElement.onkeypress = function () {
  var validationElement = document.getElementById("vld-email");
  if (!validateElement(validationElement, validateEmail(emailElement.value)))
    emailValidation = false;
  else emailValidation = true;
  checkValidations();
};

passwordElement.onkeydown = passwordElement.onkeyup = passwordElement.onkeypress = function () {
  var validationElementChar = document.getElementById("vld-password-char");
  var validationElementLength = document.getElementById("vld-password-length");
  if (
    !validateElement(
      validationElementLength,
      passwordElement.value.length >= 8
    ) ||
    !validateElement(
      validationElementChar,
      validatePassword(passwordElement.value)
    )
  )
    passwordValidation = false;
  else passwordValidation = true;
  checkValidations();
};

function checkValidations() {
  if (emailValidation && passwordValidation)
    document.getElementById("btn-login").classList.remove("disabled");
  else {
    var btn_login = document.getElementById("btn-login");
    if (!btn_login.classList.contains("disabled"))
      btn_login.classList.add("disabled");
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

function validatePassword(password) {
  return password.match(/([a-zA-Z])+([ -~])*/);
}
