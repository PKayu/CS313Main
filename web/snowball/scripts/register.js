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

function validateRegister() {
    var firstName = document.getElementsByName("f_name");
    var lastName = document.getElementsByName("l_name");
    var password = document.getElementsByName("password");
    var confirm = document.getElementsByName("confirm");

    if(firstName.length < 1) {
        document.getElementById("message").innerText = "Please enter a first name";
        return 0;
    }

    if(lastName.length < 1) {
        document.getElementById("message").innerText = "Please enter a last name";
        return 0;
    }

    if(password.length < 8) {
        document.getElementById("message").innerText = "Please enter a password of more than 8 characters";
        return 0;
    }

    if(password !== confirm) {
        document.getElementById("message").innerText = "Password needs to match!";
        return 0;
    }
}