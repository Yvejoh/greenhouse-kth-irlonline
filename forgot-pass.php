<?php 
include "./includes/header.php";
?>
<div class="main-container">
<div class="card">
    <h3>Change Password</h3>
    <form class="user-form" action='change-password.php' method='post'>
        <div class="flex-form">
            <label for="">E-mail: </label>
            <input type='text' name='username' value='' required/>
        </div>
        <div class="flex-form">
            <label for="">New Password: </label>
            <input type='password' name='newpassword' value='' required/>
        </div>
        <div class="flex-form">
            <label for="">Repeat New Password: </label>
            <input type='password' name='confirmnewpassword' value='' required/>
        </div>
        <?php 
            session_start();
            if(isset($_SESSION['checkPassword'])){
                $msg = $_SESSION['checkPassword']; 
                echo '<div>'; echo $msg; echo '</div>';
                unset($_SESSION['checkPassword']);
            }
        ?>
        <button class="btn" id="signup-btn" type='submit'>CHANGE PASSWORD</button>
    </form>
</div>
<div>
    <a href="login.php">Go back</a>
</div>
</div>

<?php 
include "./includes/footer.php";
?>