<?php
echo 'load page<br>';
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
    $password = $_POST["password"];

    echo 'password: '.password_hash($_POST["password"], PASSWORD_DEFAULT).'<br>';

    $userQuery = 'SELECT * FROM "Snowball"."Users" WHERE username = :username';
    $statement = $db->prepare($userQuery);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $_SESSION["user"] = $statement->fetchAll(PDO::FETCH_ASSOC);

    $hash = $_SESSION["user"][0]["password"];
    if (password_verify($password, $hash)) {
        echo 'Password is valid!';
    } else {
        echo 'Invalid password.';
    }

    echo 'Login Complete';
}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}