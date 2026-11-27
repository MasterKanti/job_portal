<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "job_portal";

$mysqli = new mysqli(
    hostname: $servername,
    username: $username,
    password: $password,
    database: $database
);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

?>