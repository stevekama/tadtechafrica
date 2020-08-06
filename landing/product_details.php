<?php
require_once('../init/initialization.php');
$title = "TadTechAfrica || Get upto date with the lattest tech";
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
$page = "product";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');

// find all products 
$related_products = $products->find_products_by_category_id($current_product['category_id']);
?>

<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Images -->
            <div class="col-lg-2 order-lg-1 order-2">
                <ul class="image_list">
                    <li data-image="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($current_product['product_image']); ?>">
                        <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($current_product['product_image']); ?>" alt="">
                    </li>
                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-5 order-lg-2 order-1">
                <div class="image_selected">
                    <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($current_product['product_image']); ?>" alt="">
                </div>
            </div>

            <!-- Description -->
            <div class="col-lg-5 order-3">
                <div class="product_description">
                    <?php
                    $categories = new Categories();
                    $current_category = $categories->find_category_by_id($current_product['category_id']);
                    ?>
                    <div class="product_category">
                        <?php echo htmlentities($current_category['category_name']); ?>
                    </div>
                    <div class="product_name">
                        <?php echo htmlentities($current_product['product_name']); ?>
                    </div>
                    <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                    <div class="product_text">
                        <p>
                            <?php echo htmlentities($current_product['product_description']); ?>
                        </p>
                    </div>
                    <div class="order_info d-flex flex-row">
                        <form id="addToCartForm">
                            <div class="clearfix" style="z-index: 1000;">
                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix">
                                    <span>Quantity: </span>
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="product_price">
                                KSHS.<?php echo htmlentities($current_product['product_price']); ?>
                            </div>
                            <div class="button_container">
                                <button type="submit" class="button cart_button">Add to Cart</button>
                                <div id="<?php echo htmlentities($current_product['id']) ?>" class="product_fav productAddToWhishlist">
                                    <i class="fa fa-heart"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Related Products</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fa fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fa fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">

                    <!-- Recently Viewed Slider -->
                    <div class="owl-carousel owl-theme viewed_slider">
                        <?php if (count($related_products) > 0) { ?>
                            <?php foreach ($related_products as $product) { ?>
                                <!-- Recently Viewed Item -->
                                <div id="<?php echo htmlentities($product['id']); ?>" class="owl-item productDetailsBtn">
                                    <div class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image">
                                            <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                                        </div>
                                        <div class="viewed_content text-center">
                                            <div class="viewed_price">
                                                KSHS.<?php echo htmlentities($product['product_price']); ?>
                                            </div>
                                            <div class="viewed_name">
                                                <a href="#">
                                                    <?php echo htmlentities($product['product_name']); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <ul class="item_marks">
                                            <li class="item_mark item_new">
                                                <?php echo htmlentities($product['product_status']); ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="images/view_3.jpg" alt=""></div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$225</div>
                                        <div class="viewed_name"><a href="#">Samsung J730F...</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>
<script>
    $(document).ready(function(){
        $('#addToCartForm').submit(function(event){
            event.preventDefault();
            var product_id = $.trim(localStorage.getItem('product_id'));
            var quantity = $('#quantity_input').val();
            
            if(quantity == 0){
                toastr.error('Please add quantity of product you need');
                return false;
            }

            var dataToSend = "product_id="+product_id+"&quantity="+quantity;
            $.ajax({
                url:"<?php echo base_url(); ?>api/cart/new_cart_item.php",
                type:"POST",
                data:dataToSend,
                dataType:"json",
                success:function(data){
                    if(data.message == "success"){
                        toastr.success('Product has been successfully added to cart.');
                        window.location.reload();
                    }
                    if(data.message == "productAdded"){
                        toastr.error('Product already added in cart');
                        return false;
                    }
                }
            });
        });
    });
</script>