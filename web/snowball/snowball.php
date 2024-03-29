<?php
$title = "Snowball Calculator";
$css = "snowball.css";
$javascript = "snowball.js";
include "header.php";
include 'connection.php';
session_start();
if (empty($_SESSION["user"])) {
    header("Location: login.php");
}

?>
<?php
try
{
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
            <form action="save.php" method="post">
                <label>Additional Funds</label>
                <input id="addit_funds" type="text" value=<?php echo number_format($_SESSION["user"][0]["addit_funds"], 2, '.', ''); ?> name="addit_funds"><br/>
                <table id="debtTable">
                    <tr><th>Debt Name</th><th>Minimum Payment</th><th>Remaining Debt</th><th>Remove</th></tr>
                    <?php
                    $cnt = 1;
                    foreach ($_SESSION["debt"] AS $debt) {
                        echo "<tr class='debtRow' id='" . $debt["debt_id"] . "'><td><input name='dn-" . $debt["debt_id"] ."' class='debt_name' type='text' value='" . $debt["debt_name"] ."'></td>"
                            . "<td><input name='mp-" . $debt["debt_id"] ."' type='text' class='minimum_payment' value=". number_format($debt["minimum_payment"], 2, '.', '') ."></td>"
                            ."<td><input name='ra-" . $debt["debt_id"] ."' type='text' class='remaining_amount' value=". number_format($debt["remaining_amount"], 2, '.', '') ."></td>"
                            ."<td><button onclick=\"deleteRow(" . $cnt . ", '". $debt['debt_id'] . "' )\" type='button'>Remove</button></td></tr>";
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
                <button type="button" onclick="saveRows()">Save</button>
            </form>
            <p id="message"></p>
        </div>
        <div id="results"></div>

    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
