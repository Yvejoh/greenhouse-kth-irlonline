<?php
require_once ("users/service.php");

$newpassword = $_POST['newpassword'];
$confirmnewpassword = $_POST['confirmnewpassword'];
if($newpassword != $confirmnewpassword) {
    $_SESSION['checkPassword'] = "Passwords doesn't match.";
    header("location: forgot-pass.php");    
}

$username = $_POST['username'];
$password = password_hash($newpassword, PASSWORD_BCRYPT);

try {

    session_start();
    UserService::get()->updatePassword($username, $password);
    $_SESSION['passwordchanged'] = "Password changed successfully"; 
    header("location: login.php");
    
} catch (UnknownUserException $e) {
    $_SESSION['checkPassword'] = $e->getMessage();
    header("location: forgot-pass.php");
}

?>
