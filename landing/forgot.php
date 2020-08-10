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
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Forgot Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="forgotPasswordForm" role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <span id="alertMessage"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="forgotEmail">Email address</label>
                                        <input type="email" id="forgotEmail" name="email" class="form-control" placeholder="Enter email">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" id="forgotSubmitBtn" class="btn btn-primary">
                                        Submit
                                    </button>

                                    <a href="<?php echo base_url(); ?>landing/account.php" class="btn btn-link pull-right">
                                        Login Now
                                    </a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- ./col-md-12 -->
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>

<script>
    $(document).ready(function(){
        $('#forgotPasswordForm').submit(function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>api/customers/forgot.php",
                type: "POST",
                data: form_data,
                dataType: "json",
                beforeSend: function() {
                    $('#forgotSubmitBtn').html('Loading...');
                },
                success: function(data) {
                    if (data.message == "errorCustomer") {
                        toastr.error('Email entered doesnot exist. Please check and try again...');
                        $('#forgotSubmitBtn').html('error');
                        return false;
                    }
                    if (data.message == "success") {
                        toastr.success('Please check your email to continue..');
                        $('#forgotSubmitBtn').html('success');
                        $('#forgotPasswordForm')[0].reset();
                    }
                }
            });
        });
    });
</script>