<?php
require_once('../init/initialization.php');

$products = new Products();

$classifications = new Product_Classification();

require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Register / Login</h4>
        <div class="site-pagination">
            <a href="<?php echo base_url(); ?>index.php">Home</a> /
            <a href="<?php echo base_url(); ?>customers/login.php">Register / Login</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- Contact section -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 contact-info">
                <h3>Login to your account</h3>
                <form id="loginForm" class="contact-form">
                    <input type="text" name="email" placeholder="Your e-mail">
                    <input type="password" name="password" placeholder="Your Password">
                    <button id="loginSubmitBtn" class="site-btn">LOGIN</button>
                </form>
                <br>
            </div>
            <div class="col-lg-6 contact-info">
                <h3>Create your account</h3>
                <form id="registrationForm" class="contact-form">
                    <input type="text" name="fullnames" placeholder="Your fullnames">
                    <input type="text" name="email" placeholder="Your e-mail">
                    <input type="text" name="phone" placeholder="Your phone">
                    <input type="password" name="password" placeholder="Your Password">
                    <input type="password" name="confirm" placeholder="Retype Password">
                    <button id="registrationSubmitBtn" class="site-btn">REGISTER</button>
                </form>
                <br>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

        </div>
    </div>
</section>
<!-- Contact section end -->

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>

<script>
    $(document).ready(function() {
        $('#registrationForm').submit(function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>api/customers/new_customers.php",
                type: "POST",
                data: form_data,
                dataType: "json",
                beforeSend: function() {
                    $('#registrationSubmitBtn').html('Loading...');
                },
                success: function(data) {
                    if (data.message == "success") {
                        $('#registrationSubmitBtn').html('Success');
                        toastr.success('Successfully created an account. You can login and continue..');
                        $('#registrationForm')[0].reset();
                    }
                }
            });
        });

        $('#loginForm').submit(function(event) {
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
                    if (data.message == "success") {
                        toastr.success('Successfully logged in to your account');
                        $('#loginSubmitBtn').html('success');
                        $('#registrationForm')[0].reset();
                        window.location.href = "<?php echo base_url(); ?>customers/index.php";
                    }
                }
            });
        });
    });
</script>