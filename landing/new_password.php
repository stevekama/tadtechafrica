<?php
require_once('../init/initialization.php');
$error_url = base_url();
if (!isset($_GET['customer'])) {
    redirect_to($error_url);
}

$customer_id = htmlentities($_GET['customer']);

$customers = new Customers();

$current_customer = $customers->find_customer_by_id($customer_id);

if (!$current_customer) {
    redirect_to($error_url);
}

$title = "TadTechAfrica || New Password";

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
                            <form id="newPasswordForm" role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <span id="alertMessage"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="newPasswordCustomerId" name="customer_id" class="form-control" value="<?php echo htmlentities($current_customer['id']); ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">New Password</label>
                                        <input type="password" id="newPassword" name="new_password" class="form-control" placeholder="Enter New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="newConfirmPassword">Retype Password</label>
                                        <input type="password" id="newConfirmPassword" name="confirm_password" class="form-control" placeholder="Re-type password">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" id="newPasswordSubmitBtn" class="btn btn-primary">
                                        Submit
                                    </button>
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
    $(document).ready(function() {
        $('#newPasswordForm').submit(function(event) {
            event.preventDefault();
            var password = $('#newPassword').val();
            var confirm = $('#newConfirmPassword').val();
            if (password === confirm) {
                var form_data = $(this).serialize();
                $.ajax({
                    url: "<?php echo base_url(); ?>api/customers/new_password.php",
                    type: "POST",
                    data: form_data,
                    dataType: "json",
                    beforeSend: function() {
                        $('#newPasswordSubmitBtn').html('Loading...');
                    },
                    success: function(data) {
                        if (data.message == "errorPassword") {
                            toastr.error('Password entered do not match. Please check and try again...');
                            $('#newPasswordSubmitBtn').html('error');
                            $('#newPasswordForm')[0].reset();
                            return false;
                        }
                        if (data.message == "success") {
                            toastr.success('Please check your email to continue..');
                            $('#newPasswordForm')[0].reset();
                            $('#forgotSubmitBtn').html('success');
                            window.location.href = "<?php echo base_url(); ?>landing/account.php";
                        }
                    }
                });
            }else{
                toastr.error('Password entered do not match. Please check and try again...');
                return false;
            }
        });
    });
</script>