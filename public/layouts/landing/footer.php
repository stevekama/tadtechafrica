            <?php if($page != "contact"){ ?>
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
                                <div class="footer_phone">+38 068 005 3570</div>
                                <div class="footer_contact_text">
                                    <p>17 Princess Road, London</p>
                                    <p>Grester London NW18JR, UK</p>
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
                                    if(count($product_categories) > 0){
                                        foreach($product_categories as $category){ ?>
                                            <li>
                                                <a href="#!" id="<?php echo md5($category['id']); ?>" class="productsCategories">
                                                    <?php echo htmlentities($category['category_name']); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    <?php }else{ ?>
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
                                <ul class="footer_list footer_list_2">
                                    <li><a href="#">Video Games & Consoles</a></li>
                                    <li><a href="#">Accessories</a></li>
                                    <li><a href="#">Cameras & Photos</a></li>
                                    <li><a href="#">Hardware</a></li>
                                    <li><a href="#">Computers & Laptops</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Customer Care</div>
                                <ul class="footer_list">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Order Tracking</a></li>
                                    <li><a href="#">Wish List</a></li>
                                    <li><a href="#">Customer Services</a></li>
                                    <li><a href="#">Returns / Exchange</a></li>
                                    <li><a href="#">FAQs</a></li>
                                    <li><a href="#">Product Support</a></li>
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
        <?php if($page == "home"){ ?>
            <script src="<?php echo public_url(); ?>front/js/custom.js"></script>
        <?php } ?>
        <?php if($page == "shop"){ ?>
            <script src="<?php echo public_url(); ?>front/js/shop_custom.js"></script>    
        <?php } ?>
        <?php if($page == "contact"){ ?>
            <script src="<?php echo public_url(); ?>front/js/contact_custom.js"></script>    
        <?php } ?>
    </body>
</html>