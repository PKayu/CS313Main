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

    $query = 'INSERT INTO "Snowball"."Users" VALUES (:id, :firstName, :lastName, :password)';
    $statement = $db->prepare($query);

    $userGuid = com_create_guid();
    $firstName = $_POST["f_name"];
    $lastName = $_POST["l_name"];
    $password = $_POST["password"];

    $statement->bindValue(':id', $userGuid);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':password', $password);
    $statement->execute();

    echo 'Registered completed';
}
catch (PDOException $ex)
{
echo 'Error!: ' . $ex->getMessage();
die();
}

