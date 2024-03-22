<?php
// include("includes/header.php");
require_once("users/service.php");

// save username and password in variables
$myusername = $_POST['user'];
$mypassword = $_POST['password'];

$service = UserService::get();
$user = $service->findByUsername($myusername);

if ($user == NULL) {
    echo "Invalid username";
    return;
}


if (!$service->isValidPassword($user->id(), $mypassword)) {
    echo "Invalid username or password";
    echo "<a href='login.php'>Try again</a>";
    return;
}

$login = true;
session_start();
// sets two session variables, one for login and one for current username (not sure I'm using that at the moment)
$_SESSION['loggedin'] = true;
$_SESSION['current_user'] = $myusername;
//send on to dashboard
header("location: dashboard.php");

?>