<?php
include 'connection.php';
$decoded = json_decode($_POST['arrayDebt'],true);
echo $decoded . "<br>";
var_dump($decoded);