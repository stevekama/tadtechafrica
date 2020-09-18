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
                <form class="contact-form">
                    <input type="text" placeholder="Your e-mail">
                    <input type="password" placeholder="Your Password">
                    <button class="site-btn">LOGIN</button>
                </form>
                <br>
            </div>
            <div class="col-lg-6 contact-info">
                <h3>Create your account</h3>
                <form class="contact-form">
                    <input type="text" placeholder="Your e-mail">
                    <input type="password" placeholder="Your Password">
                    <button class="site-btn">REGISTER</button>
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