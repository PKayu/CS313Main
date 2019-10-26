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
        <h1>Snowball Calculator</h1>
       <form method="post" action="registered.php" onsubmit="return validateRegister()">
           <label>Username</label>
           <input type="text" name="username" id="username"><br>
           <label>First Name</label>
           <input type="text" name="f_name" id="f_name"><br>
           <label>Last Name</label>
           <input type="text" name="l_name" id="l_name"><br>
           <label>Password</label>
           <input type="password" name="password" id="password"><br>
           <label>Confirm Password</label>
           <input type="password" name="confirm" id="confirm"><br>
           <button type="submit">Register</button>
       </form>
        <p id="message"></p>
    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
