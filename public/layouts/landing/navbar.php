<!-- Main Navigation -->
<nav class="main_nav">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="main_nav_content d-flex flex-row">
                    <!-- Categories Menu -->
                    <div class="cat_menu_container">
                        <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                            <div class="cat_burger">
                                <span></span><span></span><span></span>
                            </div>
                            <div class="cat_menu_text">categories</div>
                        </div>

                        <ul class="cat_menu">
                            <?php if(count($product_categories) > 0){ ?>
                                <?php foreach($product_categories as $category){ ?>
                                    <li>
                                        <a href="#!" id="<?php echo md5($category['id']); ?>" class="productsCategories"> 
                                            <?php echo htmlentities($category['category_name']); ?>
                                            <i class="fa fa-chevron-right ml-auto"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php }else{ ?> 
                                <li>
                                    <a href="<?php echo base_url(); ?>">
                                        No Categories
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <!-- Main Nav Menu -->
                    <div class="main_nav_menu ml-auto">
                        <ul class="standard_dropdown main_nav_dropdown">
                            <li>
                                <a href="<?php echo base_url(); ?>">
                                    TadTech<i class="fa fa-chevron-down"></i>
                                </a>
                            </li>
                            <li class="hassubs">
                                <a href="#">Super Deals<i class="fa fa-chevron-down"></i></a>
                                <ul>
                                    <li>
                                        <a href="<?php echo base_url(); ?>landing/shop.php">
                                            Shop More<i class="fa fa-chevron-down"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="hassubs">
                                <a href="#">Help<i class="fa fa-chevron-down"></i></a>
                                <ul>
                                    <li>
                                        <a href="<?php echo base_url(); ?>landing/contact.php">
                                            Contact us<i class="fa fa-chevron-down"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!-- Menu Trigger -->
                    <div class="menu_trigger_container ml-auto">
                        <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                            <div class="menu_burger">
                                <div class="menu_trigger_text">menu</div>
                                <div class="cat_burger menu_burger_inner">
                                    <span></span><span></span><span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Menu -->
<div class="page_menu">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="page_menu_content">

                    <div class="page_menu_search">
                        <form action="#">
                            <input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
                        </form>
                    </div>
                    <ul class="page_menu_nav"> 
                        <li class="page_menu_item">
                            <a href="<?php echo base_url(); ?>">
                                TadTech<i class="fa fa-angle-down"></i>
                            </a>
                        </li>
                        <li class="page_menu_item has-children">
                            <a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection">
                                <li><a href="<?php echo base_url(); ?>landing/shop.php">Shop More<i class="fa fa-angle-down"></i></a></li>
                            </ul>
                        </li>
                       
                        <li class="page_menu_item has-children">
                            <a href="#">Help<i class="fa fa-angle-down"></i></a>
                            <ul class="page_menu_selection">
                                <li>
                                    <a href="<?php echo base_url(); ?>landing/contact.php">
                                        Contact us<i class="fa fa-angle-down"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="menu_contact">
                        <div class="menu_contact_item">
                            <div class="menu_contact_icon">
                                <img src="<?php echo public_url(); ?>front/images/phone_white.png" alt="">
                            </div>+38 068 005 3570
                        </div>
                        <div class="menu_contact_item">
                            <div class="menu_contact_icon">
                                <img src="<?php echo public_url(); ?>front/images/mail_white.png" alt="">
                            </div>
                            <a href="mailto:fastsales@gmail.com">
                                fastsales@gmail.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>