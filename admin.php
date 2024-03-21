<!-- include in session  -->
<?php
session_start();
?>

<?php
include("includes/header.php");

// connect to database
include("dbconnect_user.php");
?>
<div style='width:50%; height:50%;  position: absolute;
  top: 50%;
  left: 50%;'>
<?php
// save username and password in variables
$myusername = $_POST['user'];
$mypassword = $_POST['password'];

// collect username from database
$sql = "SELECT * FROM IRLusers WHERE username='$myusername'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
//echo "<div>"; echo $test[]; echo "</div>";

if(mysqli_num_rows($result) == 0){
    $_SESSION['loginfailed'] = "Invalid e-mail!";
    header("location: login.php");
} 
else if (password_verify($mypassword, $user['psswrd'])) {
    $login = true;
    session_start();
    // sets two session variables, one for login and one for current username (not sure I'm using that at the moment)
    $_SESSION['loggedin'] = true;
    $_SESSION['current_user'] = $myusername;
    //send on to dashboard
    header("location: dashboard.php");
} else {
    $_SESSION['loginfailed'] = "Invalid password!";
    header("location: login.php");
}


?>
</div>
<!-- disconnect from database -->
<?php
$conn->close();
?>