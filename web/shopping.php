<?php
session_start();
if (empty($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
    $_SESSION["remove"] = false;
}
array_push($_SESSION["cart"], $_GET["id"]);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Introduction page for CS313" />
    <title>Daniel Worwood</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/shopping.css">
    <script src="scripts/home.js"></script>
</head>

<body>
<header>
    <img src="images/BYU-Idaho.png" alt="byui logo" id="logo">
    <h1>Kylie's Random Store</h1>
    <a href="cart.php"><img src="images/shopping-cart.svg" id="shopping"></a>
    <img src="images/hamMenu.svg" alt="menu" id="menu" onclick="clickMenu()">
</header>
<div id="sidemenu">
    <br />
    <a href="home.php">Home</a>
    <a href="assignments.html">Assignments</a>
</div>
<h2>Browse</h2>
<div class="flexer">
    <div>
        <table class="item-center">
            <tr><th>Sunglasses</th></tr>
            <tr><td>Price: $5.99</td></tr>
            <tr><td>Black sunglasses that will go with any outfit</td></tr>
            <tr><td><a href="shopping.php?id=Sunglasses-5.99" >Add to cart</a></td></tr>
        </table>
    </div>
    <div>
        <table class="item-center">
            <tr><th>Lock and Key Assembly</th></tr>
            <tr><td>Price: $4.99</td></tr>
            <tr><td>This was Kylie's most random recommendation</td></tr>
            <tr><td><a href="shopping.php?id=Lock and Key Assembly-4.99" >Add to cart</a></td></tr>
        </table>
    </div>
    <div>
        <table class="item-center">
            <tr><th>Arts and Crafts Supplies</th></tr>
            <tr><td>Price: $5.99</td></tr>
            <tr><td>While kids might make a mess with this, at least it keeps them busy.</td></tr>
            <tr><td><a href="shopping.php?id=Arts and Craft Supplies-5.99" >Add to cart</a></td></tr>
        </table>
    </div>
    <div>
        <table class="item-center">
            <tr><th>Playdough</th></tr>
            <tr><td>Price: $11.99</td></tr>
            <tr><td>Entertain the kids for hours with the multicolor set.</td></tr>
            <tr><td><a href="shopping.php?id=Playdough-11.99" >Add to cart</a></td></tr>
        </table>
    </div>
    <div>
        <table class="item-center">
            <tr><th>Pet Goldfish</th></tr>
            <tr><td>Price: $6.99</td></tr>
            <tr><td>Need a pet that doesn't shed, fish is what you wish.</td></tr>
            <tr><td><a href="shopping.php?id=Pet Goldfish-6.99" >Add to cart</a></td></tr>
        </table>
    </div>
    <div>
        <table class="item-center">
            <tr><th>Fish Tank</th></tr>
            <tr><td>Price: $19.99</td></tr>
            <tr><td>A home for your new pet fish of course!</td></tr>
            <tr><td><a href="shopping.php?id=Fish Tank-19.99" >Add to cart</a></td></tr>
        </table>
    </div>
    <div>
        <table class="item-center">
            <tr><th>3D Printer</th></tr>
            <tr><td>Price: $249.99</td></tr>
            <tr><td>For tinkerers and hobbyists alike, this 3D printer will not disappoint.</td></tr>
            <tr><td><a href="shopping.php?id=3D Printer-249.99" >Add to cart</a></td></tr>
        </table>
    </div>
    <div>
        <table class="item-center">
            <tr><th>Laptop</th></tr>
            <tr><td>Price: $599.99</td></tr>
            <tr><td>Need a new laptop for school? This will certainly get the work done!</td></tr>
            <tr><td><a href="shopping.php?id=Laptop-599.99" >Add to cart</a></td></tr>
        </table>
    </div>
    <div>
        <table class="item-center">
            <tr><th>Purse</th></tr>
            <tr><td>Price: $99.99</td></tr>
            <tr><td>A new purse that you can use to store are your valuables on the go</td></tr>
            <tr><td><a href="shopping.php?id=Purse-99.99" >Add to cart</a></td></tr>
        </table>
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
