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
    <?php
    $first_name = htmlspecialchars(["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $address = htmlspecialchars($_POST["address"]);

    // Contact Info
    $contactInfo = <<<EOD
            Name: $first_name $last_name <br />
            Address: $address <br />
EOD;
    echo "<h1>Order Confirmed</h1>";
    echo "<p>Thank you for your purchase, we hope you enjoy your purchase!</p><br>";
    echo "<h2>Purchase Details</h2>";
    echo "Order Total: $".$_SESSION["total"];
    echo "<br>";
    echo $contactInfo
    ?>
        <br><br>
        <a href="shopping.php">Return to store</a>
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
