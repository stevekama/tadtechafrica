<?php
require_once('../init/initialization.php');
$title = "TadTechAfrica || Get upto date with the lattest tech";
$page = "shop";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
$products = new Products();
// find all products 
$all_products = $products->find_all();
?>

<!-- Home -->
<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php echo public_url(); ?>front/images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Shop more today</h2>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            <?php if (count($product_categories) > 0) {
                                foreach ($product_categories as $category) { ?>
                                    <li>
                                        <a href="#" id="<?php echo md5($category['id']); ?>" class="productsCategories">
                                            <?php echo htmlentities($category['category_name']); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <li><a href="<?php echo base_url(); ?>">No Categories</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-lg-9">

                <!-- Shop Content -->

                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span><?php echo htmlentities(count($all_products)); ?></span> products found</div>
                    </div>

                    <div class="product_grid">
                        <div class="product_grid_border"></div>
                        <?php if (count($all_products) > 0) {
                            foreach ($all_products as $product) { ?>
                                <!-- Product Item -->
                                <div id="<?php echo htmlentities($product['id']);  ?>" class="product_item is_new productDetailsBtn">
                                    <div class="product_border"></div>
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                                    </div>
                                    <div class="product_content">
                                        <div class="product_price">
                                            KShs.<?php echo htmlentities($product['product_price']); ?>
                                        </div>
                                        <div class="product_name">
                                            <div>
                                                <a href="#" id="<?php echo htmlentities($product['id']); ?>" tabindex="0" class="productDetails">
                                                    <?php echo htmlentities($product['product_name']); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="<?php echo htmlentities($product['id']); ?>" class="product_fav productAddToWhishlist">
                                        <i class="fa fa-heart"></i>
                                    </div>
                                    <ul class="product_marks">
                                        <li class="product_mark product_new">
                                            <?php echo htmlentities($product['product_status']) ?>
                                        </li>
                                    </ul>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <!-- Product Item -->
                            <div class="product_item discount">
                                <div class="product_border"></div>
                                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                    <img src="<?php echo public_url(); ?>storage/products/noimage.png" alt="">
                                </div>
                                <div class="product_content">
                                    <div class="product_name">
                                        <div>
                                            <a href="<?php echo base_url(); ?>" tabindex="0">
                                                Welcome To TadTech
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Shop Page Navigation -->
                    <?php if (count($all_products) > 0) { ?>
                        <div class="shop_page_nav d-flex flex-row">
                            <div class="page_prev d-flex flex-column align-items-center justify-content-center">
                                <i class="fa fa-chevron-left"></i>
                            </div>
                            <ul class="page_nav d-flex flex-row">
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">21</a></li>
                            </ul>
                            <div class="page_next d-flex flex-column align-items-center justify-content-center">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>