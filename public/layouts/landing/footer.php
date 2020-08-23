            <?php if ($page != "contact" && $page != "cart") { ?>
                <!-- Brands -->
                <div class="brands">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="brands_slider_container">

                                    <!-- Brands Slider -->

                                    <div class="owl-carousel owl-theme brands_slider">

                                        <div class="owl-item">
                                            <div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo public_url(); ?>front/images/brands_1.jpg" alt=""></div>
                                        </div>
                                        <div class="owl-item">
                                            <div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo public_url(); ?>front/images/brands_2.jpg" alt=""></div>
                                        </div>
                                        <div class="owl-item">
                                            <div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo public_url(); ?>front/images/brands_3.jpg" alt=""></div>
                                        </div>
                                        <div class="owl-item">
                                            <div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo public_url(); ?>front/images/brands_4.jpg" alt=""></div>
                                        </div>
                                        <div class="owl-item">
                                            <div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo public_url(); ?>front/images/brands_5.jpg" alt=""></div>
                                        </div>
                                        <div class="owl-item">
                                            <div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo public_url(); ?>front/images/brands_6.jpg" alt=""></div>
                                        </div>
                                        <div class="owl-item">
                                            <div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo public_url(); ?>front/images/brands_7.jpg" alt=""></div>
                                        </div>
                                        <div class="owl-item">
                                            <div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo public_url(); ?>front/images/brands_8.jpg" alt=""></div>
                                        </div>

                                    </div>

                                    <!-- Brands Slider Navigation -->
                                    <div class="brands_nav brands_prev"><i class="fa fa-chevron-left"></i></div>
                                    <div class="brands_nav brands_next"><i class="fa fa-chevron-right"></i></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Newsletter -->
            <div class="newsletter">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                                <div class="newsletter_title_container">
                                    <div class="newsletter_icon"><img src="<?php echo public_url(); ?>front/images/send.png" alt=""></div>
                                    <div class="newsletter_title">Sign up for Newsletter</div>
                                    <div class="newsletter_text">
                                        <p>...and receive %20 coupon for first shopping.</p>
                                    </div>
                                </div>
                                <div class="newsletter_content clearfix">
                                    <form action="#" class="newsletter_form">
                                        <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                                        <button class="newsletter_button">Subscribe</button>
                                    </form>
                                    <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 footer_col">
                            <div class="footer_column footer_contact">
                                <div class="logo_container">
                                    <div class="logo">
                                        <a href="<?php echo base_url(); ?>index.php">
                                            TadTech Africa
                                        </a>
                                    </div>
                                </div>
                                <div class="footer_title">Got Question? Call Us 24/7</div>
                                <div class="footer_phone">+254 793 033110</div>
                                <div class="footer_contact_text">
                                    <p>info@tadtechafrica.com</p>

                                </div>
                                <div class="footer_social">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google"></i></a></li>
                                        <li><a href="#"><i class="fa fa-vimeo-v"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 offset-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Find it Fast</div>
                                <ul class="footer_list">
                                    <?php
                                    if (count($product_categories) > 0) {
                                        foreach ($product_categories as $category) { ?>
                                            <li>
                                                <a href="#!" id="<?php echo htmlentities($category['id']); ?>" class="productsCategories">
                                                    <?php echo htmlentities($category['category_name']); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <li>
                                            <a href="<?php echo base_url(); ?>">No Categories</a></li>
                                    <?php } ?>
                                </ul>
                                <!-- <div class="footer_subtitle">Gadgets</div>
                                <ul class="footer_list">
                                    <li><a href="#">Car Electronics</a></li>
                                </ul> -->
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                &nbsp;
                                <!-- <ul class="footer_list footer_list_2">
                                    <li><a href="#">Video Games & Consoles</a></li>
                                    <li><a href="#">Accessories</a></li>
                                    <li><a href="#">Cameras & Photos</a></li>
                                    <li><a href="#">Hardware</a></li>
                                    <li><a href="#">Computers & Laptops</a></li>
                                </ul> -->
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Customer Care</div>
                                <ul class="footer_list">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Order Tracking</a></li>
                                    <li><a href="#">Wish List</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- Copyright -->
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                                <div class="copyright_content">
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </div>
                                <div class="logos ml-sm-auto">
                                    <ul class="logos_list">
                                        <li><a href="#"><img src="<?php echo public_url(); ?>front/images/logos_1.png" alt=""></a></li>
                                        <li><a href="#"><img src="<?php echo public_url(); ?>front/images/logos_2.png" alt=""></a></li>
                                        <li><a href="#"><img src="<?php echo public_url(); ?>front/images/logos_3.png" alt=""></a></li>
                                        <li><a href="#"><img src="<?php echo public_url(); ?>front/images/logos_4.png" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <script src="<?php echo public_url(); ?>front/js/jquery-3.3.1.min.js"></script>
            <script src="<?php echo public_url(); ?>front/css/bootstrap4/popper.js"></script>
            <script src="<?php echo public_url(); ?>front/css/bootstrap4/bootstrap.min.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/greensock/TweenMax.min.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/greensock/TimelineMax.min.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/scrollmagic/ScrollMagic.min.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/greensock/animation.gsap.min.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/greensock/ScrollToPlugin.min.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/slick-1.8.0/slick.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/easing/easing.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/Isotope/isotope.pkgd.min.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
            <script src="<?php echo public_url(); ?>front/plugins/parallax-js-master/parallax.min.js"></script>
            <!-- SweetAlert2 -->
            <script src="<?php echo public_url(); ?>back/plugins/sweetalert2/sweetalert2.min.js"></script>
            <!-- Toastr -->
            <script src="<?php echo public_url(); ?>back/plugins/toastr/toastr.min.js"></script>
            <?php if ($page == "home") { ?>
                <script src="<?php echo public_url(); ?>front/js/custom.js"></script>
            <?php } ?>
            <?php if ($page == "shop") { ?>
                <script src="<?php echo public_url(); ?>front/js/shop_custom.js"></script>
            <?php } ?>
            <?php if ($page == "contact") { ?>
                <script src="<?php echo public_url(); ?>front/js/contact_custom.js"></script>
            <?php } ?>
            <?php if ($page == "cart") { ?>
                <script src="<?php echo public_url(); ?>front/js/cart_custom.js"></script>
            <?php } ?>
            <?php if ($page == "product") { ?>
                <script src="<?php echo public_url(); ?>front/js/product_custom.js"></script>
            <?php } ?>
            <script>
                $(document).ready(function() {
                    $(document).on('click', '.productAddToCart', function() {
                        var product_id = $(this).attr('id');
                        $.ajax({
                            url: "<?php echo base_url(); ?>api/cart/new_cart_item.php",
                            type: "POST",
                            data: {
                                product_id: product_id
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == "success") {
                                    toastr.success('Product has been successfully added to cart.');
                                    find_customer_cart_items();
                                    window.location.href = "<?php echo base_url(); ?>customers/cart.php";
                                }
                                if (data.message == "productAdded") {
                                    toastr.error('Product already added in cart');
                                    return false;
                                }
                            }
                        });
                    });

                    $(document).on('click', '.productAddToWhishlist', function() {
                        var product_id = $(this).attr('id');
                        $.ajax({
                            url: "<?php echo base_url(); ?>api/wishlist/new_wishlist.php",
                            type: "POST",
                            data: {
                                product_id: product_id
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == "userNotLoggedIn") {
                                    toastr.error('Please login to your account to continue...');
                                    return false;
                                }
                                if (data.message == "success") {
                                    toastr.success('Product has been successfully added to wishlist.');
                                    find_customer_wishlist();
                                }
                                if (data.message == "productWishlistExist") {
                                    toastr.error('Product selected already added in the wishlist');
                                    return false;
                                }
                            }
                        });
                    });

                    find_customer_wishlist();
                    find_customer_cart_items();

                    function find_customer_wishlist() {
                        var action = "FETCH_NUM_ITEMS_WISHLIST";
                        $.ajax({
                            url: "<?php echo base_url(); ?>api/wishlist/wishlist.php",
                            type: "POST",
                            data: {
                                action: action
                            },
                            dataType: "json",
                            success: function(data) {
                                $('#numWishlistItems').html(data.total_items);
                            }
                        });
                    }

                    function find_customer_cart_items() {
                        var action = "FETCH_CART_ITEMS";
                        $.ajax({
                            url: "<?php echo base_url(); ?>api/cart/cart.php",
                            type: "POST",
                            data: {
                                action: action
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == "noCartItems") {
                                    $('#numCartItems').html(0);
                                    $('#cartPrice').html(0);
                                    $('#loadCartItems').html('<ul class="cart_list"><li>No Cart Items</li></ul>');
                                    return false;
                                } else {
                                    $('#numCartItems').html(data.total_items);
                                    $('#cartPrice').html(data.total_price);
                                    $('#cartTotal').html(data.total_price);
                                    $('#loadCartItems').html(data.cart_details);
                                }
                            }
                        });
                    }

                    $(document).on('click', '.productDetailsBtn', function() {
                        var product_id = $(this).attr("id");
                        var action = "FETCH_PRODUCT";
                        $.ajax({
                            url: "<?php echo base_url(); ?>api/products/products.php",
                            type: "POST",
                            data: {
                                action: action,
                                product_id: product_id
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == "errorProduct") {
                                    toastr.error('Product selected doesnot exist');
                                    return false;
                                } else {
                                    var p_id = $.trim(data.id);
                                    localStorage.setItem('product_id', p_id);
                                    window.location.href = "<?php echo base_url(); ?>landing/product_details.php?product=" + p_id;
                                }
                            }

                        });
                    });

                    $(document).on('click', '.productsCategories', function() {
                        var category_id = $(this).attr('id');
                        var action = "FETCH_CATEGORY";
                        $.ajax({
                            url: "<?php echo base_url(); ?>api/categories/categories.php",
                            type: "POST",
                            data: {
                                action: action,
                                category_id: category_id
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == "errorCategory") {
                                    toastr.error('Category selected doesnot exist');
                                    return false;
                                } else {
                                    var c_id = $.trim(data.id);
                                    localStorage.setItem('category_id', c_id);
                                    window.location.href = "<?php echo base_url(); ?>landing/products_category.php?category=" + c_id;
                                }
                            }
                        });
                    });

                    // remove from cart 
                    $(document).on('click', '.remove_item', function(e) {
                        e.preventDefault();
                        var cart_id = $(this).attr('id');
                        var action = "DELETE_ITEM";
                        $.ajax({
                            url: "<?php echo base_url(); ?>api/cart/cart.php",
                            type: "POST",
                            data: {
                                action: action,
                                cart_id: cart_id
                            },
                            dataType: "json",
                            success: function(data) {
                                // console.table(data);
                                if (data.message == "success") {
                                    toastr.success('Item successfully removed from cart');
                                    window.location.reload();
                                }

                            }
                        });
                    });

                    // click logout
                    $(document).on('click', '.logout', function(event) {
                        event.preventDefault();
                        logout();
                    });

                    // logout function 
                    function logout() {
                        var action = "LOGOUT";
                        $.ajax({
                            url: "<?php echo base_url(); ?>api/customers/customers.php",
                            type: "POST",
                            data: {
                                action: action
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == "success") {
                                    window.location.href = "<?php echo base_url(); ?>index.php";
                                }
                            }
                        })
                    }

                    // view customer wishlist
                    $(document).on('click', '.viewWishlistBtn', function() {
                        var action = "FETCH_CUSTOMER";
                        $.ajax({
                            url: "<?php echo base_url(); ?>api/customers/customers.php",
                            type: "POST",
                            data: {
                                action: action
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.message == "errorCustomer") {
                                    toastr.error('Please login to your customer account to continue...');
                                    window.location.href = "<?php echo base_url(); ?>landing/account.php";
                                    return false;
                                }else{
                                    window.location.href = "<?php echo base_url(); ?>customers/wishlist.php";
                                }
                            }
                        });
                    });

                });
            </script>
            </body>

            </html>