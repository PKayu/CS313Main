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
        <p>
            Want to know the quickest way to pay off your debt? By entering in your remaining debt below, our calculator
            will show you where to ues your money in order to pay of debt as quickly as possible. This will save you from paying interest
            on your loans and will reduce the amount of time you stay in debt.
        </p>

        <h2><?php echo $_SESSION["user"][0]["first_name"] . ' ' . $_SESSION["user"][0]["last_name"]; ?></h2>
        <div>
            <label>Additional Funds</label>
            <input type="text"><br/>
            <table id="debtTable">
                <tr><th>Debt Name</th><th>Minimum Payment</th><th>Remaining Debt</th><th>Remove</th></tr>
                <?php
                $cnt = 0;
                foreach ($_SESSION["debt"] AS $debt) {
                    echo '<tr id="debtID-'. $cnt . '-' . $debt["debt_id"] .'"><td><input class="debt_name" type="text" value='. $debt["debt_name"] .'>' . '</td>'
                        .'<td><input type="text" class="minimum_payment" value='. $debt["minimum_payment"] .'>'. '</td>'
                        .'<td><input type="text" class="remaining_amount" value='. $debt["remaining_amount"] .'>' . '</td>'
                        .'<td><a href="">Remove</a></td></tr>';
                    $cnt++;
                }
                ?>
            </table>
            <a href="">Add Row</a>
            <br>
            <button name="calculate" onclick="calculate()">Snowball!</button>
        </div>

    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
