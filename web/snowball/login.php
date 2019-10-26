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
        <form method="post" action="login.php">
            <label>Username</label>
            <input type="text" name="username" id="username"><br>
            <label>Password</label>
            <input type="password" name="password" id="password"><br>
            <button type="submit">Login</button>
        </form>
        <p id="message">
            <?php
            if(empty($_POST["password"])) {
                return;
            }
            if (empty($_SESSION["user"])) {
                try
                {
                    $dbUrl = getenv('DATABASE_URL');

                    $dbOpts = parse_url($dbUrl);

                    $dbHost = $dbOpts["host"];
                    $dbPort = $dbOpts["port"];
                    $dbUser = $dbOpts["user"];
                    $dbPassword = $dbOpts["pass"];
                    $dbName = ltrim($dbOpts["path"],'/');

                    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    $userQuery = 'SELECT * FROM "Snowball"."Users" WHERE username = :username';
                    $statement = $db->prepare($userQuery);
                    $statement->bindValue(':username', $username);
                    $statement->execute();
                    $_SESSION["user"] = $statement->fetchAll(PDO::FETCH_ASSOC);

                    $hash = $_SESSION["user"][0]["password"];
                    if (password_verify($password, $hash)) {
                        header("Location: snowball.php");
                    } else {
                        echo 'Invalid password.';
                    }
                }
                catch (PDOException $ex)
                {
                    echo 'Error!: ' . $ex->getMessage();
                    die();
                }
            }
            ?>
        </p>
    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
