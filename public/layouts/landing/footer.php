		<!-- Footer section -->
		<section class="footer-section">
			<div class="container">
				<div class="footer-logo text-center">
					<a href="<?php echo base_url(); ?>"><img src="<?php echo public_url(); ?>storage/logo/logo.png" alt=""></a>
				</div>
				<div class="row">
					<div class="col-lg-3 col-sm-6">
						<div class="footer-widget about-widget">
							<h2>About</h2>
							<p>Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam frin-gilla faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
							<img src="<?php echo public_url(); ?>front/images/cards.png" alt="">
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="footer-widget about-widget">
							<h2>Questions</h2>
							<ul>
								<li><a href="">About Us</a></li>
								<li><a href="">Track Orders</a></li>
								<li><a href="">Returns</a></li>
								<li><a href="">Jobs</a></li>
								<li><a href="">Shipping</a></li>
								<li><a href="">Blog</a></li>
							</ul>
							<ul>
								<li><a href="">Partners</a></li>
								<li><a href="">Bloggers</a></li>
								<li><a href="">Support</a></li>
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Press</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="footer-widget about-widget">
							<h2>Questions</h2>
							<div class="fw-latest-post-widget">
								<div class="lp-item">
									<div class="lp-thumb set-bg" data-setbg="<?php echo public_url(); ?>front/images/blog-thumbs/1.jpg"></div>
									<div class="lp-content">
										<h6>what shoes to wear</h6>
										<span>Oct 21, 2018</span>
										<a href="#" class="readmore">Read More</a>
									</div>
								</div>
								<div class="lp-item">
									<div class="lp-thumb set-bg" data-setbg="<?php echo public_url(); ?>front/images/blog-thumbs/2.jpg"></div>
									<div class="lp-content">
										<h6>trends this year</h6>
										<span>Oct 21, 2018</span>
										<a href="#" class="readmore">Read More</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="footer-widget contact-widget">
							<h2>Questions</h2>
							<div class="con-info">
								<span>C.</span>
								<p>Your Company Ltd </p>
							</div>
							<div class="con-info">
								<span>B.</span>
								<p>1481 Creekside Lane Avila Beach, CA 93424, P.O. BOX 68 </p>
							</div>
							<div class="con-info">
								<span>T.</span>
								<p>+53 345 7953 32453</p>
							</div>
							<div class="con-info">
								<span>E.</span>
								<p>office@youremail.com</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="social-links-warp">
				<div class="container">
					<div class="social-links">
						<a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
						<a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
						<a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
						<a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
					</div>

					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					<p class="text-white text-center mt-5">Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved </p>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</div>
			</div>
		</section>
		<!-- Footer section end -->
		<!--====== Javascripts & Jquery ======-->
		<script src="<?php echo public_url(); ?>front/js/jquery-3.2.1.min.js"></script>
		<script src="<?php echo public_url(); ?>front/js/bootstrap.min.js"></script>
		<!-- SweetAlert2 -->
		<script src="<?php echo public_url(); ?>back/plugins/sweetalert2/sweetalert2.min.js"></script>
		<!-- Toastr -->
		<script src="<?php echo public_url(); ?>back/plugins/toastr/toastr.min.js"></script>
		<script src="<?php echo public_url(); ?>front/js/jquery.slicknav.min.js"></script>
		<script src="<?php echo public_url(); ?>front/js/owl.carousel.min.js"></script>
		<script src="<?php echo public_url(); ?>front/js/jquery.nicescroll.min.js"></script>
		<script src="<?php echo public_url(); ?>front/js/jquery.zoom.min.js"></script>
		<script src="<?php echo public_url(); ?>front/js/jquery-ui.min.js"></script>
		<script src="<?php echo public_url(); ?>front/js/main.js"></script>
		<script>
			function find_cart_details() {
				var action = "FETCH_CART_ITEMS";
				$.ajax({
					url: "<?php echo base_url(); ?>api/cart/cart.php",
					type: "POST",
					data: {
						action: action
					},
					dataType: "json",
					success: function(data) {
						if (data.message == "noCartItems") {
							$('#numCartItems').html(0);
						} else {
							$('#numCartItems').html(data.total_items);
							$('#loadCartItems').html(data.cart_details);
							$('#loadTotalCart').html(data.total_price);
						}
					}
				});
			}

			$(document).ready(function() {
				find_cart_details();

				$(document).on('click', '.addProductToCart', function(e) {
					e.preventDefault();
					var product_id = $(this).attr("id");
					$.ajax({
						url: "<?php echo base_url(); ?>api/cart/new_cart_item.php",
						type: "POST",
						data: {
							product_id: product_id
						},
						dataType: "json",
						success: function(data) {
							if (data.message == "success") {
								find_cart_details();
								window.location.href = "<?php echo base_url(); ?>landing/cart.php";
							}
						}
					});

				})
			});
		</script>
		</body>

		</html>