<?php
include("includes/header.php");
require_once("users/service.php");

// save username and password in variables
$myusername = $_POST['user'];
$mypassword = $_POST['password'];

$service = UserService::get();
$user = $service->findByUsername($myusername);

if ($user == NULL) {
  $_SESSION['loginfailed'] = "Invalid e-mail!";
  header("location: login.php");
}

if (!$service-> isUserPassword($user->id(), $mypassword)) {
  $_SESSION['loginfailed'] = "Invalid password!";
  header("location: login.php");
}

$login = true;
session_start();
// sets two session variables, one for login and one for current username (not sure I'm using that at the moment)
$_SESSION['loggedin'] = true;
$_SESSION['current_user'] = $myusername;
//send on to dashboard
header("location: dashboard.php");

?>