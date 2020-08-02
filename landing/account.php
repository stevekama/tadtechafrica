<?php
require_once('../init/initialization.php');
$title = "TadTechAfrica || Get upto date with the lattest tech";
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
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Sign in to start your session</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="loginForm" role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <span id="alertMessage"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="loginEmail">Email address</label>
                                        <input type="email" id="loginEmail" name="email" class="form-control" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="loginPassword">Password</label>
                                        <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Enter Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" id="loginSubmitBtn" class="btn btn-primary">
                                        Login
                                    </button>

                                    <a href="#" class="btn btn-link pull-right">
                                        Forgot Password
                                    </a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- ./col-md-6 -->

                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Register a new membership
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="registerForm" role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                       <span id="registerAlertMessage"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="registerFullNames">Full Names</label>
                                        <input type="text" name="fullnames" class="form-control" id="registerFullNames" placeholder="Enter Full Names">
                                    </div>
                                    <div class="form-group">
                                        <label for="registerEmail">Email address</label>
                                        <input type="email" name="email" class="form-control" id="registerEmail" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="registerPhone">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" id="registerPhone" placeholder="Enter phone number">
                                    </div>
                                    <div class="form-group">
                                        <label for="registerPassword">Password</label>
                                        <input type="password" name="password" class="form-control" id="registerPassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="registerConfirm">Retype Password</label>
                                        <input type="password" name="confirm" class="form-control" id="registerConfirm" placeholder="Retype Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" id="registerSubmitBtn" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
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
        /// login and registration
        $(document).on('submit', '#loginForm', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>api/customers/login.php",
                type: "POST",
                data: form_data,
                dataType: "json",
                beforeSend: function() {
                    $('#loginSubmitBtn').html('Loading...');
                },
                success: function(data) {
                    if (data.message == "errorCustomer") {
                        $('#alertMessage').html('<div class="alert alert-danger">There is an error in your email and password. Please check</div>');
                        $('#loginSubmitBtn').html('error');
                        return false;
                    }
                    if (data.message == "success") {
                        $('#alertMessage').html('<div class="alert alert-success">You have successfully logged in.</div>');
                        $('#loginSubmitBtn').html('success');
                        window.location.href = "<?php echo base_url(); ?>customers/index.php";
                    }
                }
            });
        });

        // registration
        $(document).on('submit', '#registerForm', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>api/customers/new_customers.php",
                type: "POST",
                data: form_data,
                dataType: "json",
                beforeSend: function() {
                    $('#registerSubmitBtn').html('Loading...');
                },
                success: function(data) {
                    if (data.message == "errorCustomer") {
                        $('#registerAlertMessage').html('<div class="alert alert-danger">There is an error in your email and password. Please check</div>');
                        $('#registerSubmitBtn').html('error');
                        return false;
                    }


                    if (data.message == "errorPassword") {
                        $('#registerAlertMessage').html('<div class="alert alert-danger">Password Do not match. Please check and try again..</div>');
                        $('#registerSubmitBtn').html('Error Password');
                        return false;
                    }

                    if (data.message == "emailExists") {
                        $('#registerAlertMessage').html('<div class="alert alert-danger">The email entered is used by another account. Please check and try again..</div>');
                        $('#registerSubmitBtn').html('Email Error');
                        return false;
                    }


                    if (data.message == "success") {
                        $('#alertMessage').html('<div class="alert alert-success">Successfully created account. Loggin to your account to continue...</div>');
                        $('#registerForm')[0].reset();
                        $('#registerSubmitBtn').html('success');
                    }
                }
            });
        });

    });
</script>