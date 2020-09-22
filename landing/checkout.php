<?php
require_once('../init/initialization.php');

$title = "TadTechAfrica || Get upto date with the lattest tech";

$page = "contact";

$url = base_url()."index.php";

if(!isset($_GET['order'])){
    redirect_to($url);
}

$order_id = htmlentities($_GET['order']);

$order = new Customer_Orders();

$current_order = $order->find_order_by_id($order_id);

if(!$current_order){
    redirect_to($url);
}

$classifications = new Product_Classification();

$products = new Products();

require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Your checkout</h4>
        <div class="site-pagination">
            <a href="">Home</a> /
            <a href="">Checkout</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- checkout section  -->
<section class="checkout-section spad">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-7 order-2 order-lg-1">
                <form class="checkout-form">
                    <div class="cf-title">Billing Address</div>
                    <div class="row">
                        <div class="col-md-7">
                            <p>*Billing Information</p>
                        </div>
                        <div class="col-md-5">
                            <div class="cf-radio-btns address-rb">
                                <div class="cfr-item">
                                    <input type="radio" name="pm" id="one">
                                    <label for="one">Use my regular address</label>
                                </div>
                                <div class="cfr-item">
                                    <input type="radio" name="pm" id="two">
                                    <label for="two">Use a different address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row address-inputs">
                        <div class="col-md-12">
                            <input type="text" placeholder="Address">
                            <input type="text" placeholder="Address line 2">
                            <input type="text" placeholder="Country">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Zip code">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Phone no.">
                        </div>
                    </div>
                    <div class="cf-title">Delievery Info</div>
                    <div class="row shipping-btns">
                        <div class="col-6">
                            <h4>Standard</h4>
                        </div>
                        <div class="col-6">
                            <div class="cf-radio-btns">
                                <div class="cfr-item">
                                    <input type="radio" name="shipping" id="ship-1">
                                    <label for="ship-1">Free</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4>Next day delievery </h4>
                        </div>
                        <div class="col-6">
                            <div class="cf-radio-btns">
                                <div class="cfr-item">
                                    <input type="radio" name="shipping" id="ship-2">
                                    <label for="ship-2">$3.45</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cf-title">Payment</div>
                    <ul class="payment-list">
                        <li>Paypal<a href="#"><img src="img/paypal.png" alt=""></a></li>
                        <li>Credit / Debit card<a href="#"><img src="img/mastercart.png" alt=""></a></li>
                        <li>Pay when you get the package</li>
                    </ul>
                    <button class="site-btn submit-order-btn">Place Order</button>
                </form>
            </div>

            <div class="col-lg-5 order-1 order-lg-2">
                <div class="checkout-cart">
                    <h3>Your Cart</h3>
                    <div id="load-cart">
                    </div>
                    <ul class="price-list">
                        <li>Total<span id="totalCartPrice"></span></li>
                        <li>Shipping<span>free</span></li>
                        <li class="total">Total<span>$99.90</span></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- checkout section end -->

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>

<script>
$(document).ready(function(){
    const order_id = localStorage.getItem("order_id");
    function find_customer_order(){
        $.ajax({
            url:"<?php echo base_url(); ?>api/customer_orders/customer_order.php",
            type:"POST",
            data:{order_id:order_id},
            dataType:"json",
            success:function(data){
                $('#load-cart').html(data.cart_items);
                $('#totalCartPrice').html(data.total_price);
            }
        });
    }

    find_customer_order();
});
</script>