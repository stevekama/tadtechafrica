<?php
$classification = new Product_Classification();
$categories = new Categories();
?>
<!DOCTYPE html>
<html lang="Eng">
<head>
	<title>Tadtech Africa | Online Store</title>
	<meta charset="UTF-8">
	<meta name="description" content="Tadtech Africa | Online Store">
	<meta name="keywords" content="tadtech, tadtechafrica, computers, smart watches">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="<?php echo public_url(); ?>storage/logo/logo.ico" rel="shortcut icon"/>

	<!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">
    
    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo public_url(); ?>fonts/font-awesome/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo public_url(); ?>front/css/flaticon.css"/>

	<!-- Libraries -->
	<link rel="stylesheet" href="<?php echo public_url(); ?>front/css/bootstrap.min.css"/>
	<!-- Toastr -->
	<link rel="stylesheet" href="<?php echo public_url(); ?>back/plugins/toastr/toastr.min.css">
	
	<link rel="stylesheet" href="<?php echo public_url(); ?>front/css/slicknav.min.css"/>
	<link rel="stylesheet" href="<?php echo public_url(); ?>front/css/jquery-ui.min.css"/>
    <link rel="stylesheet" href="<?php echo public_url(); ?>front/css/owl.carousel.min.css"/>
    
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo public_url(); ?>front/css/animate.css"/>
    
	<link rel="stylesheet" href="<?php echo public_url(); ?>front/css/style.css"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="<?php echo base_url(); ?>" class="site-logo">
							<img src="<?php echo public_url(); ?>storage/logo/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form class="header-search-form">
							<input type="text" placeholder="Search....">
							<button><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<a href="<?php echo base_url(); ?>customers/login.php">Sign</a> In or <a href="<?php echo base_url(); ?>customers/login.php">Create Account</a>
							</div>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span id="numCartItems"></span>
								</div>
								<a href="<?php echo base_url(); ?>landing/cart.php">
									Shopping Cart
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include('navbar.php'); ?>
	</header>
	<!-- Header section end -->
