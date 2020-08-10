<?php
require_once('../init/initialization.php');
$back_url = base_url() . "index.php";
if (!$_GET['order']) {
    redirect_to($back_url);
}
$order = new Customer_Orders();
$order_id = htmlentities($_GET['order']);
$current_order = $order->find_order_by_id($order_id);
if (!$current_order) {
    redirect_to($back_url);
}
$title = "TadTechAfrica || Get upto date with the lattest tech";
$page = "cart";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
$cart = new Cart();
$customer_id = htmlentities($session->user_id);
$customer_order_id = htmlentities($current_order['id']);
$order_items = $cart->find_cart_items_by_customer_id_and_order_id($customer_id, $customer_order_id);
$products = new Products();
?>

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="cart_container">
                    <div class="cart_title">Order Items</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            <?php if (count($order_items) > 0) {
                                foreach ($order_items as $order_item) {
                                    $current_product = $products->find_product_by_id($order_item['product_id']); ?>
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image">
                                            <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($current_product['product_image']); ?>" alt="">
                                        </div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">
                                                    <?php echo htmlentities($current_product['product_name']); ?>
                                                </div>
                                            </div>

                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <div class="cart_item_text">
                                                    <?php echo htmlentities($order_item['quantity']); ?>
                                                </div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">
                                                    KSHS <?php echo htmlentities($order_item['item_price']); ?>
                                                </div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">
                                                    KSHS <?php echo htmlentities($order_item['total_price']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="cart_buttons">
                        <button type="button" class="button cart_button_checkout">
                            Next
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div>
                            <!-- .col-md-6 -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            </div>
                            <!-- .col-md-6 -->
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Order Total -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Your Order</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>SUBTOTAL</td>
                                    <td>
                                        KSHS <?php echo htmlentities($current_order['order_price']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DELIVERY</td>
                                    <td>
                                        KSHS <?php echo htmlentities($current_order['order_delivery']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>TOTAL</h3>
                                    </td>
                                    <td>KSHS <?php echo htmlentities($current_order['order_total']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>