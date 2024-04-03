<?php
require_once("users/service.php");

session_start();

$userService = UserService::get();
$username = $_POST['username'];
$password = $_POST['password'];

try {
    $userService->createUser($username, $password);
    $_SESSION['accountcreated'] = "Account created successfully!";
    header("location: login.php");
} catch (InvalidPasswordException $e) {
    $_SESSION['checkPassword'] = $e->getMessage();
    header("location: sign-up.php");
} catch (InvalidUsernameException $e) {
    $_SESSION['checkPassword'] = $e->getMessage();
    header("location: sign-up.php");
} catch (Exception $e) {
    echo "Failed to create user!";
    header("location: sign-up.php");
}
?>
