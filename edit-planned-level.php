<!-- include in session -->
<?php
session_start();
?>

<!-- connect to database -->
<?php
require("dbconnect.php");

// bring in id and level
$id = $_REQUEST['id'];
//$level = $_REQUEST['level'];

// console log level to check that the correct id is brought in
function console_log($data) {
  $consoleOutput = '<script>' . 'console.log(' . json_encode($data, JSON_HEX_TAG) .');'. '</script>';
    echo $consoleOutput;
}

console_log($id);

$plannedLevel = $_POST["plannedLevel"];

// setting the planned level for this scale
$sql = "UPDATE IRLscales SET PlannedLevel='$plannedLevel' WHERE id=$id";
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