<?php
include("includes/header.php");

// connect to database and disable error reporting
require("dbconnect.php");
error_reporting(0);
?>

<?php
//get data from database
$sql = "SELECT title, id, CurrentLevel, PlannedLevel, PlannedGoal1, PlannedGoal2, PlannedGoal3, Deadline1, Deadline2, Deadline3  FROM IRLscales ORDER BY id ASC";

$result = $conn->query($sql);

?>
<!-- include in session -->
<?php
session_start();
//checking to see if user session variable loggedin is true and that a user is logged in
if (isset($_SESSION['userId']) ) { ?>
    <body>
        <!-- scales in divs stacked -->   
        <div class="main-container">
            <h1>Tracker</h1>
            <!-- hard-coded team name and coach, to be fetched from database at login/registration -->
            <div class="flex-container space-evenly">
                <div>
                    <p>Team:</p>
                    <h3>Test Case ONE</h3>
                </div>
                <div>
                    <p>Coach:</p>
                    <h3>Donnie SC Lygonis</h3>
                </div>
            </div>
            <div>
                <div>
                    <?php
                    while ($row = $result->fetch_array()) { 
                    ?>
                        <div class="align-center border-top">
                            <?php
                            $id = $row["id"];
                            $plannedLevel = $row["PlannedLevel"];
                            $plannedGoal1 = $row["PlannedGoal1"];
                            $plannedGoal2 = $row["PlannedGoal2"];
                            $plannedGoal3 = $row["PlannedGoal3"];
                            $deadline1 = $row["Deadline1"];
                            $deadline2 = $row["Deadline2"];
                            $deadline3 = $row["Deadline3"];
                            ?>
                            <h3>
                            <?php echo $row["title"]; 
                            
                             ?>
                            </h3>
                            
                        </div>
                        <div class="flex-container space-around card">
                            <h4>Current Level: <?php echo $row["CurrentLevel"]?></h4>
                            <div>
                                <form action="edit-planned-level.php?id=<?php echo $id;?>" method="post">
                                <h4>Planned Level: </h4>
                                <input type="text" name="plannedLevel" value=<?php echo $plannedLevel?> size="3">
                                <!--create script edit-planned-level to change PlannedLevel according to input-->
                                <button type="submit" class="btn btn-action">Confirm level</button>
                                </form>  
                            </div> 
                            <div>
                                <form action="edit-planned-goal.php?id=<?php echo $id;?>" method="post" class="flex-container column">
                                <h4>The most important goal(s) related to get to planned level</h4>
                                <textarea type="text" rows="6" cols="40" name="plannedGoal"><?php echo $row["PlannedGoal"]?></textarea>
                                <!--create script edit-goals to change Goals according to input-->
                                <button type="submit" class="btn btn-action">Confirm goals</button>
                                </form>
                            </div>
                        </div>
                        
                        <?php
                        } ?>
                </div>
            </div>
        </div>     
    <?php
    } else { ?>
        <div class="main-container">
            <div class="card">
                <h3>You have to be logged in to access the tracker plan, please log in or create an account</h3>
                    <button class="btn"><a href='login.php'>LOG IN</a></button>
                    <button class="btn"><a href='sign-up.php'>SIGN UP</a></button>
            </div>
        </div>
    <?php }
    ?>
    <!-- disconnect from database -->
    <?php
    $conn->close();
    ?>

    </body>

<?php
include "includes/footer.php";
?>