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
    var firstName = document.getElementById("f_name").value;
    var lastName = document.getElementById("l_name").value;
    var password = document.getElementById("password").value;
    var confirm = document.getElementById("confirm").value;
    var username = document.getElementById("username").value

    if(username.length < 6) {
        document.getElementById("message").innerText = "Please enter a valid username at least 6 characters long";
        return false;
    }

    if(firstName.length < 1) {
        document.getElementById("message").innerText = "Please enter a first name";
        return false;
    }

    if(lastName.length < 1) {
        document.getElementById("message").innerText = "Please enter a last name";
        return false;
    }

    if(password.length < 8) {
        document.getElementById("message").innerText = "Please enter a password of more than 8 characters";
        return false;
    }

    if(password !== confirm) {
        document.getElementById("message").innerText = "Password needs to match!";
        return false;
    }
}