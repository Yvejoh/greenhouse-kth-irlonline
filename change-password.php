<!-- connect to database -->
<?php
require_once ("dbconnect_user.php");
?>

<?php
$username = $_POST['username'];
//$password = $_POST['password'];
$newpassword = $_POST['newpassword'];
$confirmnewpassword = $_POST['confirmnewpassword'];
$password = password_hash($password, PASSWORD_BCRYPT);

$result = $conn->query("SELECT psswrd FROM IRLusers WHERE username='$username'");

if(!$result){
    //Username does not exist
}
else if($newpassword == $confirmnewpassword){
    $sql = "UPDATE IRLusers SET psswrd='$newpassword' where username='$username'";
    if ($conn->query($sql) === TRUE) {
        echo "Password changed successfully";
        header("location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>