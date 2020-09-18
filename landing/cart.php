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
        <h4>Your cart</h4>
        <div class="site-pagination">
            <a href="<?php echo base_url(); ?>index.php">Home</a> /
            <a href="<?php echo base_url(); ?>landing/cart.php">Your cart</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- cart section end -->
<section class="cart-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table">
                    <h3>Your Cart</h3>
                    <div id="loadCartItems" class="table-responsive"></div>
                    <div class="total-cost">
                        <h6>Total <span id="loadTotalCart"></span></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 card-right">
                <!-- <form class="promo-code-form">
                    <input type="text" placeholder="Enter promo code">
                    <button>Submit</button>
                </form> -->
                <a href="#!" id="proceedToPaymentsBtn" class="site-btn">Proceed to checkout</a>
                <a href="<?php echo base_url(); ?>index.php" class="site-btn sb-dark">Continue shopping</a>
            </div>
        </div>
    </div>
</section>
<!-- cart section end -->

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

<script>
    $(document).ready(function(){
       $(document).on('click', '#proceedToPaymentsBtn', function(e){
           e.preventDefault();
           $.ajax({
               url:"<?php echo base_url(); ?>api/customer_orders/new_order.php",
               type:"POST",
               dataType:"json",
               success:function(data){
                   if(data.message == "success"){
                       window.location.href = "<?php echo base_url(); ?>landing/checkout.php";
                   }

                   if(data.message == "userNotLoggedIn"){
                       window.location.href = "<?php echo base_url(); ?>customers/login.php";
                   }
               }
           });
       });
    });
</script>