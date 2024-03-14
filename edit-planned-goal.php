<!-- include in session -->
<?php
session_start();
?>

<!-- connect to database -->
<?php
require("dbconnect.php");

// bring in id 
$id = $_REQUEST['id'];


// console log level to check that the correct id is brought in
function console_log($data) {
  $consoleOutput = '<script>' . 'console.log(' . json_encode($data, JSON_HEX_TAG) .');'. '</script>';
    echo $consoleOutput;
}

console_log($id);

$plannedGoal1 = $_POST["plannedGoal1"];
$plannedGoal2 = $_POST["plannedGoal2"];
$plannedGoal3 = $_POST["plannedGoal3"];
$deadline1 = $_POST["deadline1"];
$deadline2 = $_POST["deadline2"];
$deadline3 = $_POST["deadline3"];

// setting the planned goal for this scale
$sql = "UPDATE IRLscales SET PlannedGoal1='$plannedGoal1', PlannedGoal2='$plannedGoal2', PlannedGoal3='$plannedGoal3', Deadline1='$deadline1', Deadline2='$deadline2', Deadline3='$deadline3'  WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: action-plan.php");
  } else {
    echo "Error updating record: " . $conn->error;
  }
                

?>
<!-- disconnect from database --> 

<?php
$conn->close();
?>