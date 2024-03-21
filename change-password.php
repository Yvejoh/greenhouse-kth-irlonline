<!-- connect to database -->
<?php
require_once ("dbconnect_user.php");
?>

<?php

    function checkPasswordEmail($pwd,  &$errors) {
        $errors_init = $errors;
        if (strlen($pwd) < 6) {
            $errors[] = "Password must be at least 6 characters long!";
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $errors[] = "Password must include at least one number!";
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $errors[] = "Password must include at least one letter!";
        }   

        return ($errors == $errors_init);
    }
    $username = $_POST['username'];
    //$password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];

    session_start();
    if($newpassword != $confirmnewpassword){
        $_SESSION['checkPassword'] = "Passwords doesn't match.";
        header("location: forgot-pass.php");    
    }

    $errors = [];
    if(!checkPasswordEmail($newpassword, $errors)){
        $msg = '';
        foreach($errors as &$value){
            $msg = $msg . ' ' . $value;
        }
        echo $msg;
        $_SESSION['checkPassword'] = $msg;
        header("location: forgot-pass.php");
    } else{
        
        $newpassword = password_hash($newpassword, PASSWORD_BCRYPT);

        $result = $conn->query("SELECT psswrd FROM IRLusers WHERE username='$username'");

        if(!$result){
            //Username does not exist
        }
        else{
            $sql = "UPDATE IRLusers SET psswrd='$newpassword' where username='$username'";
            if ($conn->query($sql) === TRUE) {
                echo "Password changed successfully";
                $_SESSION['passwordchanged'] = "Password changed successfully"; 
                header("location: login.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
?>