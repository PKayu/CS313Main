<?php
$title = "Snowball Calculator";
$css = "snowball.css";
$javascript = "snowball.js";
include "header.php";
session_start();
if (empty($_SESSION["user"])) {
    header("Location: login.php");
}

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
    $id =  $_SESSION["user"][0]["user_id"];
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
        <p>
            Want to know the quickest way to pay off your debt? By entering in your remaining debt below, our calculator
            will show you where to ues your money in order to pay of debt as quickly as possible. This will save you from paying interest
            on your loans and will reduce the amount of time you stay in debt.
        </p>

        <h2><?php echo $_SESSION["user"][0]["first_name"] . ' ' . $_SESSION["user"][0]["last_name"]; ?></h2>
        <div>
            <label>Additional Funds</label>
            <input id="addit_funds" type="text" value=0><br/>
            <form action="save.php" method="post">
                <table id="debtTable">
                    <tr><th>Debt Name</th><th>Minimum Payment</th><th>Remaining Debt</th><th>Remove</th></tr>
                    <?php
                    $cnt = 1;
                    foreach ($_SESSION["debt"] AS $debt) {
                        echo '<tr id="debtID-'. $cnt . '-' . $debt["debt_id"] .'"><td><input class="debt_name" type="text" value='. $debt["debt_name"] .'>' . '</td>'
                            .'<td><input type="text" class="minimum_payment" value='. number_format($debt["minimum_payment"], 2, '.', '') .'>'. '</td>'
                            .'<td><input type="text" class="remaining_amount" value='. number_format($debt["remaining_amount"], 2, '.', '') .'>' . '</td>'
                            .'<td><button onclick="deleteRow(' . $cnt . ')">Remove</button></td></tr>';
                        $cnt++;
                    }
                    ?>
                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr><td>Total:</td><td><input id="sumPayment" readonly="true"></td><td><input id="sumAmount" readonly="true"></td><td></td></tr>
                </table>
                <button onclick="addDebtRow()" type="button">Add Debt Row</button>
                <br>
                <br>
                <button name="calculate" onclick="snowball()" type="button">Snowball!</button>
                <button type="submit" name="save">Save</button>
            </form>
        </div>
        <div id="results"></div>

    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
