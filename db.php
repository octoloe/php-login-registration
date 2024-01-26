<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "php-login-registration";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die('Irgendwas lief schief...!');
}
