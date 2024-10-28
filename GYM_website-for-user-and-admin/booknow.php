<?php 
session_start();
error_reporting(0);
include 'include/config.php';
$uid=$_SESSION['uid'];

if(isset($_POST['submit']))
{ 
$pid=$_POST['pid'];


$sql="INSERT INTO tblbooking (package_id,userid) Values(:pid,:uid)";

$query = $dbh -> prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Package has been booked.');</script>";
echo "<script>window.location.href='booking-history.php'</script>";

}

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Gym Management System</title>
	<meta charset="UTF-8">
	<meta name="description" content="Ahana Yoga HTML Template">
	<meta name="keywords" content="yoga, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<!-- Header Start -->
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


	<!-- Pricing Section -->
	<section class="pricing-section spad">
		<div class="container">
			<div class="section-title text-center">
				<img src="img/icons/logo-icon.png" alt=""><br><br>
				<h2>Book your Plan</h2>
				<p class="large-paragraph">Unlock your fitness potential by choosing one of our carefully crafted plans! Whether you're looking to build strength, enhance flexibility, or boost overall wellness, we have a package tailored just for you. Don’t wait any longer—book your plan today and take the first step towards a healthier, happier you!</p>
			</div>
			<div class="row">
				        <?php 

						$sql ="SELECT id, category, titlename, PackageType, PackageDuratiobn, Price, uploadphoto, Description, create_date from tbladdpackage";
						$query= $dbh -> prepare($sql);
						$query-> execute();
						$results = $query -> fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						if($query -> rowCount() > 0)
						{
						foreach($results as $result)
						{
						?>
				<div class="col-lg-3 col-sm-6">
					<div class="pricing-item begginer">
						<div class="pi-top">
							<h4><?php echo $result->titlename;?></h4>
						</div>
						<div class="pi-price">
							<h3><?php echo htmlentities($result->Price);?></h3>
							<p>	<?php echo $result->PackageDuratiobn;?></p>
						</div>
						<ul>
							<?php echo $result->Description;?>
							
						</ul>
						<?php if(strlen($_SESSION['uid'])==0): ?>
						<a href="login.php" class="site-btn sb-line-gradient">Booking Now</a>
						<?php else :?>
							<!-- <a href="#" class="site-btn sb-line-gradient">Booking Now</a> -->
							 <form method='post'>
                            <input type='hidden' name='pid' value='<?php echo htmlentities($result->id);?>'>
                          

                        <input class='site-btn sb-line-gradient' type='submit' name='submit' value='Booking Now' onclick="return confirm('Do you really want to book this package.');"> 
                        </form> 
							 <?php endif;?>
					</div>
				</div>
				<?php  $cnt=$cnt+1; } } ?>
			</div>
		</div>
	</section>
	<footer style="background-color: black; color: #FB5B21; text-align: center; padding: 10px;">
  <p style="margin: 0; font-size: 14px; font-weight: bold;">
    &copy; All rights reserved | Gymster
  </p>
</footer>
	</body>
</html>
