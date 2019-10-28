<?php
$title = "Snowball Calculator";
$css = "register.css";
$javascript = "register.js";
include "header.php";
include 'connection.php';
session_start();
?>
<h2>BYU CS313</h2>
<div class="flexer">
    <div>
        <h1>Snowball Calculator</h1>
<?php
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
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = 'INSERT INTO "Snowball"."Users" VALUES (:id, :firstName, :lastName, 0, :password, :username)';
    $statement = $db->prepare($query);

    $userGuid = getGUID();
    $username = $_POST["username"];
    $firstName = $_POST["f_name"];
    $lastName = $_POST["l_name"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $statement->bindValue(':id', $userGuid);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':username', $username);
    $statement->execute();

    echo '<p>Registration is complete. Please login <a href="login.php">here</a> </p>';
}
catch (PDOException $ex)
{
echo 'Error!: ' . $ex->getMessage();
die();
}
?>
    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>

