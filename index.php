<?php require_once('init/initialization.php');

$promotions = new Product_Promotion();

$products = new Products();

$classifications = new Product_Classification();

require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php'); ?>

<!-- Hero section -->
<section class="hero-section">

	<div class="hero-slider owl-carousel">
		<?php $product_promotions = $promotions->find_all(); ?>
		<?php if (count($product_promotions) > 0) {
			foreach ($product_promotions as $product_promotion) {
				$current_product = $products->find_product_by_id($product_promotion['product_id']); ?>
				<div class="hs-item set-bg" data-setbg="<?php echo public_url(); ?>storage/banner/<?php echo htmlentities($product_promotion['banner_image']); ?>">
					<div class="container">
						<div class="row">
							<div class="col-xl-6 col-lg-7 text-white">
								<?php $current_classification = $classifications->find_by_id($product_promotion['classification_id']); ?>
								<span><?php echo htmlentities($current_classification['classification']); ?></span>
								<h2><?php echo htmlentities($current_product['product_name']) ?></h2>
								<p><?php echo htmlentities($current_product['product_description']) ?></p>
								<p>KSHS.<?php echo htmlentities($current_product['product_price']) ?></p>
								<a href="<?php echo base_url(); ?>landing/products.php" class="site-btn sb-line">DISCOVER</a>
								<a href="#" id="<?php echo htmlentities($current_product['id']) ?>" class="site-btn sb-white addProductToCart">ADD TO CART</a>
							</div>
						</div>
						<!-- <div class="offer-card text-white">
							<span>from</span>
							<h2>KSHS.<?php echo htmlentities($current_product['product_price']); ?></h2>
							<p>SHOP NOW</p>
						</div> -->
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
	<div class="container">
		<div class="slide-num-holder" id="snh-1"></div>
	</div>
</section>
<!-- Hero section end -->

<!-- Features section -->
<section class="features-section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 p-0 feature">
				<div class="feature-inner">
					<div class="feature-icon">
						<img src="<?php echo public_url(); ?>front/images/icons/1.png" alt="#">
					</div>
					<h2>Fast Secure Payments</h2>
				</div>
			</div>
			<div class="col-md-4 p-0 feature">
				<div class="feature-inner">
					<div class="feature-icon">
						<img src="<?php echo public_url(); ?>front/images/icons/2.png" alt="#">
					</div>
					<h2>Premium Products</h2>
				</div>
			</div>
			<div class="col-md-4 p-0 feature">
				<div class="feature-inner">
					<div class="feature-icon">
						<img src="<?php echo public_url(); ?>front/images/icons/3.png" alt="#">
					</div>
					<h2>Fast Delivery</h2>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Features section end -->

<!-- letest product section -->
<section class="top-letest-product-section">
	<div class="container">
		<div class="section-title">
			<h2>NEW ARRIVALS</h2>
		</div>
		<div id="newArrivalProducts" class="product-slider owl-carousel">
			<?php
			$classification = "New Arrivals";
			$current_classification = $classifications->find_by_classification($classification);
			$new_arrivals_products = $products->find_products_by_classification_id($current_classification['id']);
			if (count($new_arrivals_products) > 0) {
				foreach ($new_arrivals_products as $product) { ?>
					<div class="product-item">
						<div class="pi-pic">
							<img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
							<div class="pi-links">
								<a href="#" id="<?php echo htmlentities($product['id']); ?>" class="add-card addProductToCart"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>KSHS.<?php echo htmlentities($product['product_price']); ?></h6>
							<p><?php echo htmlentities($product['product_name']); ?> </p>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</section>
<!-- letest product section end -->

<!-- Product filter section -->
<section class="product-filter-section">
	<div class="container">
		<div class="section-title">
			<h2>BROWSE FEATURED PRODUCTS</h2>
		</div>
		<?php
		$product_categories = $categories->find_all();
		?>
		<ul class="product-filter-menu">
			<?php if (count($product_categories) > 0) {
				foreach ($product_categories as $category) { ?>
					<li>
						<a href="<?php echo base_url(); ?>landing/categories.php?category=<?php echo htmlentities($category['id']); ?>">
							<?php echo htmlentities($category['category_name']); ?>
						</a>
					</li>
				<?php } ?>
			<?php } ?>
		</ul>

		<div class="row">
			<?php
			// find all products 
			$all_products = $products->find_all();
			if (count($all_products) > 0) {
				foreach ($all_products as $product) { ?>
					<div class="col-lg-3 col-sm-6">
						<div class="product-item">
							<div class="pi-pic">
								<img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
								<div class="pi-links">
									<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
									<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
								</div>
							</div>
							<div class="pi-text">
								<h6>KSHS.<?php echo htmlentities($product['product_price']); ?></h6>
								<p><?php echo htmlentities($product['product_name']); ?> </p>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
		<div class="text-center pt-5">
			<a href="<?php echo base_url(); ?>landing/products.php" class="site-btn sb-line sb-dark">LOAD MORE</a>
		</div>
	</div>
</section>
<!-- Product filter section end -->

<!-- Banner section -->
<!-- <section class="banner-section">
	<div class="container">
		<div class="banner set-bg" data-setbg="<?php echo public_url(); ?>front/images/banner-bg.jpg">
			<div class="tag-new">NEW</div>
			<span>New Arrivals</span>
			<h2>STRIPED SHIRTS</h2>
			<a href="#" class="site-btn">SHOP NOW</a>
		</div>
	</div>
</section> -->
<!-- Banner section end  -->

<?php require_once('public/layouts/landing/footer.php'); ?>

<script>
	$(document).ready(function() {
		localStorage.clear();

		function find_all_products() {
			var action = "FETCH_ALL_PRODUCTS";
			$.ajax({
				url: "<?php echo base_url(); ?>api/front/fetch_products.php",
				type: "POST",
				data: {
					action: action
				},
				cache: false,
				success: function(data) {
					// console.table(data);
				}
			});
		}

		find_all_products();

	});
</script>