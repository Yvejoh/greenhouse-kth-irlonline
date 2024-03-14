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
if ($_SESSION['loggedin'] == true ) { ?>
    <body>
        <!-- scales in divs stacked -->   
        <div class="main-container">
            <h1>Action Plan</h1>    
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
                            <h3>
                            <?php echo $row["title"]; 
                            $id = $row["id"];
                            $plannedLevel = $row["PlannedLevel"];
                            $plannedGoal1 = $row["PlannedGoal1"];
                            $plannedGoal2 = $row["PlannedGoal2"];
                            $plannedGoal3 = $row["PlannedGoal3"];
                            $deadline1 = $row["Deadline1"];
                            $deadline2 = $row["Deadline2"];
                            $deadline3 = $row["Deadline3"];
                            $color1 = $row["L1isReached"];
                            $color2 = $row["L2isReached"];
                            $color3 = $row["L3isReached"];
                            $color4 = $row["L4isReached"];
                            $color5 = $row["L5isReached"];
                            $color6 = $row["L6isReached"];
                            $color7 = $row["L7isReached"];
                            $color8 = $row["L8isReached"];
                            $color9 = $row["L9isReached"]; ?>
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
                            <form action="edit-planned-goal.php?id=<?php echo $id;?>" method="post" class="goal-form">
                                <h5>The most important goals related to get to planned level.</h5>
                                <div class="goal-card">
                                    <h5>Goal I</h5>
                                    <textarea type="text" id="plannedGoal1" cols="40" name="plannedGoal1"><?php echo $row["PlannedGoal1"]?></textarea>                                
                                    <h5>Select or change deadline:</h5>
                                    <input type="date" name="deadline1" id="deadline1" value="<?php echo $row["Deadline1"]?>">
                                    <!--<p>Current: <?php echo $row["Deadline2"]?></p>-->
                                </div>
                                <div class="goal-card">
                                    <h5>Goal II</h5>
                                    <textarea type="text" id="plannedGoal2" cols="40" name="plannedGoal2"><?php echo $row["PlannedGoal2"]?></textarea>                                
                                    <h5>Select or change deadline:</h5>
                                    <input type="date" name="deadline2" id="deadline2" value="<?php echo $row["Deadline2"]?>">
                                    <!--<p>Current: <?php echo $row["Deadline2"]?></p>-->
                                </div>
                                <div class="goal-card">
                                    <h5>Goal III</h5>
                                    <textarea type="text" id="plannedGoal3" cols="40" name="plannedGoal3"><?php echo $row["PlannedGoal3"]?></textarea>                                
                                    <h5>Select or change deadline:</h5>
                                    <input type="date" name="deadline3" id="deadline3" value="<?php echo $row["Deadline3"]?>">
                                    <!--<p>Current: <?php echo $row["Deadline2"]?></p>-->
                                </div>
                                
                                <!--create script edit-goals to change Goals according to input-->
                                <button type="submit" class="btn btn-action align-center">Confirm goals and deadlines</button>
                            </form>
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
                <h3>You have to be logged in to access the action plan, please log in or create an account</h3>
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