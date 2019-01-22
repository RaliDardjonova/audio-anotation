
function addEvent(node, type, callback) {
  if (node.addEventListener) {
    node.addEventListener(
      type,
      function(e) {
        callback(e, e.target);
      },
      false
    );
  } else if (node.attachEvent) {
    node.attachEvent("on" + type, function(e) {
      callback(e, e.srcElement);
    });
  }
}

function shouldBeValidated(field) {
  return (
    !(field.getAttribute("readonly") || field.readonly) &&
    !(field.getAttribute("disabled") || field.disabled) &&
    (field.getAttribute("pattern") || field.getAttribute("required"))
  );
}

function instantValidation(field) {
	if (shouldBeValidated(field)) {

		var invalid =
			(field.getAttribute("required") && !field.value) ||
			(field.getAttribute("pattern") &&
				field.value &&
				!new RegExp(field.getAttribute("pattern")).test(field.value)) ||
			(field.getAttribute("name") == "confirmPassword" &&
				document.getElementById("password").value != document.getElementById("confirmPassword").value);


		if(invalid){
			if(field.getAttribute("name") == "username"){
				document.getElementById("errorUsername").innerHTML = " Моля попълнете полето с 3 до 30 символа - букви, цифри или _";
			}

			if(field.getAttribute("name") == "password"){
				document.getElementById("errorPassword").innerHTML = " Моля попълнете полето с поне 6 символа включващи поне 1 цифра, 1 малка и 1 голяма буква!";
			}

			if(field.getAttribute("name") == "confirmPassword"){
				document.getElementById("errorConfirmPassword").innerHTML = " Моля повторете горната парола";
			}
		} else {
			if(field.getAttribute("name") == "username"){
				document.getElementById("errorUsername").innerHTML = "";
			}

			if(field.getAttribute("name") == "password"){
				document.getElementById("errorPassword").innerHTML = "";
			}

			if(field.getAttribute("name") == "confirmPassword"){
				document.getElementById("errorConfirmPassword").innerHTML = "";
			}
		}

		if (!invalid && field.getAttribute("aria-invalid")) {
			field.removeAttribute("aria-invalid");
		} else if (invalid && !field.getAttribute("aria-invalid")) {
			field.setAttribute("aria-invalid", "true");
		}
	}
}

addEvent(document, 'change', function(e, target)
{
  instantValidation(target);
});
