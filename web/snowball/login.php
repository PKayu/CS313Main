<?php
$title = "Snowball Calculator";
$css = "register.css";
$javascript = "register.js";
include "header.php";
session_start();
?>
<!-- Begin Page Content -->
<h2>BYU CS313</h2>
<div class="flexer">
    <div>
        <h1>Login</h1>
        <form method="post" action="validate.php" onsubmit="return validateRegister()">
            <label>Username</label>
            <input type="text" name="username" id="username"><br>
            <label>Password</label>
            <input type="password" name="password" id="password"><br>
            <button type="submit">Login</button>
        </form>
        <p id="message"></p>
    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
