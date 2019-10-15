function clickMenu() {
	var menu = document.getElementById("menu");
	var sidemenu = document.getElementById("sidemenu");
	var session = document

	if(menu.className === "open") {
		menu.className = "close";
        sidemenu.style.width = "0em";
        sidemenu.style.minWidth = "0em";
		return;
	}

	menu.className = "open";
    sidemenu.style.width = "25%";
    sidemenu.style.minWidth = "10em";
}

function calculate() {
	var remaining_amounts = document.getElementsByClassName("remaining_amount");
	var debtRemaining = 0;
	for (var index = 1; index < remaining_amounts.length; index++) {
		debtRemaining += remaining_amounts[index].value;
	}
	document.getElementById("sumAmount").value = debtRemaining;
}