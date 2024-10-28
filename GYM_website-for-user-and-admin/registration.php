<?php
error_reporting(0);
require_once('include/config.php');

if(isset($_POST['submit']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $Password = $_POST['password'];
    $pass = md5($Password);
    $RepeatPassword = $_POST['RepeatPassword'];

    $usermatch = $dbh->prepare("SELECT mobile, email FROM tbluser WHERE (email=:usreml || mobile=:mblenmbr)");
    $usermatch->execute(array(':usreml' => $email, ':mblenmbr' => $mobile));
    $row = $usermatch->fetch(PDO::FETCH_ASSOC);

    if (empty($fname)) {
        $error = "Please Enter First Name";
    } else if (empty($mobile)) {
        $error = "Please Enter Mobile No";
    } else if (empty($email)) {
        $error = "Please Enter Email";
    } else if ($email == $row['email'] || $mobile == $row['mobile']) {
        $error = "Email Id or Mobile Number Already Exists!";
    } else if (empty($Password) || empty($RepeatPassword)) {
        $error = "Password And Confirm Password Cannot Be Empty!";
    } else if ($Password != $RepeatPassword) {
        $error = "Password And Confirm Password Do Not Match";
    } else {
        $sql = "INSERT INTO tbluser (fname, lname, email, mobile, state, city, password) VALUES (:fname, :lname, :email, :mobile, :state, :city, :Password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':state', $state, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':Password', $pass, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId > 0) {
            echo "<script>alert('Registration successful. Please login');</script>";
            echo "<script> window.location.href='login.php';</script>";
        } else {
            $error = "Registration Not Successful";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gym Management | Register</title>
    <link rel="stylesheet" href="css/style3.css">
</head>
<body>
    <div class="registration-container">
        <h1>GYM Management | User Registration</h1>
		<div class="registration-box">
            <h2><i class="fa fa-sign-in"></i> Sign Up</h2>
        <form method="post">
            <?php if ($error) { ?><div class="errorWrap"><?php echo htmlentities($error); ?></div><?php } ?>
            <div class="name-row">
                <input type="text" name="fname" placeholder="First Name" value="<?php echo htmlentities($fname); ?>" required>
                <input type="text" name="lname" placeholder="Last Name" value="<?php echo htmlentities($lname); ?>" required>
            </div>
            <div class="name-row">
                <input type="text" name="email" placeholder="Email" value="<?php echo htmlentities($email); ?>" required>
                <input type="text" name="mobile" maxlength="10" placeholder="Mobile Number" value="<?php echo htmlentities($mobile); ?>" required>
            </div>
            <div class="name-row">
                <input type="text" name="state" placeholder="State" value="<?php echo htmlentities($state); ?>" required>
                <input type="text" name="city" placeholder="City" value="<?php echo htmlentities($city); ?>" required>
            </div>
            <div class="name-row">
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="RepeatPassword" placeholder="Confirm Password" required>
            </div>
            <button type="submit" name="submit">Register Now</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
		</div>
    </div>
</body>
</html>
