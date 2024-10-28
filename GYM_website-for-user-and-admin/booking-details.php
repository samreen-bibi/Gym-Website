<?php 
session_start();
error_reporting(E_ALL); // Show all errors for debugging
ini_set('display_errors', 1); // Enable display of errors

require_once('include/config.php'); // Database connection

if (strlen($_SESSION["uid"]) == 0) {   
    header('location:login.php');
} else {
    $uid = $_SESSION['uid'];
    $bookingid = isset($_GET['bookingid']) ? $_GET['bookingid'] : 0; // Get booking ID from URL

    // Check if booking ID is valid
    if (!$bookingid) {
        echo "Booking ID is missing or invalid.";
        exit;
    }

    // Fetch booking details with a single query
    $sql = "SELECT 
                t1.id AS bookingid,
                t3.fname AS Name, 
                t3.email AS email,
                t1.booking_date AS bookingdate,
                t2.titlename AS title,
                t2.PackageDuratiobn AS PackageDuration,
                t2.Price AS Price,
                t2.Description AS Description,
                t4.category_name AS category_name,
                t5.PackageName AS PackageName,
                t1.payment AS payment,
                t1.paymentType AS paymentType
            FROM tblbooking AS t1
            JOIN tbladdpackage AS t2 ON t1.package_id = t2.id
            JOIN tbluser AS t3 ON t1.userid = t3.id
            JOIN tblcategory AS t4 ON t2.category = t4.id
            JOIN tblpackage AS t5 ON t2.PackageType = t5.id
            WHERE t1.id = :bookingid AND t1.userid = :uid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':bookingid', $bookingid, PDO::PARAM_INT);
    $query->bindParam(':uid', $uid, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_OBJ);

    // If no result is found, display a message
    if (!$result) {
        echo "No booking details found for the specified ID.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>User | Booking Details</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>

	<meta name="description" content="Ahana Yoga HTML Template">
	<meta name="keywords" content="yoga, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/nice-select.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>

	<!-- Main Stylesheets 
	<link rel="stylesheet" href="css/style.css"/>-->

  <!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/nice-select.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style4.css"/>
	<link href="css1/style.css" rel="stylesheet">

	    <!-- Favicon -->
		<link href="img/favicon.ico" rel="icon">
	
	<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet"> 

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="css1/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="css1/style.css" rel="stylesheet">


</head>
<body>

<!-- Header Section -->
<div class="container-fluid bg-dark fixed-top px-0">
    <div class="row gx-0">
        <div class="col-lg-3 bg-dark d-none d-lg-block">
            <a href="index.html" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                <h1 class="m-0 display-4 text-primary text-uppercase">Gymster</h1>
            </a>
        </div>

        <div class="col-lg-9">
            

            <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0 px-lg-5">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary text-uppercase">Gymster</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="index.php#class" class="nav-item nav-link">Classes</a>
                        <a href="index.php#team" class="nav-item nav-link">Trainers</a>
                        <a href="index.php#contact" class="nav-item nav-link">Contact</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Bookings</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="booknow.php" class="dropdown-item">Book Now</a>
                                <a href="Booking-History.php" class="dropdown-item">Booking History</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="d-none d-lg-inline-flex align-items-center ms-auto">
    <?php if(strlen($_SESSION['uid']) != 0): ?>
        <div class="header-info me-3">
            <a href="profile.php" style="text-decoration: none; color: #FB5B21;" onmouseover="this.style.color='#FB5B21'" onmouseout="this.style.color='#FB5B21'">
                <i class="fa fa-user-circle me-2"></i>My Profile
            </a>
        </div>
        <div class="header-info me-3">
            <a href="changepassword.php" style="text-decoration: none; color: #FB5B21;" onmouseover="this.style.color='#FB5B21'" onmouseout="this.style.color='#FB5B21'">
                <i class="fa fa-cog me-2"></i>Change Password
            </a>
        </div>
        <div class="header-info">
            <a href="logout.php" style="text-decoration: none; color: #FB5B21;" onmouseover="this.style.color='#FB5B21'" onmouseout="this.style.color='#FB5B21'">
                <i class="fa fa-sign-out-alt me-2"></i>Logout
            </a>
        </div>
    <?php endif; ?>
</div>

                </div>
            </nav>
        </div>
    </div>
</div>


	<!-- Header Section end -->
	                                                                              
	<!-- Page top Section -->
	<section class="pricing-section spad">
		<div class="container">
			<div class="section-title text-center">
				<img src="img/icons/logo-icon.png" alt=""><br><br><br><br>
				<h2>Booking Details</h2>
				<p class="large-paragraph">Welcome to your Booking Details! Here, you can find a record of all your past reservations, complete with essential details such as booking date, package type, duration, and cost. You can also check had you paid for your package or not.</p>
			</div>
		</div>
	</section>
	<!-- Page top Section end -->


    <div class="container">
        <h2>Booking Details</h2><br>
        <table class="table table-bordered">
            <tr>
                <th>Booking Date</th>
                <td><?php echo htmlentities($result->bookingdate); ?></td>
                <th>Name</th>
                <td><?php echo htmlentities($result->Name); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlentities($result->email); ?></td>
                <th>Category</th>
                <td><?php echo htmlentities($result->category_name); ?></td>
            </tr>
            <tr>
                <th>Package Name</th>
                <td><?php echo htmlentities($result->PackageName); ?></td>
                <th>Title</th>
                <td><?php echo htmlentities($result->title); ?></td>
            </tr>
            <tr>
                <th>Package Duration</th>
                <td><?php echo htmlentities($result->PackageDuration); ?></td>
                <th>Price</th>
                <td><?php echo htmlentities($result->Price); ?></td>
            </tr>
            
            <tr>
                <th>Payment Type</th>
                <td colspan="3">
                    <?php echo $result->paymentType ? htmlentities($result->paymentType) : "Payment not made yet"; ?>
                </td>
            </tr>
        </table>

        <!-- Fetch Payment History -->
        <?php
        $sql = "SELECT paymentType, payment, payment_date 
                FROM tblpayment
                WHERE bookingID = :bookingid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookingid', $bookingid, PDO::PARAM_INT);
        $query->execute();
        $payments = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) { ?>
            <h3>Payment History</h3>
            <table class="table table-bordered">
                <tr>
                    <th>Payment Type</th>
                    <th>Amount Paid</th>
                    <th>Payment Date</th>
                </tr>
                <?php
                $totalPayment = 0;
                foreach ($payments as $payment) {
                    echo "<tr>";
                    echo "<td>" . htmlentities($payment->paymentType) . "</td>";
                    echo "<td>" . htmlentities($payment->payment) . "</td>";
                    echo "<td>" . htmlentities($payment->payment_date) . "</td>";
                    echo "</tr>";
                    $totalPayment += $payment->payment;
                }
                ?>
                <tr>
                    <th>Total</th>
                    <td colspan="2"><?php echo htmlentities($totalPayment); ?></td>
                </tr>
            </table>
        <?php } ?>
    </div>
    <footer style="background-color: black; color: #FB5B21; text-align: center; padding: 10px;">
  <p style="margin: 0; font-size: 14px; font-weight: bold;">
    &copy; All rights reserved | Gymster
  </p>
</footer>
</body>
</html>

<?php } ?>
