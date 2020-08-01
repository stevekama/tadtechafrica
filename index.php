<?php
require_once('init/initialization.php');
$title = "TadTechAfrica || Get upto date with the lattest tech";
$page = "home";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
$products = new Products();
// find all products 
$all_products = $products->find_all();
?>
<!-- Banner -->
<div class="banner">
    <div class="banner_background" style="background-image:url(<?php echo public_url(); ?>front/images/banner_background.jpg)"></div>
    <div class="container fill_height">
        <div class="row fill_height">
            <div class="banner_product_image">
                <img src="<?php echo public_url(); ?>front/images/banner_product.png" alt="">
            </div>
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    <h1 class="banner_text">new era of smartphones</h1>
                    <div class="banner_price"><span>$530</span>$460</div>
                    <div class="banner_product_name">Apple Iphone 6s</div>
                    <div class="button banner_button"><a href="#">Shop Now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Characteristics -->
<div class="characteristics">
    <div class="container">
        <div class="row">
            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">
                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon">
                        <img src="<?php echo public_url(); ?>front/images/char_1.png" alt="">
                    </div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="<?php echo public_url(); ?>front/images/char_2.png" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="<?php echo public_url(); ?>front/images/char_3.png" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>

            <!-- Char. Item -->
            <div class="col-lg-3 col-md-6 char_col">

                <div class="char_item d-flex flex-row align-items-center justify-content-start">
                    <div class="char_icon"><img src="<?php echo public_url(); ?>front/images/char_4.png" alt=""></div>
                    <div class="char_content">
                        <div class="char_title">Free Delivery</div>
                        <div class="char_subtitle">from $50</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deals of the week -->
