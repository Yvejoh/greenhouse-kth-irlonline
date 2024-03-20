<?php 
include "./includes/header.php";
?>
<div class="main-container">
<div class="card">
    <h3>Register for an account:</h3>
    <form class="user-form" action='create_user.php' method='post'>
        <div class="flex-form">
            <label for="">E-mail: </label>
            <input type='text' name='username' value='' required/>
        </div>
        <div class="flex-form">
            <label for="Password">Password: </label>
            <input type='password' name='password' value='' required/>
        </div>
        <button type='submit'>SIGN ME UP!</button>
    </form>
</div>
<div>
    <p>Already have an account? <a href="login.php">Log right in!</a></p>
</div>
</div>

<?php 
include "./includes/footer.php";
?>