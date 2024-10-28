<?php
session_start();
error_reporting(0);
require_once('include/config.php');

$msg = ""; 
$error = "";

if(strlen($_SESSION["uid"]) == 0) {   
    header('location:login.php');
    exit; // Always a good practice to exit after redirecting
} else {
    // Code for change password	
    if(isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $email = $_SESSION['email'];

        $sql = "SELECT password FROM tbluser WHERE email=:email and password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        if($query->rowCount() > 0) {
            $con = "UPDATE tbluser SET password=:newpassword WHERE email=:email";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Your password was successfully changed.";
        } else {
            $error = "Your current password is not valid.";	
        }
    }
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style1.css"/>
    <script type="text/javascript">
        function valid() {
            if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("New Password and Confirm Password Field do not match!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <style>
        .error-msg, .success-msg {
            color: red;
            margin-bottom: 10px;
        }
        .success-msg {
            color: green;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Change Password</h1>
        <div class="login-box">
            <?php if($error) { echo '<div class="error-msg">' . htmlentities($error) . '</div>'; } ?>
            <?php if($msg) { echo '<div class="success-msg">' . htmlentities($msg) . '</div>'; } ?>
            <form method="post" name="chngpwd" onSubmit="return valid();">
                <label>Old Password</label>
                <input type="password" name="password" placeholder="Old Password" autocomplete="off" required>
                
                <label>New Password</label>
                <input type="password" name="newpassword" placeholder="New Password" autocomplete="off" required>
                
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" placeholder="Confirm Password" autocomplete="off" required>
                
                <button type="submit" name="submit">Change Password</button>
            </form>
            <hr> 
            <a href="index.php">Back to Home Page</a>
        </div>
    </div>
</body>
</html>
