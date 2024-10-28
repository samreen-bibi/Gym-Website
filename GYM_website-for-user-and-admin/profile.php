<?php
session_start();
error_reporting(0);
require_once('include/config.php');

$msg = ""; 
$error = "";

if (strlen($_SESSION["uid"]) == 0) {
    header('location:login.php');
    exit; // Always a good practice to exit after redirecting
} else {
    if (isset($_POST['submit'])) {
        $uid = $_SESSION['uid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $address = $_POST['address'];

        // Update user details
        $sql = "UPDATE tbluser SET fname=:fname, lname=:lname, mobile=:mobile, city=:city, state=:state, address=:Address WHERE id=:uid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':state', $state, PDO::PARAM_STR);
        $query->bindParam(':Address', $address, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->execute();

        // Success message
        $msg = "Profile has been updated.";
    }

    // Fetch user information
    $uid = $_SESSION['uid'];
    $sql = "SELECT id, fname, lname, email, mobile, address, state, city FROM tbluser WHERE id=:uid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Update</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style1.css"/>
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
        <h2>Update Profile</h2>
        <div class="login-box">
        <?php if($error) { echo '<div class="error-msg">' . htmlentities($error) . '</div>'; } ?>
        <?php if($msg) { echo '<div class="success-msg">' . htmlentities($msg) . '</div>'; } ?>
        
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="fname" id="fname" placeholder="First Name" autocomplete="off" value="<?php echo htmlentities($result['fname']); ?>" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="lname" id="lname" placeholder="Last Name" autocomplete="off" value="<?php echo htmlentities($result['lname']); ?>" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" value="<?php echo htmlentities($result['email']); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <input type="text" name="mobile" id="mobile" placeholder="Mobile Number" autocomplete="off" value="<?php echo htmlentities($result['mobile']); ?>" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="state" id="state" placeholder="State" autocomplete="off" value="<?php echo htmlentities($result['state']); ?>" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="city" id="city" placeholder="City" autocomplete="off" value="<?php echo htmlentities($result['city']); ?>" required>
                </div>
                <div class="col-md-12">
                    <input type="text" name="address" id="address" placeholder="Address" autocomplete="off" value="<?php echo htmlentities($result['address']); ?>" required>
                </div>
                <!--<div class="col-md-12">
                    <input type="submit" id="submit" name="submit" value="Update Profile" class="btn btn-primary">
                </div>-->
				<button type="submit" name="submit">Update Profile</button>
            </div>
        </form>
        <hr>
        <a href="index.php">Back to Home Page</a>
    </div>
	</div>
</body>
</html>
