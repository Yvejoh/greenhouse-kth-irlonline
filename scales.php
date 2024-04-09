<?php
include "includes/header.php";
require_once("user-scales/service.php");
require_once("scales/service.php");
session_start();

if (!isset($_SESSION['userId'])) { 
    header("location: login.php");
}

$scale = ScaleService::get()->findByID($_POST['scaleID']);
$levels = $scale->getLevels();
$cardColor = "ffffff"; //$row[$y + 28];
?>

<section class="main-container">
    <h4>
        <?php echo $scale->getTitle(); ?> 
    </h4>

    <?php foreach($levels as $level) { ?>
        <div class="card" id="card-<?php echo $level->getLevel(); ?>" style="background-color: #<?php echo $cardColor;?>">
            <h4>
                <?php echo "Level ".$level->getLevel();?>
            </h4>
            <div class="shorttext-container">
                <p>
                    <?php echo $level->getShortDesc(); ?>
                </p>
                <div class="flex-container">
                    <form action="scale-details.php" method="post">
                        <button class="btn" value="Select">More details</button>
                        <input type="hidden" name="scaleID" value=<?php echo $scale->getID(); ?> />
                        <input type="hidden" name="scaleLevel" value=<?php echo $level->getLevel(); ?> />
                    </form>
                    <form action="edit-scale-level.php" method="post">
                        <button id="btn_<?php echo $level->getLevel(); ?>" class="btn-select" value="Select">Select level</button>
                        <input type="hidden" name="userID" value=<?php echo $_SESSION['userId']; ?> />
                        <input type="hidden" name="scaleID" value=<?php echo $scale->getID(); ?> />
                        <input type="hidden" name="scaleLevel" value=<?php echo $level->getLevel(); ?> />
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</section>

<?php include "includes/footer.php"; ?>

                      