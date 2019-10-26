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

    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    echo 'password: '.password_hash($_POST["password"], PASSWORD_DEFAULT).'<br>';

    $query = 'SELECT * FROM "Snowball"."Users" WHERE username = :username';
    $statement = $db->prepare($query);


    $statement->bindValue(':username', $username);
    if($statement->execute() == null) {
        echo 'No Results<br>';
    } else { echo 'results<br>';}

    echo 'Registered completed';
}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}