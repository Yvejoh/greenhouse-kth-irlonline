<?php
include "includes/header.php";
require_once("user-scales/service.php");
require_once("scales/service.php");
session_start();

if (!isset($_SESSION['userId'])) { 
    header("location: login.php");
}

$userID = $_SESSION['userId'];
$scaleID = $_POST['scaleID'];
$scale = ScaleService::get()->findByID($scaleID);
$scaleLevel = UserScaleService::get()->getScaleLevel($userID, $scaleID);
$levels = $scale->levels();
?>

<section class="main-container">
    <h4>
        <?php echo $scale->title(); ?> 
    </h4>

    <?php foreach($levels as $level) { ?>
        <div class="card" id="card-<?php echo $level->level(); ?>" 
            style="background-color: #<?php
                echo ($level->level() == $scaleLevel->level() ? "E6E6E6" : "ffffff");?>">
            <h4>
                <?php echo "Level ".$level->level();?>
            </h4>
            <div class="shorttext-container">
                <p>
                    <?php echo $level->shortDesc(); ?>
                </p>
                <div class="flex-container">
                    <form action="scale-details.php" method="post">
                        <button class="btn" value="Select">More details</button>
                        <input type="hidden" name="scaleID" value=<?php echo $scale->ID(); ?> />
                        <input type="hidden" name="scaleLevel" value=<?php echo $level->level(); ?> />
                    </form>
                    <form action="edit-scale-level.php" method="post">
                        <button id="btn_<?php echo $level->level(); ?>" class="btn-select" value="Select">Select level</button>
                        <input type="hidden" name="userID" value=<?php echo $_SESSION['userId']; ?> />
                        <input type="hidden" name="scaleID" value=<?php echo $scale->ID(); ?> />
                        <input type="hidden" name="scaleLevel" value=<?php echo $level->level(); ?> />
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</section>

<?php include "includes/footer.php"; ?>

                      