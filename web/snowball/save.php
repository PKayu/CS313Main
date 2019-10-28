<?php
include 'connection.php';
$decoded = json_decode($_POST['aDebt'],true);
echo $decoded . "<br>";
var_dump($_POST['aDebt']);