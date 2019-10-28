<?php
echo 'load page<br>';
session_start();
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
    echo 'connected to db <br>';

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