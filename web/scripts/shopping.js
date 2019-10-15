function validateFields(event) {
	var error = "";
	var fName = document.getElementById("first_name");
	var lName = document.getElementById("last_name");
	var phone = document.getElementById("phone");
	var address = document.getElementById("address");
	var credit_card = document.getElementById("credit_card");
	var exp_date = document.getElementById("exp_date");

	var regexPhone = /[2-9]{1}\d{2}[-][2-9]{1}\d{2}[-][0-9]{4}$/
	var regexCCard = /^([0-9]{16})/;
	var regexDate = /^(0?[1-9]|1[012])[\/\-]\d{4}$/;
	if(fName.value === "") {		
		error = "Please enter your first name.";
		setError(error, "first_name");
		return false;
	}
	if(lName.value === "") {
		error = "Please enter your last name.";
		setError(error, "last_name");
		return false;
	}
	if(!phone.value.match(regexPhone)) {
		error = "Please enter a valid phone number (555-555-5555).";
		setError(error, "phone");
		return false;
	}
	if(address.value === "") {
		error = "Please enter your address.";
		setError(error, "address");
		return false;
	}
	if(!credit_card.value.match(regexCCard)) {
		error = "Please enter a valid credit card number.";
		setError(error, "credit_card");
		return false;
	}
	if(!exp_date.value.match(regexDate)) {
		error = "Please enter a valid expiration date (mm/yyyy).";
		setError(error, "exp_date");
		return false;
	}	

	
}

function setError(error, elementFocus) {
	document.getElementById("error").innerHTML = error;
    setFocus(elementFocus);
    return false;
}

function recalculate() {
	var cnt;
	var total = 0;
	var items = document.getElementsByClassName("item");
	for(cnt = 0; cnt < items.length; cnt += 1) {
		if(items[cnt].checked === true) {
			total += parseFloat(items[cnt].value);
		}
	}
	var orderTotal = document.getElementById("total");
	orderTotal.value = total.toFixed(2);
}

function setFocus(id) {
	document.getElementById(id).focus();
}


