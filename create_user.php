<?php
require_once("users/service.php");

session_start();

$userService = UserService::get();
$username = $_POST['username'];
$password = $_POST['password'];

try {
    $userService->checkPassword($password);
    $userService->createUser($username, password_hash($password, PASSWORD_BCRYPT));
    $_SESSION['accountcreated'] = "Account created successfully!";
} catch (InvalidPasswordException $e) {
    $_SESSION['checkPassword'] = $e->getMessage();
} catch (UnavailableUsernameException $e) {
    $_SESSION['checkPassword'] = $e->getMessage();
} catch (Exception $e) {
    echo "Failed to create user!";
} finally {
    header("location: login.php");
}
?>
