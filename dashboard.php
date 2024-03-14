<?php
include("includes/header.php");

// connect to database and disable error reporting
require("dbconnect.php");
error_reporting(0);
?>

<?php
//get data from database
$sql = "SELECT title, id, L1isReached, L2isReached, L3isReached, L4isReached, L5isReached, L6isReached, L7isReached, L8isReached, L9isReached  FROM IRLscales ORDER BY id ASC";

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
                <div >
                    <?php
                    while ($row = $result->fetch_array()) { 
                    ?>
                        <div class="flex-container space-between">
                            <h4 class="scales-title">
                            <?php echo $row["title"]; 
                            $id = $row["id"];
                            $color1 = $row["L1isReached"];
                            $color2 = $row["L2isReached"];
                            $color3 = $row["L3isReached"];
                            $color4 = $row["L4isReached"];
                            $color5 = $row["L5isReached"];
                            $color6 = $row["L6isReached"];
                            $color7 = $row["L7isReached"];
                            $color8 = $row["L8isReached"];
                            $color9 = $row["L9isReached"]; ?>
                            </h4>
                            <div class="align-right">
                                <button class="btn btn-edit"><a href="edit-scale.php?id=<?php echo $row["id"];?>">Edit scale</a></button>
                            </div>
                        </div>
                        <div class="scales-list card">
                            <div id="1_<?php echo $id; ?>" class="scale-level-1" style="background-color: #<?php echo $color1?>">1</div>
                            <div id="2-<?php echo $id; ?>" class="scale-level-2" style="background-color: #<?php echo $color2?>">2</div>
                            <div id="3-<?php echo $id; ?>" class="scale-level-3" style="background-color: #<?php echo $color3?>">3</div>
                            <div id="4-<?php echo $id; ?>" class="scale-level-4" style="background-color: #<?php echo $color4?>">4</div>
                            <div id="5-<?php echo $id; ?>" class="scale-level-5" style="background-color: #<?php echo $color5?>">5</div>
                            <div id="6-<?php echo $id; ?>" class="scale-level-6" style="background-color: #<?php echo $color6?>">6</div>
                            <div id="7-<?php echo $id; ?>" class="scale-level-7" style="background-color: #<?php echo $color7?>">7</div>
                            <div id="8-<?php echo $id; ?>" class="scale-level-8" style="background-color: #<?php echo $color8?>">8</div>
                            <div id="9-<?php echo $id; ?>" class="scale-level-9" style="background-color: #<?php echo $color9?>">9</div>
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
                <h3>You have to be logged in to access the dashboard, please log in or create an account</h3>
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