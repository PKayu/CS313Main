<?php
$title = "Snowball Calculator";
$css = "snowball.css";
$javascript = "register.js";
include "header.php";
session_start();
?>
<!-- Begin Page Content -->
<h2>BYU CS313</h2>
<div class="flexer">
    <div>
        <h1>Snowball Calculator</h1>
       <form method="post" action="registered.php">
           <label>First Name</label>
           <input type="text" name="f_name"><br>
           <label>Last Name</label>
           <input type="text" name="l_name"><br>
           <label>Password</label>
           <input type="password" name="password"><br>
           <label>Confirm Password</label>
           <input type="password" name="confirm"><br>
           <button type="submit" onclick="validateRegister()">Register</button>
       </form>
        <p id="message"></p>
    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
