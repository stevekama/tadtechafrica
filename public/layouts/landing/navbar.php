<nav class="main-navbar">
    <div class="container">
        <!-- menu -->
        <ul class="main-menu">
            <li>
                <a href="<?php echo base_url(); ?>">
                    Home
                </a>
            </li>

            <li>
                <a href="#">
                    All Categories
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="sub-menu">
                    <?php $all_categories = $categories->find_all(); ?>
                    <?php if (count($all_categories) > 0) {
                        foreach ($all_categories as $category) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>landing/categories.php?category=<?php echo htmlentities($category['id']); ?>">
                                    <?php echo htmlentities($category['category_name']); ?>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo base_url(); ?>">
                                No Categories
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>landing/products.php">
                    Featured Products
                </a>
            </li>

            <?php $product_classifications = $classification->find_all();
            if (count($product_classifications) > 0) {
                foreach ($product_classifications as $p_classification) { ?>
                    <li>
                        <a href="<?php echo base_url(); ?>landing/classifications.php?classification=<?php echo htmlentities($p_classification['id']); ?>">
                            <?php echo htmlentities($p_classification['classification']); ?>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>

            <li>
                <a href="<?php echo base_url(); ?>landing/contact.php">
                    Contact
                </a>
            </li>
        </ul>
    </div>
</nav>