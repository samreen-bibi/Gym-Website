<?php
session_start();
error_reporting(0);
require_once('include/config.php');
$msg = ""; 
if(isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = md5(($_POST['password']));
  if($email != "" && $password != "") {
    try {
      $query = "select id, fname, lname, email, mobile, password, address, create_date from tbluser where email=:email and password=:password";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        $_SESSION['uid']   = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['fname'];
       header("location: index.php");
      } else {
        $msg = "Invalid username and password!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $msg = "Both fields are required!";
  }
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gym Management System</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style1.css"/>
</head>
<body>
    <div class="login-container">
        <h1>GYM Management | User Login</h1>
        <div class="login-box">
            <h2><i class="fa fa-sign-in"></i> Sign In</h2>
            <?php if($msg) { echo '<div class="error-msg">' . htmlentities($msg) . '</div>'; } ?>
            <form method="post">
                <label>Email</label>
                <input type="text" name="email" placeholder="Your Email" required>
                
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
                
                <button type="submit" name="submit">Log In</button>
            </form>
            <a href="registration.php">Didn't have any account? <br>Register here</a><br>
			<hr> 
			<a href="index.html">Back to Main Page</a>
        </div>
    </div>
</body>
</html>
