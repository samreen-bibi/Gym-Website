<?php session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["uid"])==0)
    {   
header('location:login.php');
}
else{
$uid=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>User | Booking History</title>
	<meta charset="UTF-8">
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
				<img src="img/icons/logo-icon.png" alt=""><br><br>
				<h2>Booking History</h2>
				<p class="large-paragraph">Welcome to your Booking History! Here, you can find a record of all your past reservations, complete with essential details such as booking date, package type, duration, and cost. Simply click "View" to explore each booking further and revisit your journey with us.</p>
			</div>
		</div>
	</section>
	<!-- Page top Section end -->


	<section class="contact-page-section spad overflow-hidden">
		<div class="container">
			
			<div class="row">

				<div class="col-lg-12">
					<table class="table table-bordered">
    <thead>
      <tr>
        <th>Sr.No</th>
        <th hidden>bookingid</th>
        <th hidden>Name</th>
        <th hidden>email</th>
        <th>bookingdate</th>
        <th>title</th>
        <th>PackageDuration</th>
        <th>price</th>
        <th>Description</th>
        <th>category_name</th>
        <th>PackageName</th>
        <th>Action</th>


      </tr>
    </thead>
          <?php
          $uid=$_SESSION['uid'];
                  /*$sql="select id, product_id, userid, product_title, packages, category, PackageDuratiobn, price, descripation, booking_date from tblbooking where userid=:uid";*/
                  $sql="SELECT t1.id as bookingid,t3.fname as Name, t3.email as email,t1.booking_date as bookingdate,t2.titlename as title,t2.PackageDuratiobn as PackageDuratiobn,
t2.Price as Price,t2.Description as Description,t4.category_name as category_name,t5.PackageName as PackageName FROM tblbooking as t1
 join tbladdpackage as t2
on t1.package_id =t2.id
join tbluser as t3
on t1.userid=t3.id
join tblcategory as t4
on t2.category=t4.id
join tblpackage as t5
on t2.PackageType=t5.id
where t1.userid=:uid";
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':uid',$uid, PDO::PARAM_STR);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>

                <tbody>
                  <tr>
                    <td><?php echo($cnt);?></td>
                    <td hidden><?php echo htmlentities($result->bookingid);?></td>
                    <td hidden><?php echo htmlentities($result->Name);?></td>
                    <td hidden><?php echo htmlentities($result->email);?></td>
                    <td><?php echo htmlentities($result->bookingdate);?></td>
                    <td><?php echo htmlentities($result->title);?></td>
                    <td><?php echo htmlentities($result->PackageDuratiobn);?></td>
                    <td><?php echo $result->Price;?></td>
                    <td><?php echo $result->Description;?></td>
                    <td><?php echo htmlentities($result->category_name);?></td>
                    <td><?php echo htmlentities($result->PackageName);?></td>
                    <td><a href="booking-details.php?bookingid=<?php echo htmlentities($result->bookingid);?>"><button class="btn btn-primary" type="button">View</button></td>
                  </tr>
                    <?php  $cnt=$cnt+1; } } ?>
              
                </tbody>
  </table>
				</div>
			
			</div>
		</div>
	</section>
	<!-- Trainers Section end -->

    <footer style="background-color: black; color: #FB5B21; text-align: center; padding: 10px;">
  <p style="margin: 0; font-size: 14px; font-weight: bold;">
    &copy; All rights reserved | Gymster
  </p>
</footer>

	
	<div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main1.js"></script>

	</body>
</html>
 <style>
    
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #dd3d36;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #5cb85c;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
        <?php } ?>