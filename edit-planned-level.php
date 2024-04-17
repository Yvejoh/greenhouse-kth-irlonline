
<?php
require_once("user-scales/service.php");

session_start();
// bring in id and level
$userID = $_POST["userID"];
$scaleID = $_POST["scaleID"];
$plannedLevel = $_POST["plannedLevel"];

UserScaleService::get()->updatePlannedLevel($userID, $scaleID, $plannedLevel);
$_SESSION["plannedLevelUpdated"] = true;

header("location: action-plan.php");
?>