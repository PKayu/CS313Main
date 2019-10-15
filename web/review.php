<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Introduction page for CS313" />
    <title>Daniel Worwood</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/cart.css">
    <script src="scripts/home.js"></script>
</head>

<body>
<header>
    <img src="images/BYU-Idaho.png" alt="byui logo" id="logo">
    <h1>Kylie's Random Store</h1>
    <img src="images/shopping-cart.svg" id="shopping">
    <img src="images/hamMenu.svg" alt="menu" id="menu" onclick="clickMenu()">
</header>
<div id="sidemenu">
    <br />
    <a href="home.html">Home</a>
    <a href="assignments.html">Assignments</a>
</div>
<h2>Your Shopping Cart</h2>
<div class="flexer">
    <div>
        <h2>Order Total:
            <?php
            echo " $".$_SESSION["total"];
            ?>
        </h2>
        <form method="post" action="confirm.php">
            <h2>Contact</h2>
            <label>First Name</label>
            <input type="text" name="first_name" id="first_name" /><br>
            <label>Last Name</label>
            <input type="text" name="last_name" id="last_name" /><br>
            <label>Address</label><br>
            <textarea name="address" placeholder="street address, city, state, and zip" id="address"></textarea>
            <br><br>
            <button type="submit" name="Confirm">Confirm Order</button>
        </form>
        <a href="cart.php">Return to Cart</a>
    </div>
</div>

<footer>
    <?php
    echo "The server time is " . date("h:i:sa");
    ?>
    BYU-Idaho<br />
    CS313
</footer>
</body>

</html>

