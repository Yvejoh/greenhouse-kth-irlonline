<?php
//create contact with database

$servername = "localhost";
$database = "horseand_IRLscales";
$username = "horseand_irlscales";
$password = "[uoSf4PSU-}U";

$conn = new mysqli($servername, $username, $password, $database);

//make sure connection works
if (mysqli_connect_error()) {
    printf("DB error: %s", mysqli_connect_error());
    exit();
}
?>