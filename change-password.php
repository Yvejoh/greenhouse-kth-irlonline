<!-- connect to database -->
<?php
require_once ("dbconnect_user.php");
?>

<?php
    require_once ("create_user.php");
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
    if(!checkPasswordEmail($newpassword,$username, $errors)){
        $msg = '';
        foreach($errors as &$value){
            $msg = $msg . ' ' . $value;
        }
        echo $msg;
        $_SESSION['checkPassword'] = $msg;
        header("location: forgot-pass.php");
    } else{
        
        $password = password_hash($password, PASSWORD_BCRYPT);

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