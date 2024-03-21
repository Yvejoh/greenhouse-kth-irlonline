<?php

require_once("users/repository.php");

$repo = UserRepository::get();
$username = $_POST['username'];

if ($repo->findByUsername($username)) {
    echo "Already exists!";
    $_SESSION['checkPassword'] "User already exists!";
    header("location: login.php")
}

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
    if (!$repo->create($username, $password)) {
      echo "Failed to create user!";
      $_SESSION['checkPassword'] "Failed to create user!";
      header("location: login.php")
    } else {
        echo "New record created successfully";
        $_SESSION['accountcreated'] = "Account created successfully!";
        header("location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


