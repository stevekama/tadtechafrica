<?php
require_once('../init/initialization.php');
$title = "TadTechAfrica || Get upto date with the lattest tech";
$page = "cart";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
?>

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>
                    <div id="loadCartItems" class="cart_items">
                    </div>
                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">KSHS.<span id="cartTotal"></span></div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="<?php echo base_url(); ?>index.php" class="button cart_button_clear">
                            Continue Shopping
                        </a>
                        <button type="button" id="proceedToCheckoutBtn" class="button cart_button_checkout">
                            Proceed To Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>

<script>
    $(document).on('click', '#proceedToCheckoutBtn', function(){
        $.ajax({
            url:"<?php echo base_url(); ?>api/customer_orders/new_order.php",
            type:"POST",
            dataType:"json",
            success:function(data){
                if(data.message == "success"){
                    var order_id = $.trim(data.order_id);
                    localStorage.setItem('order_id', order_id);
                    window.location.href = "<?php echo base_url(); ?>customers/order.php?order="+order_id;
                }
            }
        }); 
    });
</script>