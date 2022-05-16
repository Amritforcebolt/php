<?php

$servername = 'localhost';
$username = 'root';
$password = "";
$database = "amrit";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die('sorry');
}

// echo 'connected';

?>
