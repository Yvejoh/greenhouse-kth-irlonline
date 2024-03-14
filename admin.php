<!-- include in session  -->
<?php
session_start();
?>

<?php
include("includes/header.php");

// connect to database
include("dbconnect_user.php");
?>

<?php
// save username and password in variables
$myusername = $_POST['user'];
$mypassword = $_POST['password'];
echo $myusername;
echo $mypassword;

// collect username from database
$sql = "SELECT * FROM IRLusers WHERE username='$myusername'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
echo $num;
if ($num > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        //verify password with password_verify
        if (password_verify($mypassword, $row['psswrd'])) {
            $login = true;
            session_start();
            // sets two session variables, one for login and one for current username (not sure I'm using that at the moment)
            $_SESSION['loggedin'] = true;
            $_SESSION['current_user'] = $myusername;
            //send on to dashboard
            header("location: dashboard.php");
        } else {
            echo "Inloggningen godkändes inte";
            echo "<a href='login.php'>Försök igen</a>";
        }
    }
}
?>

<!-- disconnect from database -->
<?php
$conn->close();
?>