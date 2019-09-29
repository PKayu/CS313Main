<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Introduction page for CS313" />
    <title>Daniel Worwood</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <script src="scripts/home.js"></script>
</head>

<body>
    <header>
        <img src="images/BYU-Idaho.png" alt="byui logo" id="logo">
        <h1>Daniel Worwood - CS313</h1>
        <img src="images/hamMenu.svg" alt="menu" id="menu" onclick="clickMenu()">
    </header>
    <div id="sidemenu">
        <br />
        <a href="home.html">Home</a>
        <a href="assignments.html">Assignments</a>
    </div>
    <h2>BYU CS313</h2>
    <div class="flexer">
        <div>
            <img src="images/me.jpg" alt="Daniel Worwood">
            <p>
                My name is Dan Worwood and am a current student at BYU-Idaho Online.
                I live in Houston, Texas with my wife and two daughters and work as
                as Software developer at a local software company. In my free time I
                play guitar, wrestle my girls, and tinker on my raspberry pi.
            </p>
        </div>
        <div>
            <img src="images/double-arch.jpg" alt="Art">
            <p>
                While I currently live in Houston, Texas, my true roots are in Southern
                Utah. Above is an image my father drew for me to remind me of home. While
                I enjoy the lush green of Houston, I often miss the reds and oranges of the
                rocks that are found in Southern Utah.
            </p>
        </div>

    </div>

    <footer>
        <?php
            echo "The server time is " . date("h:i:sa");
        BYU-Idaho<br />
        CS313
    </footer>
</body>

</html>
