document.addEventListener("DOMContentLoaded", loadPageCheck);

/* Validation Tools */

function validateElement(element, isValid) {
  if (isValid) {
    if (!element.classList.contains("deactive"))
      element.classList.add("deactive");
  } else if (element.classList.contains("deactive"))
    element.classList.remove("deactive");
  return isValid;
}
