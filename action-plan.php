<?php

include("includes/header.php");
require_once("user-scales/service.php");

session_start();

if (!isset($_SESSION['userId'])) { 
    header("location: login.php");
}

$userScales = UserScaleService::get()->getFullUserScales($_SESSION['userId']);

function addIndex($text, $index) {
    return $text.$index;
}

?>

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

    <?php 
        if (isset($_SESSION["plannedLevelUpdated"])) {
            unset($_SESSION["plannedLevelUpdated"]);
    ?>
    <div>
        <h3 style="color:Green">Planned level updated !</h3> 
    </div>
    <?php } ?>

    <?php 
        if (isset($_SESSION["plannedGoalsUpdated"])) {
            unset($_SESSION["plannedGoalsUpdated"]);
    ?>
    <div>
        <h3 style="color:Green">Planned goals updated !</h3> 
    </div>
    <?php } ?>

    <div>
        <?php 
            foreach ($userScales as $userScale) { 
                $planning = $userScale->planning();
                $goals = $planning->goals();
                $index = 1; 
        ?>
            <div class="align-center border-top">
                <h3>
                    <?php echo $userScale->scaleTitle(); ?>
                </h3>
            </div>
            <div class="flex-container space-around card">
                <h4>
                    <?php echo "Current Level: ".$userScale->currentLevel() ?>
                </h4>
                <div>
                    <form action="edit-planned-level.php" method="post"> 
                        <h4>Planned Level: </h4>
                        <input type="text" name="plannedLevel" value=<?php echo $planning->plannedLevel() ?> size="3">
                        <input type="hidden" name="userID" value=<?php echo $_SESSION['userId']; ?> />
                        <input type="hidden" name="scaleID" value=<?php echo $userScale->scaleID(); ?> />
                        <button type="submit" class="btn btn-action">Confirm level</button>
                    </form>  
                </div> 
                <form action="edit-planned-goal.php" method="post" 
                    class="goal-form" id=<?php echo addIndex("goalForm", $index);?>>
                    <input type="hidden" name="userID" value=<?php echo $_SESSION['userId']; ?> />
                    <input type="hidden" name="scaleID" value=<?php echo $userScale->scaleID(); ?> />
                    <h5>The most important goals related to get to planned level.</h5>
                    <?php foreach ($goals as $goal) { ?>
                        <div class="goal-card">
                            <h5>
                                <?php echo addIndex("Goal ", $index); ?>
                            </h5>
                            <textarea type="text" id=<?php echo addIndex("plannedGoal",$index) ?> 
                                        cols="40" name=<?php echo addIndex("plannedGoal",$index) ?>
                                ><?php echo $goal->description(); ?>
                            </textarea>
                            <h5>Select or change deadline:</h5>
                            <input type="date" 
                                name=<?php echo addIndex("deadline",$index) ?> 
                                id=<?php echo addIndex("deadline",$index) ?> 
                                value="<?php echo $goal->deadline(); ?>">
                        </div>
                    <?php
                            $index++; 
                        } 
                    ?>
                    <button type="submit" class="btn btn-action align-center">Confirm goals and deadlines</button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>     

<?php
include "includes/footer.php";
?>