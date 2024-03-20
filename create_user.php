<?php

require_once("users/repository.php");

$repo = UserRepository::get();
$username = $_POST['username'];

if ($repo->findByUsername($username)) {
    echo "Already exists!";
    return;
}

$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

if (!$repo->create($username, $password)) {
    echo "Failed to create user!";
    return;
}

header("location: login.php")

?>


