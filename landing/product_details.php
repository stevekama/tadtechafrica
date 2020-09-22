<?php
require_once('../init/initialization.php');
$back_url = base_url();
if (!isset($_GET['product'])) {
    redirect_to(base_url());
}

$product_id = htmlentities($_GET['product']);

$products = new Products();

$current_product = $products->find_product_by_id($product_id);

if (!$current_product) {
    redirect_to(base_url());
}

$classification = new Product_Classification();

$classification_name = htmlentities('New Arrivals');

$current_classification = $classification->find_by_classification($classification_name);

if (!$current_classification) {
    redirect_to(base_url());
}

$title = "TadTechAfrica || Get upto date with the lattest tech";
$page = "product";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
?>
<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4><?php echo htmlentities($current_product['product_name']); ?></h4>
        <div class="site-pagination">
            <a href="<?php echo base_url(); ?>index.php">Home</a> /
            <a href="<?php echo base_url(); ?>landing/products.php">Shop More</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- product section -->
<section class="product-section">
    <div class="container">
        <div class="back-link">
            <a href="<?php echo base_url(); ?>landing/products.php"> &lt;&lt; Back to Products</a>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="product-pic-zoom">
                    <img class="product-big-img" src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($current_product['product_image']); ?>" alt="">
                </div>
                <div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
                    <div class="product-thumbs-track">
                        <div class="pt active" data-imgbigurl="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($current_product['product_image']); ?>">
                            <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($current_product['product_image']); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 product-details">
                <h2 class="p-title">
                    <?php echo htmlentities($current_product['product_name']); ?>
                </h2>
                <h3 class="p-price">KSHS<?php echo htmlentities($current_product['product_price']) ?></h3>
                <!-- <h4 class="p-stock">Available: <span>In Stock</span></h4> -->
                <div class="p-rating">
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o fa-fade"></i>
                </div>
                <div class="p-review">
                    <a href="">3 reviews</a>|<a href="">Add your review</a>
                </div>
                <!-- <div class="fw-size-choose">
                    <p>Size</p>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="xs-size">
                        <label for="xs-size">32</label>
                    </div>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="s-size">
                        <label for="s-size">34</label>
                    </div>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="m-size" checked="">
                        <label for="m-size">36</label>
                    </div>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="l-size">
                        <label for="l-size">38</label>
                    </div>
                    <div class="sc-item disable">
                        <input type="radio" name="sc" id="xl-size" disabled>
                        <label for="xl-size">40</label>
                    </div>
                    <div class="sc-item">
                        <input type="radio" name="sc" id="xxl-size">
                        <label for="xxl-size">42</label>
                    </div>
                </div> -->
                <div class="quantity">
                    <p>Quantity</p>
                    <div class="pro-qty">
                        <input type="text" id="productQuantity" value="1">
                    </div>
                </div>
                <a href="#" id="<?php echo htmlentities($current_product['id']); ?>" class="site-btn addProductToCart">ADD TO CART</a>
                <div id="accordion" class="accordion-area">
                    <div class="panel">
                        <div class="panel-header" id="headingOne">
                            <button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
                        </div>
                        <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="panel-body">
                                <p><?php echo htmlentities($current_product['product_description']); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="panel">
                        <div class="panel-header" id="headingTwo">
                            <button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
                        </div>
                        <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="panel-body">
                                <img src="./img/cards.png" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="panel">
                        <div class="panel-header" id="headingThree">
                            <button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
                        </div>
                        <div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="panel-body">
                                <h4>7 Days Returns</h4>
                                <p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="social-sharing">
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-pinterest"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->

<!-- RELATED PRODUCTS section -->
<section class="related-product-section">
    <div class="container">
        <div class="section-title">
            <h2>RELATED PRODUCTS</h2>
        </div>
        <div class="product-slider owl-carousel">
            <?php $sys_products = $products->find_products_by_classification_id($current_classification['id']);
            if (count($sys_products) > 0) {
                foreach ($sys_products as $product) { ?>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                            <div class="pi-links">
                                <a href="#" id="<?php echo  htmlentities($product['id']); ?>" class="add-card viewProductBtn">
                                    <i class="flaticon-bag"></i><span>VIEW PRODUCT</span>
                                </a>
                                <a href="#" id="<?php echo  htmlentities($product['id']); ?>" class="wishlist-btn">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>KSHS<?php echo htmlentities($product['product_price']); ?></h6>
                            <p><?php echo htmlentities($product['product_name']); ?> </p>
                        </div>
                    </div>
                <?php } ?>
            <?php }
            ?>

        </div>
    </div>
</section>
<!-- RELATED PRODUCTS section end -->

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>
<script>
    $(document).ready(function() {

        $(document).on('click', '.addProductToCart', function(event) {
            var product_id = $(this).attr("id");
            var quantity = $('#productQuantity').val();
            $.ajax({
                url: "<?php echo base_url(); ?>api/cart/new_cart_item.php",
                type: "POST",
                data: {
                    product_id: product_id, 
                    quantity:quantity
                },
                dataType: "json",
                success: function(data) {
                    if (data.message == "success") {
                        toastr.success('Product has been successfully added to cart');
                        window.location.href = "<?php echo base_url(); ?>landing/cart.php";
                    }

                    if(data.message == "productAdded"){
                        toastr.error('Product selected already added in cart');
                        return false; 
                    }
                }
            });
        });
    });
</script>