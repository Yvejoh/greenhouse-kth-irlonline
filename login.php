<!-- include in session and disable error message -->
<?php 
session_start();
error_reporting(0);
?>

<?php
include("includes/header.php");
?>

<div class="main-container">
<?php

if ($_SESSION['loggedin'] == true ) { ?>
    <div class="card">
        <h3>You are currently logged in to your account.</h3>
        <h3>Would you like to log out?</h3>
        <button class="btn"><a href="logout.php">Yes please, log me out</a></button>
        <button class="btn" id="history-btn" onclick="history.back()">No thanks, take me back</button>
    </div>
<?php } else { ?> 
<div class="card">
        <h3>Log in to your account:</h3>
        <form class="user-form" action="admin.php" method="post">
            <div class="flex-form">
                <label for="">E-mail:</label>
                <input type="text" name="user" required>
            </div>
            <div class="flex-form">
                <label for="Password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <button class="btn" id="login-btn" type="submit" value="Log in">SIGN ME IN!</button>
            </div>
        </form>
</div>
<div>
    <p>Not signed up yet? <a href="sign-up.php">Create an account!</a></p>
</div>
<?php
}
?>
</div>
<?php
include("includes/footer.php");
?>