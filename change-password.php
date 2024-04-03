<?php
require_once ("users/service.php");

session_start();

$newpassword = $_POST['newpassword'];
$confirmnewpassword = $_POST['confirmnewpassword'];
if ($newpassword != $confirmnewpassword) {
    $_SESSION['checkPassword'] = "P asswords doesn't match.";
    header("location: forgot-pass.php");    
}

$username = $_POST['username'];

try {
    UserService::get()->updatePassword($username, $newpassword);
    $_SESSION['passwordchanged'] = "Password changed successfully"; 
    header("location: login.php");
    
} catch (InvalidUsernameException $e) {
    $_SESSION['checkPassword'] = $e->getMessage();
    header("location: forgot-pass.php");
} catch (InvalidPasswordException $e) {
    $_SESSION['checkPassword'] = $e->getMessage();
    header("location: forgot-pass.php");
}

?>
