<?php
include "includes/header.php";

session_start();

if (!isset($_SESSION['userId'])) { 
    header("location: login.php");
}


// query database 
$sql = "SELECT * FROM IRLscales WHERE id=$id" ;

// displaying result from database
if ($result = $conn -> query($sql)) {
    
    while ($row = $result -> fetch_row()) { ?>
        <section class="main-container">
        
            
                <h4><?php echo $row[1]; 
                // making cards grey up to the level that has been reached
                $cardColor1 = $row[29];
                $cardColor2 = $row[30];
                $cardColor3 = $row[31];
                $cardColor4 = $row[32];
                $cardColor5 = $row[33];
                $cardColor6 = $row[34];
                $cardColor7 = $row[35];
                $cardColor8 = $row[36];
                $cardColor9 = $row[37];
                ?></h4>
                
                <?php
                // looping through the levels and displaying title, short description, button to read more and button to select
                for ($x = 2; $x <= 10; $x++) { 
                    $y = ($x-1);
                    $cardColor = $row[$y + 28];
                    ?>
                    <div class="card" id="card-<?php echo $y; ?>" style="background-color: #<?php echo $cardColor;?>">
                    <h4>Level <?php echo $y;?></h4>
                    <div class="shorttext-container">
                        <p><?php echo $row[$x]; ?></p>
                        <div class="flex-container">
                            <form action="scale-details.php?id=<?php echo $id; ?>&level=<?php echo $y; ?>">
                                <button class="btn" value="Select"><a href="scale-details.php?id=<?php echo $id; ?>&level=<?php echo $y; ?>">More details</a></button>
                            </form>
                            <form action="edit-color.php?id=<?php echo $id; ?>&level=<?php echo $y;?>">
                                <button id="btn_<?php echo $y; ?>" class="btn-select" value="Select"><a href="edit-color.php?id=<?php echo $id; ?>&level=<?php echo $y; ?>">Select level</a></button>
                            </form>
                        </div>
                    </div>
                    </div>
      <?php
      } ?>
      
      </section>
    <?php
    }
    // I have forgotten what this does but do not want to remove and no time right now to investigate
    $result -> free_result();
  }

include "includes/footer.php";
?>

                      

<!-- disconnect from database -->

<?php
$conn->close();
?>
