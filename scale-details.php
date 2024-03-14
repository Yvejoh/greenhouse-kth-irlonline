<?php
include "includes/header.php";
 ?> 
<!-- include in current session -->
<?php
session_start();
?>

<?php
// connect to database
require("dbconnect.php");

// bring along the id and level number
$id = $_REQUEST['id'];
$level = $_REQUEST['level'];

// query the database
$sql = "SELECT * FROM IRLscales WHERE id=$id" ;

// display results from database depending on scale and level
if ($result = $conn -> query($sql)) {
    while ($row = $result -> fetch_row()) { ?> 
        <div class="narrow-container">
        <h4><?php echo $row[1]?></h4>
        <?php
        if ($level == 1) { ?>
            <div class="card">
                <div>
                    <p><?php echo $row[11];?></p>
                    <h4>Do these statements match your current status? Then you are currently at level <?php echo $level ?>.</h4>
                    <h4>If you are unsure, close this dialogue box and have a look at the next level up.</h4>
                    <button class="btn"><a href="edit-scale.php?id=<?php echo $id; ?>&level=<?php echo $level; ?>">Close</a></button> 
            </div>
        </div>
        <?php 
        } else if ($level == 2) { ?>
            <div class="card">
                <div>
                    <p><?php echo $row[12];?></p>
                    <h4>Do these statements match your current status? Then you are currently at level <?php echo $level ?>.</h4>
                    <h4>If you are unsure, close this dialogue box and have a look at the adjacent levels.</h4>
                    <button class="btn"><a href="edit-scale.php?id=<?php echo $id; ?>&level=<?php echo $level; ?>">Close</a></button> 
                </div>
            </div>
            <?php 
            } else if ($level == 3) { ?>
                <div class="card">
                    <div>
                        <p><?php echo $row[13];?></p>
                        <h4>Do these statements match your current status? Then you are currently at level <?php echo $level ?>.</h4>
                        <h4>If you are unsure, close this dialogue box and have a look at the adjacent levels.</h4>
                        <button class="btn"><a href="edit-scale.php?id=<?php echo $id; ?>&level=<?php echo $level; ?>">Close</a></button> 
                    </div>
                </div>
                <?php 
                } else if ($level == 4) {?>
                    <div class="card">
                        <div>
                            <p><?php echo $row[14];?></p>
                            <h4>Do these statements match your current status? Then you are currently at level <?php echo $level ?>.</h4>
                            <h4>If you are unsure, close this dialogue box and have a look at the adjacent levels.</h4>
                            <button class="btn"><a href="edit-scale.php?id=<?php echo $id; ?>&level=<?php echo $level; ?>">Close</a></button> 
                        </div>
                    </div>
                    <?php           
                    } else if ($level == 5) {?>
                        <div class="card">
                            <div>
                                <p><?php echo $row[15];?></p>
                                <h4>Do these statements match your current status? Then you are currently at level <?php echo $level ?>.</h4>
                                <h4>If you are unsure, close this dialogue box and have a look at the adjacent levels.</h4>
                                <button class="btn"><a href="edit-scale.php?id=<?php echo $id; ?>&level=<?php echo $level; ?>">Close</a></button> 
                            </div>
                        </div>
                        <?php 
                        } else if ($level == 6) {?>
                            <div class="card">
                                <div>
                                    <p><?php echo $row[16];?></p>
                                    <h4>Do these statements match your current status? Then you are currently at level <?php echo $level ?>.</h4>
                                    <h4>If you are unsure, close this dialogue box and have a look at the adjacent levels.</h4>
                                    <button class="btn"><a href="edit-scale.php?id=<?php echo $id; ?>&level=<?php echo $level; ?>">Close</a></button> 
                                </div>
                            </div>
                            <?php 
                            } else if ($level == 7) {?>
                                <div class="card">
                                    <div>
                                        <p><?php echo $row[17];?></p>
                                        <h4>Do these statements match your current status? Then you are currently at level <?php echo $level ?>.</h4>
                                        <h4>If you are unsure, close this dialogue box and have a look at the adjacent levels.</h4>
                                        <button class="btn"><a href="edit-scale.php?id=<?php echo $id; ?>&level=<?php echo $level; ?>">Close</a></button> 
                                    </div>
                                    </div>
                                    <?php 
                                    } else if ($level == 8) {?>
                                        <div class="card">
                                            <div>
                                                <p><?php echo $row[18];?></p>
                                                <h4>Do these statements match your current status? Then you are currently at level <?php echo $level ?>.</h4>
                                                <h4>If you are unsure, close this dialogue box and have a look at the adjacent levels.</h4>
                                                <button class="btn"><a href="edit-scale.php?id=<?php echo $id; ?>&level=<?php echo $level; ?>">Close</a></button> 
                                            </div>
                                        </div>
                                        <?php 
                                        } else if ($level == 9) {?>
                                            <div class="card">
                                                <div>
                                                    <p><?php echo $row[19];?></p>
                                                    <h4>Do these statements match your current status? Then you are currently at level <?php echo $level ?>.</h4>
                                                    <h4>If you are unsure, close this dialogue box and have a look at the lower levels.</h4>
                                                    <button class="btn"><a href="edit-scale.php?id=<?php echo $id; ?>&level=<?php echo $level; ?>">Close</a></button> 
                                                </div>
                                            </div>
        
        <?php 
        } ?>
        </div>
    <?php    
    }
  } else {
    echo ("Error updating record: " . $conn -> error);
  }
?>

<!-- disconnect from database -->
<?php
$conn->close();
?>

<?php
include "includes/footer.php";
?>