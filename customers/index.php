<?php
require_once('../init/initialization.php');
$url = base_url() . 'index.php';
if (!$session->is_logged_in()) {
    redirect_to($url);
}

if (!$session->check_user()) {
    $session->logout();
    redirect_to($url);
}

if ($session->user_type != "CUSTOMER") {
    $session->logout();
    redirect_to($url);
}

$customers = new Customers();
$customer_id = htmlentities($session->user_id);
$current_customer = $customers->find_customer_by_id($customer_id);
if (!$current_customer) {
    $session->logout();
    redirect_to($url);
}
$title = "TadTechAfrica || Customer Profile";
$page = "contact";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
?>
<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Account</h4>
        <div class="site-pagination">
            <a href="<?php echo base_url(); ?>index.php">Home</a> /
            <a href="<?php echo base_url(); ?>customers/index.php">Customer Account</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- Contact section -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 contact-info">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-body customer_img border border-primary">
                        <img src="<?php echo public_url(); ?>storage/customers/<?php echo htmlentities($current_customer['customer_image']); ?>" class="rounded-circle img-thumbnail" alt="Customer Profile" />
                    </div>
                    <!-- /.card-body -->
                </div>
                <br>
                <!-- /.card -->

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="#" id="customerAccountBtn">
                            My Account
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" id="customerWishlistBtn">
                            My Wishlist
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" id="customerOrdersBtn">
                            My Orders
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" id="customerSettingsBtn">
                            Settings
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" id="customerChangePasswordBtn">
                            Change Password
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="logout">
                            Logout
                        </a>
                    </li>
                </ul>
                <br>
            </div>

            <div class="col-lg-9 contact-info">
                <!-- general form elements -->
                <div id="customer_account" class="card card-primary">
                    <!-- form start -->
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <h4>ACCOUNT DETAILS</h4>
                                    <br>
                                    <p>Your default account details:</p>
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Full Names:</th>
                                                <td><?php echo htmlentities($current_customer['customer_fullnames']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Phone Number:</th>
                                                <td><?php echo htmlentities($current_customer['customer_phone']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email Address:</th>
                                                <td><?php echo htmlentities($current_customer['customer_email']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <h4>ADDRESS BOOK</h4>
                                    <br>
                                    <p>Your default shipping address:</p>
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Full Names:</th>
                                                <td><?php echo htmlentities($current_customer['customer_fullnames']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Phone Number:</th>
                                                <td><?php echo htmlentities($current_customer['customer_phone']); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email Address:</th>
                                                <td><?php echo htmlentities($current_customer['customer_email']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->

                <!-- general form elements -->
                <div id="myWishlistAccount" class="card card-primary">
                    <!-- /.card-header -->
                    <div id="loadWishlistItems" class="card-body table-responsive"></div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- general form elements -->
                <div id="customer_settings" class="card card-primary">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home">General Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu1">Change Profile</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active" id="home">
                                <br>
                                <form id="updateCustomerForm">
                                    <div class="form-group">
                                        <span id="alertCustomerUpdateMessage"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="customer_id" class="form-control" id="updateCustomerId" value="<?php echo htmlentities($current_customer['id']); ?>" placeholder="Enter Full Names">
                                    </div>
                                    <div class="form-group">
                                        <label for="updateCustomerFullNames">Full Names</label>
                                        <input type="text" name="fullnames" class="form-control" id="updateCustomerFullNames" value="<?php echo htmlentities($current_customer['customer_fullnames']); ?>" placeholder="Enter Full Names">
                                    </div>
                                    <div class="form-group">
                                        <label for="registerEmail">Email address</label>
                                        <input type="email" name="email" class="form-control" id="updateCustomerEmail" value="<?php echo htmlentities($current_customer['customer_email']); ?>" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="registerPhone">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="<?php echo htmlentities($current_customer['customer_phone']); ?>" id="updateCustomerPhone" placeholder="Enter phone number">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="updateCustomerSubmintBtn" class="btn btn-success">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane container fade" id="menu1">
                                <br>
                                <form id="updateCustomerImageForm">
                                    <div class="form-group">
                                        <span id="alertCustomerImageMessage"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="customer_id" class="form-control" id="updateCustomerImageId" value="<?php echo htmlentities($current_customer['id']); ?>" placeholder="Enter Full Names">
                                    </div>
                                    <div class="form-group">
                                        <label for="customerImage">Profile</label>
                                        <input type="file" id="customerImage" name="image">
                                        <p class="help-block">Update profile here.</p>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="updateCustomerImageSubmintBtn" class="btn btn-success">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- general form elements -->
                <div id="customer_password_settings" class="card card-primary">
                    <!-- form start -->
                    <form id="customerPasswordForm" role="form">
                        <div class="card-body">
                            <div class="form-group">
                                <span id="customerPasswordAlertMessage"></span>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="customer_id" class="form-control" id="customerPasswordCustomerId" value="<?php echo htmlentities($current_customer['id']); ?>" />
                            </div>
                            <div class="form-group">
                                <label for="customerPassword">Password</label>
                                <input type="password" name="password" class="form-control" id="customerPassword" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="customerNewPassword">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="customerNewPassword" placeholder="New Password" />
                            </div>
                            <div class="form-group">
                                <label for="customerConfirmPassword">Retype Password</label>
                                <input type="password" name="confirm" class="form-control" id="customerConfirmPassword" placeholder="Retype Password" />
                            </div>
                            <div class="form-group">
                                <button type="submit" id="customerPasswordSubmitBtn" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
</section>
<!-- Contact section end -->


<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>

<script>
    $(document).ready(function() {
        // hide all customer components
        $('#myWishlistAccount').fadeOut(800).hide();
        $('#customer_settings').fadeOut(800).hide();
        $('#customer_password_settings').fadeOut(800).hide();
        // display customer account info 
        $('#customer_account').fadeIn(900).show();

        // click customer account
        $('#customerAccountBtn').on('click', function(event) {
            event.preventDefault();
            // hide all customer components
            $('#myWishlistAccount').fadeOut(800).hide();
            $('#customer_settings').fadeOut(800).hide();
            $('#customer_password_settings').fadeOut(800).hide();
            // display customer account info 
            $('#customer_account').fadeIn(900).show();

        });

        // wushlist customer account
        $('#customerWishlistBtn').on('click', function(event) {
            event.preventDefault();
            /// load items
            $.ajax({
                url: "<?php echo base_url(); ?>api/wishlist/wishlist.php",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    $('#loadWishlistItems').html(data.wishlist_table);
                    // hide all customer components
                    $('#customer_account').fadeOut(800).hide();
                    $('#customer_settings').fadeOut(800).hide();
                    $('#customer_password_settings').fadeOut(800).hide();
                    // display customer account info 
                    $('#myWishlistAccount').fadeIn(900).show();
                }
            });

        });

        // click customer settings
        $('#customerSettingsBtn').on('click', function(e) {
            e.preventDefault();
            // hide all customer components
            $('#myWishlistAccount').fadeOut(800).hide();
            $('#customer_account').fadeOut(800).hide();
            $('#customer_password_settings').fadeOut(800).hide();
            // display customer account info 
            $('#customer_settings').fadeIn(900).show();
        });

        // update customer info
        $('#updateCustomerForm').submit(function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>api/customers/update_customer.php",
                type: "POST",
                data: form_data,
                dataType: "json",
                beforeSend: function() {
                    $('#updateCustomerSubmintBtn').html('Loading...');
                },
                success: function(data) {
                    if (data.message == "success") {
                        $('#alertCustomerUpdateMessage').html('<div class="alert alert-success">Successfully updated your account</div>');
                        $('#updateCustomerSubmintBtn').html('Success');
                        window.location.reload();
                    }

                    if (data.message == "errorCustomer") {
                        $('#alertCustomerUpdateMessage').html('<div class="alert alert-danger">Customer could not be found</div>');
                        $('#updateCustomerSubmintBtn').html('Error');
                        return false;
                    }
                }
            });
        });

        // update profile image
        $('#updateCustomerImageForm').submit(function(event) {
            event.preventDefault();
            var user_profile = $('#customerImage').val();
            if (user_profile == '') {
                $('#alertCustomerImageMessage').html('<div class="alert alert-danger alert-dismissible">Please Select a profile pic</div>');
                return false;
            } else {
                var extension = user_profile.split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    $('#customerImage').val('');
                    $('#alertCustomerImageMessage').html('<div class="alert alert-danger alert-dismissible">The file selected is invalid. Please check and try again</div>');
                    return false;
                } else {
                    $.ajax({
                        url: "<?php echo base_url(); ?>api/customers/update_profile.php",
                        type: "POST",
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        beforeSend: function() {
                            $("#updateCustomerImageSubmintBtn").html('Uploading..');
                        },
                        success: function(data) {
                            if (data.message == 'success') {
                                $('#alertCustomerImageMessage').html('<div class="alert alert-success alert-dismissible">Profile successfully updated</div>');
                                $("#updateCustomerImageSubmintBtn").html('Success');
                                window.location.reload();
                            }

                            if (data.message == "errorCustomer") {
                                $('#alertCustomerImageMessage').html('<div class="alert alert-danger alert-dismissible">Customer was not found..</div>');
                                $("#updateCustomerImageSubmintBtn").html('Error');
                                return false;
                            }
                        }
                    });
                }
            }

        });

        // click change password 
        $('#customerChangePasswordBtn').on('click', function(e) {
            e.preventDefault();
            // hide all customer components
            $('#myWishlistAccount').fadeOut(800).hide();
            $('#customer_account').fadeOut(800).hide();
            $('#customer_settings').fadeOut(800).hide();
            // display customer account info 
            $('#customer_password_settings').fadeIn(900).show();
        });

        // change password
        $('#customerPasswordForm').submit(function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>api/customers/update_password.php",
                type: "POST",
                data: form_data,
                dataType: "json",
                beforeSend: function() {
                    $('#customerPasswordSubmitBtn').html('Updating...');
                },
                success: function(data) {
                    if (data.message == "success") {
                        $('#customerPasswordAlertMessage').html('<div class="alert alert-success">Successfully updated your account password</div>');
                        $('#customerPasswordSubmitBtn').html('Success');
                        window.location.reload();
                    }

                    if (data.message == "errorCustomer") {
                        $('#customerPasswordAlertMessage').html('<div class="alert alert-danger">Customer could not be found</div>');
                        $('#customerPasswordSubmitBtn').html('Error');
                        return false;
                    }

                    if (data.message == "wrongPassword") {
                        $('#customerPasswordAlertMessage').html('<div class="alert alert-danger">Wrong password entered. Please check and try again.</div>');
                        $('#customerPasswordSubmitBtn').html('Password Error');
                        logout();
                        return false;
                    }

                    if (data.message == "errorPasswordMatch") {
                        $('#customerPasswordAlertMessage').html('<div class="alert alert-danger">Password entered do not match. Please check and try again...</div>');
                        $('#customerPasswordSubmitBtn').html('Mismatching password');
                        return false;
                    }
                }
            });
        });

        // logout function 
        function logout() {
            var action = "LOGOUT";
            $.ajax({
                url: "<?php echo base_url(); ?>api/customers/customers.php",
                type: "POST",
                data: {
                    action: action
                },
                dataType: "json",
                success: function(data) {
                    if (data.message == "success") {
                        window.location.href = "<?php echo base_url(); ?>index.php";
                    }
                }
            })
        }

        // click logout
        $(document).on('click', '.logout', function(event) {
            event.preventDefault();
            logout();
        });

    });
</script>