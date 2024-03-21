<!-- connect to database -->
<?php
require_once ("dbconnect_user.php");
?>

<!-- save user input in variables -->
<?php

function checkPasswordEmail($pwd, $email,  &$errors) {
    $errors_init = $errors;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format!";
        return ($errors == $errors_init);
    }

    if (strlen($pwd) < 6) {
        $errors[] = "Password must be at least 6 characters long!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one letter!";
    }   

    return ($errors == $errors_init);
}

$username = $_POST['username'];
$password = $_POST['password'];
$errors = [];
session_start();
if(!checkPasswordEmail($password,$username, $errors)){
    $msg = '';
    foreach($errors as &$value){
        $msg = $msg . ' ' . $value;
    }
    echo $msg;
    $_SESSION['checkPassword'] = $msg;
    header("location: sign-up.php");
} else {
    $password = password_hash($password, PASSWORD_BCRYPT);
    // insert user input into database as new user
    $sql = "INSERT INTO IRLusers (username, psswrd)
    VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        $_SESSION['accountcreated'] = "Account created successfully!";
        header("location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


