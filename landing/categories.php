<?php require_once('../init/initialization.php');

$url = base_url()."index.php";

if(!isset($_GET['category'])){
    redirect_to($url);
}

$classifications = new Product_Classification();

$promotions = new Product_Promotion();

$products = new Products();

require_once('../public/layouts/landing/header.php'); 

$category_id = htmlentities($_GET['category']);

$current_category = $categories->find_category_by_id($category_id);

if(!$current_category){
    redirect_to($url);
}
?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Products</h4>
        <div class="site-pagination">
            <a href="<?php echo base_url(); ?>index.php">Home</a> /
            <a href="<?php echo base_url(); ?>landing/classifications.php?classification=<?php echo htmlentities($current_classification['id']); ?>">Shop</a> /
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- Category section -->
<section class="category-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="filter-widget">
                    <h2 class="fw-title">Categories</h2>
                    <ul class="category-menu">
                        <?php
                        $sys_categories = $categories->find_all();
                        if (count($sys_categories) > 0) {
                            foreach ($sys_categories as $sys_category) { ?>
                                <li>
                                    <a href="#" id="categoryProductsBtn">
                                        <?php echo htmlentities($sys_category['category_name']); ?>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>


            </div>

            <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row">

                    <?php $sys_products = $products->find_products_by_category_id($current_category['id']); ?>
                    <?php if (count($sys_products) > 0) {
                        foreach ($sys_products as $product) { ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <div class="tag-sale">
                                            <?php echo htmlentities($product['product_status']); ?>
                                        </div>
                                        <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($product['product_image']); ?>" alt="">
                                        <div class="pi-links">
                                            <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="pi-text">
                                        <h6>KSHS.<?php  echo htmlentities($product['product_price']); ?></h6>
                                        <p>
                                            <?php echo htmlentities($product['product_name']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Category section end -->

<?php require_once('../public/layouts/landing/footer.php');  ?>