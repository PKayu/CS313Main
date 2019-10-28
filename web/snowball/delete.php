<?php
include 'connection.php';
echo 'load page<br>';
session_start();
try
{
    $debt_id = $_POST['id'];
    echo 'debt id: ' . $debt_id;

    $user_id = $_SESSION['user'][0]["user_id"];
    $userQuery = 'DELETE FROM "Snowball"."Debt" WHERE debt_id = :id';
    $statement = $db->prepare($userQuery);
    $statement->bindValue(':id', $debt_id);
    $statement->execute();


    echo 'DELETE Complete Complete';
}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}