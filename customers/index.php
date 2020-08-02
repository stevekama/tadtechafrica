<?php
require_once('../init/initialization.php');
$title = "TadTechAfrica || Customer Profile";
$page = "contact";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
?>

<!-- Contact Info -->
<div class="contact_info">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image">
                            <img src="<?php echo public_url(); ?>front/images/contact_1.png" alt="">
                        </div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Phone</div>
                            <div class="contact_info_text">+38 068 005 3570</div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image">
                            <img src="<?php echo public_url(); ?>front/images/contact_2.png" alt="">
                        </div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Email</div>
                            <div class="contact_info_text">fastsales@gmail.com</div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image">
                            <img src="<?php echo public_url(); ?>front/images/contact_3.png" alt="">
                        </div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Address</div>
                            <div class="contact_info_text">10 Suffolk at Soho, London, UK</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Form -->
<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-md-4">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="customer_img">
                                    <img src="<?php echo public_url(); ?>storage/customers/<?php echo htmlentities($current_customer['customer_image']); ?>" class="rounded-circle" alt="Customer Profile" />
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <br>
                        <div class="card card-primary">
                            <div class="card-body">
                                <ul class="cat_menu">
                                    <li>
                                        <a href="#" id="customerAccountBtn">
                                            My Account <i class="fa fa-chevron-right ml-auto"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" id="customerSettingsBtn">
                                            Settings<i class="fa fa-chevron-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" id="customerChangePasswordBtn">
                                            Change Password<i class="fa fa-chevron-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="logout">
                                            Logout<i class="fa fa-chevron-right"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- ./col-md-6 -->

                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div id="customer_account" class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    My Account
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="customer_img">
                                            <img src="<?php echo public_url(); ?>storage/customers/<?php echo htmlentities($current_customer['customer_image']); ?>" class="rounded-circle" alt="Customer Profile" />
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="table-responsive">
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
                                        <input type="hidden" name="customer_id" class="form-control" id="customerPasswordCustomerId" value="<?php echo htmlentities($current_customer['id']); ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="customerPassword">Password</label>
                                        <input type="password" name="password" class="form-control" id="customerPassword" placeholder="Password"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="customerNewPassword">New Password</label>
                                        <input type="password" name="new_password" class="form-control" id="customerNewPassword" placeholder="New Password"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="customerConfirmPassword">Retype Password</label>
                                        <input type="password" name="confirm" class="form-control" id="customerConfirmPassword" placeholder="Retype Password"/>
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
                    <!-- ./col-md-6 -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>
<script>
    $(document).ready(function() {
        // hide all customer components
        $('#customer_settings').fadeOut(800).hide();
        $('#customer_password_settings').fadeOut(800).hide();
        // display customer account info 
        $('#customer_account').fadeIn(900).show();

        // click customer account
        $('#customerAccountBtn').on('click', function(event) {
            event.preventDefault();
            // hide all customer components
            $('#customer_settings').fadeOut(800).hide();
            $('#customer_password_settings').fadeOut(800).hide();
            // display customer account info 
            $('#customer_account').fadeIn(900).show();

        });

        // click customer settings
        $('#customerSettingsBtn').on('click', function(e) {
            e.preventDefault();
            // hide all customer components
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
        function logout(){
            var action = "LOGOUT";
            $.ajax({
                url:"<?php echo base_url(); ?>api/customers/customers.php",
                type:"POST",
                data:{action:action},
                dataType:"json",
                success:function(data){
                    if(data.message == "success"){
                        window.location.href = "<?php echo base_url(); ?>index.php";
                    }
                }
            })
        }

        // click logout
        $(document).on('click', '.logout', function(event){
            event.preventDefault();
            logout();
        });

    });
</script>