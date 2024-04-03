<?php
include("includes/header.php");
require_once("users/service.php");

// save username and password in variables
$username = $_POST['user'];
$password = $_POST['password'];

$service = UserService::get();
session_start();

try {
  $user = $service->login($username, $password);
  // sets two session variables, one for login and one for current username (not sure I'm using that at the moment)
  $_SESSION['userId'] = $user->id();
  $_SESSION['current_user'] = $username;
  //send on to dashboard
  header("location: dashboard.php");
} catch (Exception $e) {
  $_SESSION['loginfailed'] = $e->getMessage();
  header("location: login.php");
}

?>