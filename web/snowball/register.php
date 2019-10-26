<?php
$title = "Snowball Calculator";
$css = "snowball.css";
$javascript = "snowball.js";
include "header.php";
session_start();
?>
<?php
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
    echo 'Successfully Connected!<br/>';
    $id = 0;
    $user_stmt = $db->prepare('SELECT * FROM "Snowball"."Users" WHERE user_id=:id');
    $user_stmt->execute(array(':id' => $id));
    $_SESSION["user"] = $user_stmt->fetchAll(PDO::FETCH_ASSOC);

    $debt_stmt = $db->prepare('SELECT * FROM "Snowball"."Debt" WHERE fk_user_id=:id');
    $debt_stmt->execute(array(':id' => $id));
    $_SESSION["debt"] = $debt_stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}
?>
<!-- Begin Page Content -->
<h2>BYU CS313</h2>
<div class="flexer">
    <div>
        <h1>Snowball Calculator</h1>
       <form method="post" action="">
           <label>First Name</label>
           <input type="text" name="f_name">
           <label>Last Name</label>
           <input type="text" name="l_name">
           <label>Password</label>
           <input type="password" name="password">
           <label>Confirm Password</label>
           <input type="password" name="confirm">
           <button type="submit">Register</button>
       </form>

    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
