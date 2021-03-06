<?php
require_once('../init/initialization.php');
$title = "TadTechAfrica || Get upto date with the lattest tech";
$page = "contact";
$classifications = new Product_Classification();
$products = new Products();
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Contact</h4>
        <div class="site-pagination">
            <a href="<?php echo base_url(); ?>index.php">Home</a> /
            <a href="<?php echo base_url(); ?>landing/contact.php">Contact</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- Contact section -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 contact-info">
                <h3>Get in touch</h3>
                <p>Imenti House, Nairobi Kenya</p>
                <p>+254 793033110</p>
                <p>info@tadtechafrica.com</p>
                <div class="contact-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </div>
                <form class="contact-form">
                    <input type="text" placeholder="Your name">
                    <input type="text" placeholder="Your e-mail">
                    <input type="text" placeholder="Subject">
                    <textarea placeholder="Message"></textarea>
                    <button class="site-btn">SEND NOW</button>
                </form>
            </div>
        </div>
    </div>
    <div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14376.077865872314!2d-73.879277264103!3d40.757667781624285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1546528920522" style="border:0" allowfullscreen></iframe></div>
</section>
<!-- Contact section end -->

<!-- Related product section -->
<section class="related-product-section spad">
    <div class="container">
        <div class="section-title">
            <h2>New Arrivals</h2>
        </div>
        <div class="row">
            <?php
            $classification = "New Arrivals";
            $current_classification = $classifications->find_by_classification($classification);
            $sys_products = $products->find_products_by_classification_id($current_classification['id']);
            if (count($sys_products) > 0) {
                foreach ($sys_products as $product) { ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                <div class="tag-new">
                                    <?php echo htmlentities($product['product_status']); ?>
                                </div>
                                <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                                <div class="pi-links">
                                    <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                    <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                </div>
                            </div>
                            <div class="pi-text">
                                <h6>KSHS<?php echo htmlentities($product['product_price']); ?></h6>
                                <p><?php echo htmlentities($product['product_name']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Related product section end -->

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>