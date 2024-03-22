<?php

require_once("users/service.php");

$userService = UserService::get();
$username = $_POST['username'];

if ($userService->exists($username)) {
    echo "Already exists!";
    return;
}

$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

if (!$userService->createUser($username, $password)) {
    echo "Failed to create user!";
    return;
}

header("location: login.php")

?>


