<?php
include "includes/header.php";
require_once("scales/service.php");

session_start();

if (!isset($_SESSION['userId'])) { 
    header("location: login.php");
}


$id = $_POST['scaleID'];
$scaleLevel = $_POST['scaleLevel'];
$scale = ScaleService::get()->findByID($id);
$level = $scale->levels()[$scaleLevel-1];
?>

<div class="narrow-container">
    <h4>
        <?php echo $scale->title(); ?>
    </h4>
    <div class="card">
        <div>
            <p><?php echo $level->fullDesc();?></p>
            <h4>Do these statements match your current status? Then you are currently at level <?php echo $scaleLevel ?>.</h4>
            <h4>
                <?php if ($scaleLevel == 1) { ?>
                   If you are unsure, close this dialogue box and have a look at the next level up.
                <?php } else if ($scaleLevel == 9) { ?>
                    If you are unsure, close this dialogue box and have a look at the lower levels.
                <?php }else { ?>
                    If you are unsure, close this dialogue box and have a look at the adjacent levels.
                <?php } ?>
            </h4>
            <form action="scales.php" method="post">
                <button class="btn" value="Select">Close</button>
                <input type="hidden" name="scaleID" value=<?php echo $scale->ID(); ?> />
            </form>
        </div>
    </div>
</div>

<?php
 include "includes/footer.php"; 
?>