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
	var debtRemaining = document.getElementsByClassName("remaining_amount");
	for (var i = 1, row; row = debtRemaining.rows[i]; i++) {
		var rowOne = row;

	}
}