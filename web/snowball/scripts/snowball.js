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

function addDebtRow() {
	var tableIndex = debtTable.rows.length - 2;
	var debtTable = document.getElementById("debtTable");
	var row = debtTable.insertRow(tableIndex);
	var debtName = row.insertCell(0);
	var minPayment = row.insertCell(1);
	var remAmount = row.insertCell(2);
	var remove = row.insertCell(3);

	debtName.innerHTML = "<input class='debt_name' type='text'>";
	minPayment.innerHTML = "<input type='text\' class='minimum_payment' value='0.00'>";
	remAmount.innerHTML = "<input type='text\' class='remaining_amount' value='0.00'>";
	remove.innerHTML = "<button onclick=\"deleteRow(" + tableIndex + ")\">Remove</button>";

}

function deleteRow(index) {
	document.getElementById("debtTable").deleteRow(index);
}

function calculate() {
	// sum remaining amounts
	var remaining_amounts = document.getElementsByClassName("remaining_amount");
	var debtRemaining = 0;
	for (var index = 0; index < remaining_amounts.length; index++) {
		debtRemaining += parseFloat(remaining_amounts[index].value);
	}
	document.getElementById("sumAmount").value = debtRemaining;

	//sum minimum payments
	var minimumPayments = document.getElementsByClassName("minimum_payment");
	var totalMinimumPayments = 0;
	for (var index = 0; index < minimumPayments.length; index++) {
		totalMinimumPayments += parseFloat(minimumPayments[index].value);
	}
	document.getElementById("sumPayment").value = totalMinimumPayments;
}