<?php
include 'connection.php';
echo 'load page<br>';
session_start();
try
{
    $debt_id = $_POST['id'];
    echo 'debt id: ' . $debt_id;

    $user_id = $_SESSION['user'][0]["user_id"];
    $userQuery = 'INSERT INTO "Snowball"."Debt" (debt_id, fk_user_id) VALUES (:id, :userid)';
    $statement = $db->prepare($userQuery);
    $statement->bindValue(':id', $debt_id);
    $statement->bindValue(':userid', $user_id);
    $statement->execute();


    echo 'Insert Complete Complete';
}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}