<?php
echo 'load page<br>';
function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }
    else {
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $uuid = substr($charid, 0, 8)
            .substr($charid, 8, 4)
            .substr($charid,12, 4)
            .substr($charid,16, 4)
            .substr($charid,20,12);
        return $uuid;
    }
}
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
    $userQuery = 'INSERT INTO "Snowball"."Users" (debt_id, fk_user_id) VALUES (:id, :userid)';
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