<?php
session_start();
if(!empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    unset($_SESSION["cart"][$id]);
}


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
    <a href="home.php">Home</a>
    <a href="assignments.html">Assignments</a>
</div>
<h2>Your Shopping Cart</h2>
<div class="flexer">
    <div>
        <table style="width: 100%">
            <tr><th style="width: 20%"></th><th style="width: 50%">Item</th><th style="width: 30%">Price</th></tr>
        <?php
        $total = 0.00;
        $count = count($_SESSION["cart"]);
        for ($x = 0; $x < $count; $x++) {
            if(!is_null($_SESSION["cart"][$x])){
                $item = explode("-", $_SESSION["cart"][$x]);
                echo "<tr><td style='width: 20%'><a href='cart.php?id=$x'>Remove</a> </td><td style='width: 50%'>$item[0]</td><td style='width: 30%'>$item[1]</td></tr>";
                $total += (float)$item[1];
            }
        }
        echo "<tr><td></td><td></td><td></td>";
        echo "<tr><td></td><td></td><td>$total</td>";
        $_SESSION["total"] = $total;
        ?>
        </table><br>
        <a href="review.php">Proceed with Purchase</a>
        <br>
        <br>
        <a href="shopping.php">Return to Shop</a>
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

