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
?>

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div id="customerOrderItemsSection" class="cart_container">
                    <div class="cart_title">Order Items</div>
                    <div class="cart_items">
                        <ul id="loadOrderItems" class="cart_list">
                        </ul>
                    </div>
                    <div class="cart_buttons">
                        <button id="customerOrderItemsNextBtn" type="button" class="button cart_button_checkout">
                            Next
                        </button>
                    </div>
                </div>

                <div id="customerDeliveryModeSection" class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Delivery Mode
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>How do you want to be delivered?</p>
                                <hr>
                                <?php
                                $delivery_mode = new Delivery_Mode();
                                $modes = $delivery_mode->find_all();
                                $count_mode = count($modes);
                                ?>
                                <div class="form-group">
                                    <?php if ($count_mode > 0) {
                                        foreach ($modes as $mode) { ?>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="delivery_mode_id" class="customerDeliveryModeId" id="<?php echo htmlentities($mode['id']); ?>" value="<?php echo htmlentities($mode['id']); ?>">
                                                    <strong><?php echo htmlentities($mode['delivery_mode']); ?></strong>
                                                    <p><?php echo htmlentities($mode['mode_description']); ?></p>
                                                    <p>
                                                        Delivery Amount: <?php echo htmlentities($mode['delivery_amount']); ?>
                                                    </p>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- .col-md-12 -->

                            <div class="col-md-8">
                                &nbsp;
                            </div>
                            <div class="col-md-4">
                                <button type="button" id="customerDeliveryModeSubmitBtn" class="button cart_button_checkout">
                                    Continue..
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="customerTadLocationSection" class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <p>Our Location..</p>
                                <hr>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>
                                                Location
                                            </th>
                                            <td>
                                                Nairobi, Moi Avenue <br>
                                                Imenti house, 1st floor <br>
                                                Shop number B1.
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Phone Number
                                            </th>
                                            <td>
                                                (254)793033110, <br>
                                                (254)723322247
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Email Address
                                            </th>
                                            <td>
                                                info@tadtechafrica.com
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <br>
                                <div class="form-group">
                                    <input type="hidden" name="delivery_mode_id" class="form-control" id="tadLocationDeliveryModeId" placeholder="Delivery Mode Id">
                                </div>
                            </div>

                            <div class="col-md-7">
                                &nbsp;
                            </div>
                            <div class="col-md-5">
                                <button type="button" id="customerTadLocationSubmitBtn" class="button cart_button_checkout">
                                    Proceed To Payments
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="customerDeliveryLocationSection" class="card">
                    <div class="card-body">
                        <div class="row">
                            <form autocomplete="off" method="post" id="deliveryLocationForm">
                            <div class="col-md-12 table-responsive">
                                <p>Delivery Location</p>
                                <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" name="order_id" class="form-control" id="deliveryLocationOrderId" placeholder="Delivery Mode Id">
                                                <input type="hidden" name="delivery_mode_id" class="form-control" id="deliveryLocationDeliveryModeId" placeholder="Delivery Mode Id">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="deliveryLocationFullNames">Full Names</label>
                                                <input type="text" name="fullnames" class="form-control" id="deliveryLocationFullNames" placeholder="FullNames">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="deliveryLocationPhone">Phone Number</label>
                                                <input type="text" name="phone" class="form-control" id="deliveryLocationPhone" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="deliveryLocationAltPhone">Alterntive Phone</label>
                                                <input type="text" name="alt_phone" class="form-control" id="deliveryLocationAltPhone" placeholder="Alternative Phone">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="deliveryLocationEmail">Email Address</label>
                                                <input type="email" name="email" class="form-control" id="deliveryLocationEmail" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="deliveryLocationAddress">Delivery Address</label>
                                                <textarea name="address" id="deliveryLocationAddress" class="form-control" placeholder="Street Name | Building | Apartment No. | Floor"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="deliveryLocationCity">City</label>
                                                <input type="text" name="city" class="form-control" id="deliveryLocationCity" placeholder="Enter City">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="deliveryLocationCountry">Country</label>
                                                <select name="country" id="deliveryLocationCountry" class="form-control">
                                                    <option disabled selected>Choose Country</option>
                                                    <option value="Kenya">Kenya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                            </div>

                            <div class="col-md-7">
                                &nbsp;
                            </div>
                            <div class="col-md-5">
                                <button type="submit" id="deliveryLocationSubmitBtn" class="button cart_button_checkout">
                                    Proceed To Payments
                                </button>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div id="customerPaymentInfoSection" class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Payments info
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Make your payments</p>
                                <hr>
                                <?php
                                $delivery_mode = new Delivery_Mode();
                                $modes = $delivery_mode->find_all();
                                $count_mode = count($modes);
                                ?>
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="payments" id="cod" value="CASH_ON_DELIVERY">
                                            <strong>Cash On Delivery</strong>
                                            <p>Pay with cash upon delivery.</p>
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="payments" id="cod" value="LIPA_NA_MPESA">
                                            <strong>M-PESA</strong>
                                            <p>Pay directly with mpesa.</p>
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="payments" id="cod" value="PayBill">
                                            <strong>M-PESA PAYBILL</strong>
                                            <p>Pay with mpesa paybill.</p>
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="payments" id="cod" value="paypal">
                                            <strong>PAYPAL</strong>
                                            <p>Pay through paypal.</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- .col-md-12 -->

                            <div class="col-md-8">
                                &nbsp;
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="button cart_button_checkout">
                                    Confirm order
                                </button>
                            </div>
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
                                        KSHS <span id="orderTotalAmount"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DELIVERY</td>
                                    <td>
                                        KSHS <span id="orderTotalDelivery"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3>TOTAL</h3>
                                    </td>
                                    <td>
                                        KSHS <span id="orderTotalGrand"></span>

                                    </td>
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

<script>
    $(document).ready(function() {
        // hide all sections 
        $('#customerOrderItemsSection').fadeIn(800).show();
        $('#customerDeliveryModeSection').fadeOut(900).hide();
        $('#customerTadLocationSection').fadeOut(900).hide();
        $('#customerDeliveryLocationSection').fadeOut(900).hide();
        $('#customerPaymentInfoSection').fadeOut(900).hide();

        const order_id = localStorage.getItem('order_id');

        function find_order() {
            var action = "FETCH_ORDER_BY_ID";
            $.ajax({
                url: "<?php echo base_url(); ?>api/customer_orders/order.php",
                type: "POST",
                data: {
                    action: action,
                    order_id: order_id
                },
                dataType: "json",
                success: function(data) {
                    if (data.message == "errorOrder") {
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    } else {
                        find_customer_order_details(data.id);
                        $('#orderTotalAmount').html(data.order_price);
                        $('#orderTotalDelivery').html(data.order_delivery);
                        $('#orderTotalGrand').html(data.order_total);
                    }
                }
            });
        }
        find_order();

        function find_customer_order_details(order_id) {
            $.ajax({
                url: "<?php echo base_url(); ?>api/customer_orders/customer_order.php",
                type: "POST",
                data: {
                    order_id: order_id
                },
                dataType: "json",
                success: function(data) {
                    if (data.message == "errorCustomer") {
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    } else if (data.message == "errorOrder") {
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    } else if (data.order_items == "noItems") {
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    } else {
                        $('#loadOrderItems').html(data.order_items);
                    }
                }
            });
        }

        /**
         * first cnfirm the orer items and update order status to delivery 
         * customer chooses delivery mode
         * if mode is PICKUP SHow customer our location 
         * if customer customer click on proceed to payments upate delivery table. 
         * Take the customer to payments form 
         * if customer clicks on delivery update payments on order table
         */

        //1. confirm order items
        $(document).on('click', '#customerOrderItemsNextBtn', function(event) {
            event.preventDefault();
            var status = "DELIVERY";
            $.ajax({
                url: "<?php echo base_url(); ?>api/customer_orders/update_status.php",
                type: "POST",
                data: {
                    status: status,
                    order_id: order_id
                },
                dataType: "json",
                beforeSend: function() {
                    $('#customerOrderItemsNextBtn').html('Loading...');
                },
                success: function(data) {
                    if (data.message == "errorOrder") {
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    }

                    if (data.message == "success") {
                        find_order();
                        $('#customerOrderItemsSection').fadeOut(900).hide();
                        $('#customerDeliveryModeSection').fadeIn(800).show();
                        $('#customerTadLocationSection').fadeOut(900).hide();
                        $('#customerDeliveryLocationSection').fadeOut(900).hide();
                        $('#customerPaymentInfoSection').fadeOut(900).hide();
                    }
                }
            });

        });

        function find_customer(){
            var action = "FETCH_CUSTOMER";
            $.ajax({
                url: "<?php echo base_url(); ?>api/customers/customers.php",
                type: "POST",
                data: {
                    action: action
                },
                dataType: "json",
                success: function(data) {
                    if (data.message == "errorCustomer") {
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    } else {
                        $('#deliveryLocationFullNames').val(data.customer.customer_fullnames);
                        $('#deliveryLocationEmail').val(data.customer.customer_email);
                        $('#deliveryLocationPhone').val(data.customer.customer_phone);
                    }
                }
            });
        }

        // 2. find delivery mode by id 
        $(document).on('click', '#customerDeliveryModeSubmitBtn', function() {
            var action = "FETCH_MODE";
            var delivery_mode_id = $("input[name='delivery_mode_id']:checked").val();
            if (delivery_mode_id) {
                $.ajax({
                    url: "<?php echo base_url(); ?>api/delivery/delivery_mode.php",
                    type: "POST",
                    data: {
                        action: action,
                        delivery_mode_id: delivery_mode_id
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('#customerDeliveryModeSubmitBtn').html('Loading...');
                    },
                    success: function(data) {
                        if (data.message == "errorMode") {
                            window.location.href = "<?php echo base_url(); ?>index.php";
                            return false;
                        } else {
                            if (data.delivery_mode == "PICK UP") {
                                $('#tadLocationDeliveryModeId').val(data.id);
                                $('#customerOrderItemsSection').fadeOut(900).hide();
                                $('#customerDeliveryModeSection').fadeOut(900).hide();
                                $('#customerTadLocationSection').fadeIn(800).show();
                                $('#customerDeliveryLocationSection').fadeOut(900).hide();
                                $('#customerPaymentInfoSection').fadeOut(900).hide();
                            } else{
                                $('#deliveryLocationDeliveryModeId').val(data.id)
                                $('#deliveryLocationOrderId').val(order_id);
                                find_customer();
                                $('#customerOrderItemsSection').fadeOut(900).hide();
                                $('#customerDeliveryModeSection').fadeOut(900).hide();
                                $('#customerTadLocationSection').fadeOut(900).hide();
                                $('#customerDeliveryLocationSection').fadeIn(800).show();
                                $('#customerPaymentInfoSection').fadeOut(900).hide();
                            }
                        }
                    }
                });
            }
        });

        // if customer select pick up
        $(document).on('click', '#customerTadLocationSubmitBtn', function (event) {
            event.preventDefault();
            var delivery_mode_id = $('#tadLocationDeliveryModeId').val();
            var alt_phone = "(254)793033110";
            var address = "NAIROBI, IMENTI HOUSE, 1ST FLOOR SHOP NUMBER B1";
            var city = "Nairobi";
            var country = "Kenya";
            var dataToSend = "order_id="+order_id+"&delivery_mode_id="+delivery_mode_id+"&alt_phone="+alt_phone+"&address="+address+"&city="+city+"&country="+country;
            $.ajax({
                url:"<?php echo  base_url(); ?>api/delivery/new_order_delivery.php",
                type:"POST",
                data:dataToSend,
                dataType:"json",
                beforeSend:function () {
                    $('#customerTadLocationSubmitBtn').html("Loading...");
                },
                success:function (data) {
                    if(data.message == "success"){
                        find_order();
                        $('#customerOrderItemsSection').fadeOut(900).hide();
                        $('#customerDeliveryModeSection').fadeOut(900).hide();
                        $('#customerTadLocationSection').fadeOut(900).hide();
                        $('#customerDeliveryLocationSection').fadeOut(900).hide();
                        $('#customerPaymentInfoSection').fadeIn(800).show();
                        $('#tadLocationDeliveryModeId').val('')

                    }

                    if(data.message == "errorCustomer"){
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    }

                    if(data.message == "errorDeliveryMode"){
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    }

                    if(data.message == "errorOrder"){
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    }

                }
            });
        });

        // submit form
        $(document).on('submit', '#deliveryLocationForm', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url:"<?php echo  base_url(); ?>api/delivery/new_order_delivery.php",
                type:"POST",
                data:form_data,
                dataType:"json",
                beforeSend:function () {
                    $('#deliveryLocationSubmitBtn').html("Loading...");
                },
                success:function (data) {

                    if(data.message == "success"){
                        $('#deliveryLocationSubmitBtn').html("Success");
                        find_order();
                        $('#customerOrderItemsSection').fadeOut(900).hide();
                        $('#customerDeliveryModeSection').fadeOut(900).hide();
                        $('#customerTadLocationSection').fadeOut(900).hide();
                        $('#customerDeliveryLocationSection').fadeOut(900).hide();
                        $('#customerPaymentInfoSection').fadeIn(800).show();
                        $('#tadLocationDeliveryModeId').val('');
                    }

                    if(data.message == "errorCustomer"){
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    }

                    if(data.message == "errorDeliveryMode"){
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    }

                    if(data.message == "errorOrder"){
                        window.location.href = "<?php echo base_url(); ?>index.php";
                        return false;
                    }

                }
            });

        });

    });
</script>