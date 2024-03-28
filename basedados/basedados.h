<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
$db = "Salao";
mysqli_select_db($conn, $db);
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}


?>