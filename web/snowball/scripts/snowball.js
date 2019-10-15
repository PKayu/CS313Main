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
	var debtTable = document.getElementById("debtTable");
	for (var i = 0, row; row = debtTable.rows[i]; i++) {
		var rowOne = row;

	}
}