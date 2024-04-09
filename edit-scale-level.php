<?php

require_once("user-scales/service.php");

session_start();

if (!isset($_SESSION['userId'])) { 
    header("location: login.php");
}

// bring in id and level
$userID = $_POST['userID'];
$scaleID = $_POST['scaleID'];
$scaleLevel = $_POST['scaleLevel'];

UserScaleService::get()->updateScaleLevel($userID, $scaleID, $scaleLevel);
header("Location: dashboard.php");


// updating the colors in the database according to which level is chosen. 
// controls both the dashboard colors and color of the card on edit scale page to show level reached
if ($level == 1) {
  $sql = "UPDATE IRLscales SET L1isReached='AE0F0B', L9isReached='f2f2f2', L8isReached='f2f2f2', L7isReached='f2f2f2', L6isReached='f2f2f2', L5isReached='f2f2f2', L4isReached='f2f2f2', L3isReached='f2f2f2', L2isReached='f2f2f2', CardColor1='E6E6E6', CardColor2='ffffff', CardColor3='ffffff', CardColor4='ffffff', CardColor5='ffffff', CardColor6='ffffff', CardColor7='ffffff', CardColor8='ffffff', CardColor9='ffffff', CurrentLevel='1' WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php");
  } else {
    echo "Error updating record: " . $conn->error;
  }
  } else if ($level == 2) {
    $sql = "UPDATE IRLscales SET L2isReached='E63312', L1isReached='AE0F0B', L9isReached='f2f2f2', L8isReached='f2f2f2', L7isReached='f2f2f2', L6isReached='f2f2f2', L5isReached='f2f2f2', L4isReached='f2f2f2', L3isReached='f2f2f2', CardColor1='E6E6E6', CardColor2='E6E6E6', CardColor3='ffffff', CardColor4='ffffff', CardColor5='ffffff', CardColor6='ffffff', CardColor7='ffffff', CardColor8='ffffff', CardColor9='ffffff', CurrentLevel='2' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
      } else {
        echo "Error updating record: " . $conn->error;
      }
    } else if ($level == 3) {
      $sql = "UPDATE IRLscales SET L3isReached='EC6607', L2isReached='E63312', L1isReached='AE0F0B', L9isReached='f2f2f2', L8isReached='f2f2f2', L7isReached='f2f2f2', L6isReached='f2f2f2', L5isReached='f2f2f2', L4isReached='f2f2f2', CardColor1='E6E6E6', CardColor2='E6E6E6', CardColor3='E6E6E6', CardColor4='ffffff', CardColor5='ffffff', CardColor6='ffffff', CardColor7='ffffff', CardColor8='ffffff', CardColor9='ffffff', CurrentLevel='3' WHERE id=$id";
      if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        } else {
          echo "Error updating record: " . $conn->error;
      }
      } else if ($level == 4) {
        $sql = "UPDATE IRLscales SET L4isReached='F7B101', L3isReached='EC6607', L2isReached='E63312', L1isReached='AE0F0B', L9isReached='f2f2f2', L8isReached='f2f2f2', L7isReached='f2f2f2', L6isReached='f2f2f2', L5isReached='f2f2f2', CardColor1='E6E6E6', CardColor2='E6E6E6', CardColor3='E6E6E6', CardColor4='E6E6E6', CardColor5='ffffff', CardColor6='ffffff', CardColor7='ffffff', CardColor8='ffffff', CardColor9='ffffff', CurrentLevel='4' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
          header("Location: dashboard.php");
          } else {
            echo "Error updating record: " . $conn->error;
          }
        } else if ($level == 5) {
          $sql = "UPDATE IRLscales SET L5isReached='FFCC00', L4isReached='F7B101', L3isReached='EC6607', L2isReached='E63312', L1isReached='AE0F0B', L9isReached='f2f2f2', L8isReached='f2f2f2', L7isReached='f2f2f2', L6isReached='f2f2f2', CardColor1='E6E6E6', CardColor2='E6E6E6', CardColor3='E6E6E6', CardColor4='E6E6E6', CardColor5='E6E6E6', CardColor6='ffffff', CardColor7='ffffff', CardColor8='ffffff', CardColor9='ffffff', CurrentLevel='5' WHERE id=$id";
          if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");
            } else {
              echo "Error updating record: " . $conn->error;
            }
          } else if ($level == 6) {
            $sql = "UPDATE IRLscales SET L6isReached='AECB54', L5isReached='FFCC00', L4isReached='F7B101', L3isReached='EC6607', L2isReached='E63312', L1isReached='AE0F0B', L9isReached='f2f2f2', L8isReached='f2f2f2', L7isReached='f2f2f2', CardColor1='E6E6E6', CardColor2='E6E6E6', CardColor3='E6E6E6', CardColor4='E6E6E6', CardColor5='E6E6E6', CardColor6='E6E6E6', CardColor7='ffffff', CardColor8='ffffff', CardColor9='ffffff', CurrentLevel='6' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
              header("Location: dashboard.php");
              } else {
                echo "Error updating record: " . $conn->error;
              }
            } else if ($level == 7) {
              $sql = "UPDATE IRLscales SET L7isReached='73B959', L6isReached='AECB54', L5isReached='FFCC00', L4isReached='F7B101', L3isReached='EC6607', L2isReached='E63312', L1isReached='AE0F0B', L9isReached='f2f2f2', L8isReached='f2f2f2', CardColor1='E6E6E6', CardColor2='E6E6E6', CardColor3='E6E6E6', CardColor4='E6E6E6', CardColor5='E6E6E6', CardColor6='E6E6E6', CardColor7='E6E6E6', CardColor8='ffffff', CardColor9='ffffff', CurrentLevel='7' WHERE id=$id";
              if ($conn->query($sql) === TRUE) {
                header("Location: dashboard.php");
                } else {
                  echo "Error updating record: " . $conn->error;
                }
              } else if ($level == 8) {
                $sql = "UPDATE IRLscales SET L8isReached='008F51', L7isReached='73B959', L6isReached='AECB54', L5isReached='FFCC00', L4isReached='F7B101', L3isReached='EC6607', L2isReached='E63312', L1isReached='AE0F0B', L9isReached='f2f2f2', CardColor1='E6E6E6', CardColor2='E6E6E6', CardColor3='E6E6E6', CardColor4='E6E6E6', CardColor5='E6E6E6', CardColor6='E6E6E6', CardColor7='E6E6E6', CardColor8='E6E6E6', CardColor9='ffffff', CurrentLevel='8' WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                  header("Location: dashboard.php");
                  } else {
                    echo "Error updating record: " . $conn->error;
                  }
                } else if ($level == 9) {
                  $sql = "UPDATE IRLscales SET L9isReached='00603B', L8isReached='008F51', L7isReached='73B959', L6isReached='AECB54', L5isReached='FFCC00', L4isReached='F7B101', L3isReached='EC6607', L2isReached='E63312', L1isReached='AE0F0B', CardColor1='E6E6E6', CardColor2='E6E6E6', CardColor3='E6E6E6', CardColor4='E6E6E6', CardColor5='E6E6E6', CardColor6='E6E6E6', CardColor7='E6E6E6', CardColor8='E6E6E6', CardColor9='E6E6E6', CurrentLevel='9' WHERE id=$id";
                  if ($conn->query($sql) === TRUE) {
                    header("Location: dashboard.php");
                    } else {
                      echo "Error updating record: " . $conn->error;
                    }
                  }
                

?>
