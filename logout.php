<?php
include("includes/header.php");
?>

<!-- include in session and then destroy session to log out -->
<?php
session_start();
session_destroy(); ?>

<div class='main-container'>
    <div class="card">
        <h3>You are now logged out</h3>
        <button class='btn'><a href='login.php'>Log back in</a></button>
    </div>
</div>



<?php
include("includes/footer.php");
?>