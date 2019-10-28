<?php
include 'connection.php';
session_start();
try
{
    $decoded = json_decode($_POST['arrayDebt'],true);
    $user_id = $_SESSION['user'][0]["user_id"];
    foreach ($decoded as $debt){
        $debt_id = $debt['debt_id'];
        $debt_name = $debt['debt_name'];
        $minimum_payment = floatval($debt['minimum_payment']);
        $remaining_amount = floatval($debt['remaining_amount']);

        $userQuery = 'UPDATE "Snowball"."Debt" SET debt_name = :debtName, minimum_payment = :minPay, remaining_amount = :remAmount WHERE debt_id = :id AND fk_user_id = :userid';
        $statement = $db->prepare($userQuery);
        $statement->bindValue(':id', $debt_id);
        $statement->bindValue(':userid', $user_id);
        $statement->bindValue(':debtName', $debt_name);
        $statement->bindValue(':minPay', $minimum_payment);
        $statement->bindValue(':remAmount', $remaining_amount);
        $statement->execute();
    }
}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}


var_dump($decoded);