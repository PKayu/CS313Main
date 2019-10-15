<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Introduction page for CS313" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/<?php echo $css; ?>">
    <script src="scripts/<?php echo $javascript; ?>"></script>
</head>

<body>
<header>
    <img src="images/BYU-Idaho.png" alt="byui logo" id="logo">
    <h1>Daniel Worwood - CS313</h1>
    <img src="images/hamMenu.svg" alt="menu" id="menu" onclick="clickMenu()">
</header>
<div id="sidemenu">
    <br />
    <a href="home.php">Home</a>
    <a href="assignments.html">Assignments</a>
</div>
<!--end header -->