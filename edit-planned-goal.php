<?php

require_once("user-scales/service.php");
session_start();

$plannedGoal1 = $_POST["plannedGoal1"];
$plannedGoal2 = $_POST["plannedGoal2"];
$plannedGoal3 = $_POST["plannedGoal3"];
$deadline1 = $_POST["deadline1"];
$deadline2 = $_POST["deadline2"];
$deadline3 = $_POST["deadline3"];
$userID = $_POST["userID"];
$scaleID = $_POST["scaleID"];

UserScaleService::get()->updatePlannedGoals($userID, $scaleID,
                                            $plannedGoal1, $deadline1,
                                            $plannedGoal2, $deadline2,
                                            $plannedGoal3, $deadline3);

$_SESSION["plannedGoalsUpdated"] = true;

header("location: action-plan.php");

?>