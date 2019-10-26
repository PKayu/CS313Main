<?php
echo 'load page<br>';
function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }
    else {
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
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
    $query = 'INSERT INTO "Snowball"."Users" VALUES (:id, :firstName, :lastName, :password)';
    $statement = $db->prepare($query);

    $userGuid = getGUID();
    echo 'created GUID: '. $userGuid.'<br>';
    $firstName = $_POST["f_name"];
    $lastName = $_POST["l_name"];
    $password = $_POST["password"];

    echo 'load variables, '.$firstName.', '.$lastName.', '.$password.' <br>';

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

