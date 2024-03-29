﻿function clickMenu() {
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

function getGUID() {
    return 'xxxxxxxxxxxx4xxxyxxxxxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

function addDebtRow() {
	var debtTable = document.getElementById("debtTable");
	var tableIndex = debtTable.rows.length - 2;
	var row = debtTable.insertRow(tableIndex);
	var debtName = row.insertCell(0);
	var minPayment = row.insertCell(1);
	var remAmount = row.insertCell(2);
	var remove = row.insertCell(3);

	var id = getGUID();

     $.ajax(
         {
             url: 'insert.php',
             type: "post",
             async:true,
             data: {'id' : id},
             success: function(data) {
                 row.className = "debtRow";
                 row.id = id;
                 debtName.innerHTML = "<input class='debt_name' type='text'>";
                 minPayment.innerHTML = "<input type='text\' class='minimum_payment' value='0.00'>";
                 remAmount.innerHTML = "<input type='text\' class='remaining_amount' value='0.00'>";
                 remove.innerHTML = "<button onclick=\"deleteRow(" + tableIndex + ", '" + id + "')\" type='button'>Remove</button>";
             },
             error: function() {
                 alert('There was some error performing the AJAX call!');
             }
         }
     );
}

function deleteRow(index, id) {
    $.ajax(
        {
            url: 'delete.php',
            type: "post",
            async:true,
            data: {'id' : id},
            success: function(data) {
                var row = document.getElementById(id);
                row.parentNode.removeChild(row);

            },
            error: function() {
                alert('There was some error performing the AJAX call!');
            }
        }
    );
}

function saveRows() {
    var iDescription = 0;
    var iMinPayment = 1;
    var iRemAmount = 2;
    var aDebt = [];
    var debtRow = document.getElementsByClassName("debtRow");
    for(var debtIndex = 0; debtIndex < debtRow.length; debtIndex++) {
        var rowId = debtRow[debtIndex].id;
        var description = debtRow[debtIndex].cells[iDescription].children[0].value;
        var minPayment = debtRow[debtIndex].cells[iMinPayment].children[0].value;
        var remAmount = debtRow[debtIndex].cells[iRemAmount].children[0].value;
        var debt = {debt_id: rowId, debt_name: description, minimum_payment: minPayment, remaining_amount: remAmount};
        aDebt.push(debt);
    }

    var additFunds = document.getElementById("addit_funds").value;
    var debtRows = JSON.stringify(aDebt);
    $.ajax(
        {
            url: 'save.php',
            type: "post",
            async:true,
            data: {arrayDebt: debtRows, addit_funds: additFunds},
            success: function(data) {
                document.getElementById("message").innerHTML = "Saved Successfully";
            },
            error: function() {
                alert('There was some error performing the AJAX call!');
            }
        }
    );
}

function snowball() {
	var debtNames = document.getElementsByClassName('debt_name');
	var remaining_amounts = document.getElementsByClassName('remaining_amount');
	var debtRemaining = 0;
	var debtArray = [];
	for (var index = 0; index < remaining_amounts.length; index++) {
		debtArray[index] = parseFloat(remaining_amounts[index].value);
		debtRemaining += parseFloat(remaining_amounts[index].value);
	}

	//build header
	var pmtTable = "<table>";
	pmtTable += "<tr><th>Pmt#</th>";
	for(var i = 0; i < debtNames.length; i++) {
		pmtTable += "<th>" + debtNames[i].value + "</th>";
	}
	pmtTable += "</tr>";

	// fill table
	var remainder = 0;
	var pmtCounter = 1;
	while(debtRemaining > 0) {
		var additFunds = parseFloat(document.getElementById('addit_funds').value);
		pmtTable += "<tr>";
		for(var debtIndex = 0; debtIndex < debtArray.length; debtIndex++) {
			var minPayment = parseFloat(document.getElementsByClassName('minimum_payment')[debtIndex].value);
			minPayment += remainder;
			var payment = parseFloat(minPayment);
			if(debtIndex === 0) {
				payment = parseFloat(minPayment + additFunds);
				pmtTable += "<td>" + pmtCounter + "</td>";
			}
			if(debtArray[debtIndex] > payment) {
				debtArray[debtIndex] -= payment;
				remainder = 0;
				pmtTable += "<td>" + payment.toFixed(2) + "</td>";
			} else {
				remainder = payment - debtArray[debtIndex];
				debtArray[debtIndex] = 0;
				pmtTable += "<td>" + (payment - remainder).toFixed(2) + "</td>";
			}
		}
		pmtTable += "</tr>";


		debtRemaining = 0;
		for(var debtIndex = 0; debtIndex < debtArray.length; debtIndex++) {
			debtRemaining += debtArray[debtIndex];
		}
		pmtCounter++;
	}
	pmtTable += "</table>";
	var desc = "<p>The table below shows how much quicker if you start putting the left over funds from a paid-off debt " +
		"towards your other debt.</p>"
	document.getElementById("results").innerHTML = pmtTable;
	calculate();
}

function calculate() {
	// sum remaining amounts
	var remaining_amounts = document.getElementsByClassName("remaining_amount");
	var debtRemaining = 0;
	for (var index = 0; index < remaining_amounts.length; index++) {
		debtRemaining += parseFloat(remaining_amounts[index].value);
	}
	document.getElementById("sumAmount").value = debtRemaining.toFixed(2);

	//sum minimum payments
	var minimumPayments = document.getElementsByClassName("minimum_payment");
	var totalMinimumPayments = 0;
	for (var index = 0; index < minimumPayments.length; index++) {
		totalMinimumPayments +=  parseFloat(minimumPayments[index].value);
	}
	document.getElementById("sumPayment").value = totalMinimumPayments.toFixed(2);
}