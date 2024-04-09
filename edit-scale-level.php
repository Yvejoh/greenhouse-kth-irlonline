<?php

require_once("user-scales/service.php");

session_start();

if (!isset($_SESSION['userId'])) { 
    header("location: login.php");
}

$userID = $_POST['userID'];
$scaleID = $_POST['scaleID'];
$scaleLevel = $_POST['scaleLevel'];

UserScaleService::get()->updateScaleLevel($userID, $scaleID, $scaleLevel);
header("Location: dashboard.php");

?>
