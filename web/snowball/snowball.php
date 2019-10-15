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
    $stmt = $db->prepare('SELECT * FROM "Snowball"."Users" WHERE user_id=:id');
    $stmt->execute(array(':id' => $id));
    $_SESSION["user"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <p>
            Want to know the quickest way to pay off your debt? By entering in your remaining debt below, our calculator
            will show you where to ues your money in order to pay of debt as quickly as possible. This will save you from paying interest
            on your loans and will reduce the amount of time you stay in debt.
        </p>
    </div>
    <div>

        <h2><?php echo $_SESSION["user"]['first_name'] . ' ' . $_SESSION["user"]['last_name'];
            var_dump($_SESSION["user"]);
        ?></h2>

    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