<div class="deals_featured">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                <!-- Deals -->
                <div class="deals">
                    <div class="deals_title">Deals of the Week</div>
                    <div class="deals_slider_container">

                        <!-- Deals Slider -->
                        <div class="owl-carousel owl-theme deals_slider">
                            <?php if (count($all_products) > 0) { ?>
                                <?php foreach ($all_products as $product) { ?>
                                    <!-- Deals Item -->
                                    <div class="owl-item deals_item">
                                        <div class="deals_image">
                                            <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                                        </div>
                                        <div class="deals_content">
                                            <div class="deals_info_line d-flex flex-row justify-content-start">
                                                <?php
                                                // $categories = new Categories();
                                                $current_category = $categories->find_category_by_id($product['category_id']); ?>
                                                <div class="deals_item_category">
                                                    <a href="#">
                                                        <?php echo htmlentities($current_category['category_name']); ?>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="deals_info_line d-flex flex-row justify-content-start">
                                                <div class="deals_item_name"><?php echo htmlentities($product['product_name']); ?></div>
                                                <div class="deals_item_price ml-auto">KShs.<?php echo htmlentities($product['product_price']); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <!-- Deals Item -->
                                <div class="owl-item deals_item">
                                    <div class="deals_image">
                                        <img src="<?php echo public_url(); ?>storage/products/noimage.png" alt="">
                                    </div>
                                    <div class="deals_content">

                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_name">
                                                <a href="<?php echo base_url(); ?>">Welcome TadTech</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="deals_slider_nav_container">
                        <div class="deals_slider_prev deals_slider_nav"><i class="fa fa-chevron-left ml-auto"></i></div>
                        <div class="deals_slider_next deals_slider_nav"><i class="fa fa-chevron-right ml-auto"></i></div>
                    </div>
                </div>

                <!-- Featured -->
                <div class="featured">
                    <div class="tabbed_container">
                        <div class="tabs">
                            <ul class="clearfix">
                                <li class="active">Featured</li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>

                        <!-- Product Panel -->
                        <div class="product_panel panel active">
                            <div class="featured_slider slider">
                                <?php if (count($all_products) > 0) { ?>
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                                            </div>
                                            <div class="product_content">
                                                <div class="product_price discount">KShs.<?php echo htmlentities($product['product_price']); ?></div>
                                                <div class="product_name">
                                                    <div>
                                                        <a href="#" id="<?php echo md5($product['id']); ?>">
                                                            <?php echo htmlentities($product['product_name']); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product_extras">
                                                    <button class="product_cart_button">Add to Cart</button>
                                                </div>
                                            </div>
                                            <div class="product_fav"><i class="fa fa-heart"></i></div>
                                            <ul class="product_marks">
                                                <li class="product_mark product_new">
                                                    <?php echo htmlentities($product['product_status']); ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="<?php echo public_url(); ?>storage/products/noimage.png" alt="">
                                            </div>
                                            <div class="product_content">
                                                <div class="product_price">$379</div>
                                                <div class="product_name">
                                                    <div>
                                                        <a href="<?php echo base_url(); ?>">
                                                            Welcome TadTech
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Categories -->
<div class="popular_categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="popular_categories_content">
                    <div class="popular_categories_title">Popular Categories</div>
                    <div class="popular_categories_slider_nav">
                        <div class="popular_categories_prev popular_categories_nav"><i class="fa fa-angle-left ml-auto"></i></div>
                        <div class="popular_categories_next popular_categories_nav"><i class="fa fa-angle-right ml-auto"></i></div>
                    </div>

                </div>
            </div>

            <!-- Popular Categories Slider -->

            <div class="col-lg-9">
                <div class="popular_categories_slider_container">
                    <div class="owl-carousel owl-theme popular_categories_slider">
                        <?php if (count($product_categories) > 0) {
                            foreach ($product_categories as $category) { ?>
                                <!-- Popular Categories Item -->
                                <div class="owl-item">
                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                        <div class="popular_category_image">
                                            <img src="<?php echo public_url(); ?>storage/categories/<?php echo htmlentities($category['category_image']); ?>" alt="">
                                        </div>
                                        <div class="popular_category_text">
                                            <?php echo htmlentities($category['category_name']);  ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image">
                                        <img src="<?php echo public_url(); ?>storage/categories/noimage.png" alt="">
                                    </div>
                                    <div class="popular_category_text">
                                        No Categories
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Banner -->
<div class="banner_2">
    <div class="banner_2_background" style="background-image:url(<?php echo public_url(); ?>front/images/banner_2_background.jpg)"></div>
    <div class="banner_2_container">
        <div class="banner_2_dots"></div>
        <!-- Banner 2 Slider -->
        <div class="owl-carousel owl-theme banner_2_slider">
            <?php if (count($all_products) > 0) {

                foreach ($all_products as $product) { ?>
                    <!-- Banner 2 Slider Item -->
                    <div class="owl-item">
                        <div class="banner_2_item">
                            <div class="container fill_height">
                                <div class="row fill_height">
                                    <div class="col-lg-4 col-md-6 fill_height">
                                        <div class="banner_2_content">
                                            <div class="banner_2_category">
                                                <?php echo htmlentities($product['category_name']); ?>
                                            </div>
                                            <div class="banner_2_title">
                                                <?php echo htmlentities($product['product_name']); ?>
                                            </div>
                                            <div class="banner_2_text">
                                                <?php echo htmlentities($product['product_details']); ?>
                                            </div>
                                            <div class="rating_r rating_r_4 banner_2_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                            <div class="button banner_2_button">
                                                <a href="#">Explore</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6 fill_height">
                                        <div class="banner_2_image_container">
                                            <div class="banner_2_image">
                                                <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!-- Banner 2 Slider Item -->
                <div class="owl-item">
                    <div class="banner_2_item">
                        <div class="container fill_height">
                            <div class="row fill_height">
                                <div class="col-lg-4 col-md-6 fill_height">
                                    <div class="banner_2_content">
                                        <div class="banner_2_category">No Category</div>
                                        <div class="banner_2_title">TadTech Africa</div>
                                        <div class="banner_2_text">
                                            Welcome to TadTech Africa
                                        </div>
                                        <div class="rating_r rating_r_4 banner_2_rating">
                                            <i></i><i></i><i></i><i></i><i></i>
                                        </div>
                                        <div class="button banner_2_button">
                                            <a href="<?php echo base_url(); ?>">Explore</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-8 col-md-6 fill_height">
                                    <div class="banner_2_image_container">
                                        <div class="banner_2_image">
                                            <img src="<?php echo public_url(); ?>storage/products/noimage.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Hot New Arrivals -->
<div class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">Hot New Arrivals</div>
                        <ul class="clearfix">
                            <li class="active">
                                Top Featured
                            </li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="z-index:1;">
                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="arrivals_slider slider">
                                    <?php if (count($all_products) > 0) {
                                        foreach ($all_products as $product) { ?>
                                            <!-- Slider Item -->
                                            <div class="arrivals_slider_item">
                                                <div class="border_active"></div>
                                                <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                        <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                                                    </div>
                                                    <div class="product_content">
                                                        <div class="product_price">
                                                            KShs.<?php echo htmlentities($product['product_price']); ?>
                                                        </div>
                                                        <div class="product_name">
                                                            <div>
                                                                <a href="#">
                                                                    <?php echo htmlentities($product['product_name']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product_extras">
                                                            <button class="product_cart_button">Add to Cart</button>
                                                        </div>
                                                    </div>
                                                    <div class="product_fav">
                                                        <i class="fa fa-heart"></i></div>
                                                    <ul class="product_marks">
                                                        <li class="product_mark product_new">
                                                            <?php echo htmlentities($product['product_status']); ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <!-- Slider Item -->
                                        <div class="arrivals_slider_item">
                                            <div class="border_active"></div>
                                            <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                    <img src="<?php echo public_url(); ?>storage/products/noimage.png" alt="">
                                                </div>
                                                <div class="product_content">
                                                    <div class="product_price"></div>
                                                    <div class="product_name">
                                                        <div><a href="<?php echo base_url(); ?>">Welcome To TadTech Africa</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="arrivals_slider_dots_cover"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Best Sellers -->
<div class="best_sellers">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">Hot Best Sellers</div>
                        <ul class="clearfix">
                            <li class="active">Top 20</li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>

                    <div class="bestsellers_panel panel active">

                        <!-- Best Sellers Slider -->
                        <div class="bestsellers_slider slider">
                            <?php if (count($all_products) > 0) { ?>
                                <!-- Best Sellers Item -->
                                <div class="bestsellers_item discount">
                                    <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                        <div class="bestsellers_image">
                                            <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                                        </div>
                                        <div class="bestsellers_content">
                                            <div class="bestsellers_category">
                                                <a href="#">
                                                    <?php echo htmlentities($product['category_name']); ?>
                                                </a>
                                            </div>
                                            <div class="bestsellers_name">
                                                <a href="#" class="productDetails" id="<?php echo md5($product['id']); ?>">
                                                    <?php echo htmlentities($product['product_name']); ?>
                                                </a>
                                            </div>
                                            <div class="rating_r rating_r_4 bestsellers_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                            <div class="bestsellers_price discount">KShs.<?php echo htmlentities($product['product_price']); ?></div>
                                        </div>
                                    </div>
                                    <div class="bestsellers_fav active"><i class="fa fa-heart"></i></div>
                                    <ul class="bestsellers_marks">
                                        <li class="bestsellers_mark bestsellers_new">
                                            <?php echo htmlentities($product['product_status']); ?>
                                        </li>
                                    </ul>
                                </div>
                            <?php } else { ?>
                                <!-- Best Sellers Item -->
                                <div class="bestsellers_item discount">
                                    <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                        <div class="bestsellers_image">
                                            <img src="<?php echo public_url(); ?>storage/products/noimage.png" alt="">
                                        </div>
                                        <div class="bestsellers_content">
                                            <div class="bestsellers_category">
                                                <a href="#">No Categories</a>
                                            </div>
                                            <div class="bestsellers_name">
                                                <a href="<?php echo base_url(); ?>">
                                                    Welcome TadTech
                                                </a>
                                            </div>
                                            <div class="rating_r rating_r_4 bestsellers_rating">
                                                <i></i><i></i><i></i><i></i><i></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>