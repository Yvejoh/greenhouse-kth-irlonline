<?php
include("includes/header.php");
require_once("user-scales/service.php");

session_start();

if (!isset($_SESSION['userId'])) { 
    header("location: login.php");
}

$scaleColors =array(
    1 => "ffff00",
    2 => "66ff33",
    3 => "0099ff",
    4 => "6783C0",
    5 => "ff9900",
    6 => "cc3300",
);
$scaleLevels = 9;

function colorOf($level, $userLevel) {
    if ($level > $userLevel) {
        return "f2f2f2";
    }

    switch ($level) {
        case 1:
            return "ae0f0b";
        case 2:
            return "e63312";
        case 3:
            return "ec6607";
        case 4:
            return "f7b101";
        case 5:
            return "ffcc00";
        case 6:
            return "aecb54";
        case 7:
            return "73b959";
        case 8:
            return "008f51";
        case 9:
            return "00603b";
    }
    return "abcdef";
}



$userScales = UserScaleService::get()->getUserScales($_SESSION['userId']);

?>

<body>
    <div class="main-container">
        <!-- hard-coded team name and coach, to be fetched from database at login/registration -->
        <div class="flex-container space-evenly">
            <div>
                <p>Team:</p>
                <h3>Greenely</h3>
            </div>
            <div>
                <p>Coach:</p>
                <h3>Donnie SC Lygonis</h3>
            </div>
        </div>
        <div>
            <?php foreach ($userScales as $userScale) { ?>
                <div class="flex-container column center">
                    <div class="flex-container row space-evenly">
                        <h4>
                            <?php echo $userScale->scaleTitle(); ?>
                        </h4>
                        <form action="scales.php" method="post"> 
                            <input type="submit" class="button" value="Edit" /> 
                            <input type="hidden" name="scaleID" value=<?php echo $userScale->scaleID(); ?> />
                        </form> 
                    </div>
                        <div class="scales-list card">
                            <?php for($value = 1; $value <= $scaleLevels; $value++) { ?>
                                <div 
                                    id=<?php echo "card-".$value; ?> 
                                    style=<?php 
                                        echo "background-color:#".colorOf($value, $userScale->currentLevel()); 
                                    ?>
                                >
                                <?php echo $value?>
                                </div>
                            <?php } ?>
                        </div>
                </div>
            <?php } ?>
        </div>
    </div>     
</body>

<?php
include "includes/footer.php";
?>