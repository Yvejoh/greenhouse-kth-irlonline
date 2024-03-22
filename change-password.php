<?php
require_once ("users/service.php");

$username = $_POST['username'];
$newpassword = $_POST['newpassword'];
$confirmnewpassword = $_POST['confirmnewpassword'];
$password = password_hash($password, PASSWORD_BCRYPT);

if($newpassword != $confirmnewpassword) {
    echo "Password and confirmation do not match";
    return;
}

if (!UserService::get()->updatePassword($username, $password)) {
    echo "Error updating password";
    return;
}

echo "Password changed successfully";
header("location: login.php");