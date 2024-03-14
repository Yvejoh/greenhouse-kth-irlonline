<!-- connect to database -->
<?php
require_once ("dbconnect_user.php");
?>

<!-- save user input in variables -->
<?php
$username = $_POST['username'];
$password = $_POST['password'];
$password = password_hash($password, PASSWORD_BCRYPT);

// insert user input into database as new user
$sql = "INSERT INTO IRLusers (username, psswrd)
VALUES ('$username', '$password')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("location: login.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


//$hash = password_hash($password, PASSWORD_DEFAULT);

?>


