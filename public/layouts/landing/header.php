<?php 
$categories = new Categories();
$product_categories = $categories->find_all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlentities($title); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo public_url(); ?>front/css/bootstrap4/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo public_url(); ?>fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo public_url(); ?>front/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo public_url(); ?>front/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="<?php echo public_url(); ?>front/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo public_url(); ?>front/plugins/slick-1.8.0/slick.css">
    <link rel="stylesheet" type="text/css" href="<?php echo public_url(); ?>front/css/main_styles.css">
    <link rel="stylesheet" type="text/css" href="<?php echo public_url(); ?>front/css/responsive.css">
</head>
<body>
    <div class="super_container">
        <!-- Header -->
        <header class="header">
            <!-- Top Bar -->
            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon">
                                    <img src="<?php echo public_url(); ?>front/images/phone.png" alt="">
                                </div>+38 068 005 3570
                            </div>
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon">
                                    <img src="<?php echo public_url(); ?>front/images/mail.png" alt="">
                                </div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a>
                            </div>
                            <div class="top_bar_content ml-auto">
                                <div class="top_bar_user">
                                    <div class="user_icon">
                                        <img src="<?php echo public_url(); ?>front/images/user.svg" alt="">
                                    </div>
                                    <div><a href="#">Register</a></div>
                                    <div><a href="#">Sign in</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Main -->
            <div class="header_main">
                <div class="container">
                    <div class="row">

                        <!-- Logo -->
                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                            <div class="logo_container">
                                <div class="logo">
                                    <a href="<?php echo base_url(); ?>index.php">
                                        <img src="<?php echo public_url(); ?>storage/logo/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form action="#" class="header_search_form clearfix">
                                            <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
                                            <button type="submit" class="header_search_button trans_300" value="Submit">
                                                <img src="<?php echo public_url(); ?>front/images/search.png" alt="">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                            <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                    <div class="wishlist_icon"><img src="<?php echo public_url(); ?>front/images/heart.png" alt=""></div>
                                    <div class="wishlist_content">
                                        <div class="wishlist_text"><a href="#">Wishlist</a></div>
                                        <div class="wishlist_count">115</div>
                                    </div>
                                </div>

                                <!-- Cart -->
                                <div class="cart">
                                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                        <div class="cart_icon">
                                            <img src="<?php echo public_url(); ?>front/images/cart.png" alt="">
                                            <div class="cart_count"><span>10</span></div>
                                        </div>
                                        <div class="cart_content">
                                            <div class="cart_text"><a href="#">Cart</a></div>
                                            <div class="cart_price">$85</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('navbar.php'); ?>
        </header>