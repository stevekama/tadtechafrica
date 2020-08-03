<?php
require_once('../../init/initialization.php');
$back_url = base_url()."vendors/products/index.php";
if(!isset($_GET['product'])){
    redirect_to($back_url);
}
$product_id = htmlentities($_GET['product']);
$products = new Products;
$current_product = $products->find_product_by_id($product_id);
if(!$current_product){
    redirect_to($back_url);
}
$page = "categories";
$title = "Vendors || Products";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'vendors' . DS . 'header.php');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>vendors/index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>vendors/products/index.php">Products</a>
                    </li>
                    <li class="breadcrumb-item active">view product</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">
                        <?php echo htmlentities($current_product['product_name']); ?>
                    </h3>
                    <div class="col-12">
                        <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($current_product['product_image']); ?>" class="product-image" alt="Product Image">
                    </div>
                    <div class="col-12 product-image-thumbs">
                        <div class="product-image-thumb active">
                            <img src="<?php echo public_url(); ?>storage/products/<?php echo htmlentities($current_product['product_image']); ?>" alt="Product Image">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">
                        <?php echo htmlentities($current_product['product_name']); ?>
                    </h3>
                    <p><?php echo htmlentities($current_product['product_details']); ?></p>
                    <hr>
                    <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                            KSHS.<?php echo htmlentities($current_product['product_price']); ?>
                        </h2>
                    </div>

                    <div class="mt-4">
                        <button id="<?php echo htmlentities($current_product['id']); ?>"  class="btn btn-primary btn-lg btn-flat edit">
                            <i class="fa fa-cart-plus fa-lg mr-2"></i>
                            Edit
                        </button>

                        <button id="<?php echo htmlentities($current_product['id']); ?>" class="btn btn-danger btn-lg btn-flat pull-right delete">
                            <i class="fa fa-trash fa-lg mr-2"></i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">
                            Description
                        </a>
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                        <?php echo htmlentities($current_product['product_description']); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="modal fade" id="editProductModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editProductForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <span id="alertProductMessage"></span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="product_id" class="form-control" id="editProductId"/>
                        </div>
                        <div class="form-group">
                            <label for="editProductCategoryId">Category</label>
                            <?php 
                            $categories = new Categories(); 
                            $all_categories = $categories->find_all();
                            ?>
                            <select name="category_id" id="editProductCategoryId" class="form-control">
                                <option value="" disabled selected>Choose Category</option>
                                <?php if(count($all_categories) > 0){ 
                                    foreach($all_categories as $category){ ?>
                                        <option value="<?php echo htmlentities($category['id']) ?>">
                                            <?php echo htmlentities($category['category_name']) ?>
                                        </option>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <option value="">No Categories</option>    
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editProductName">Product Name:</label>
                            <input type="text" class="form-control" id="editProductName" name="product_name" placeholder="Enter Product name">
                        </div>

                        <div class="form-group">
                            <label for="editProductDetails">Product Details:</label>
                            <textarea name="details" id="editProductDetails" class="form-control" placeholder="Enter Product Details"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="editProductDescription">Product Description:</label>
                            <textarea name="description" id="editProductDescription" class="form-control" placeholder="Enter Product Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="editProductPrice">Product Price:</label>
                            <input type="text" class="form-control" id="editProductPrice" name="price" placeholder="Enter Product price">
                        </div>

                        <div class="form-group">
                            <label for="editProductUnits">Product Units:</label>
                            <input type="text" class="form-control" id="editProductUnits" name="units" placeholder="Enter Product price">
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="editProductSubmitBtn" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>
<!-- /.content -->

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'vendors' . DS . 'footer.php'); ?>

<script>
    $(document).ready(function(){

        // delete product
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            if(confirm("Are you sure.?")){
                var action = "DELETE_PRODUCT";
                var product_id = $(this).attr("id");
                $.ajax({
                    url:"<?php echo base_url(); ?>api/products/products.php",
                    type:"POST",
                    data:{action:action, product_id:product_id},
                    dataType:"json",
                    success:function(data){
                        if(data.message == "success"){
                            toastr.success('Successfully removed product.');
                            window.location.href = "<?php echo base_url(); ?>vendors/products/index.php";
                        }
                    }
                });
            }else{
                return false;
            }
        });

        // edit product 
        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var action = "FETCH_PRODUCT";
            var product_id = $(this).attr("id");
            $.ajax({
                url:"<?php echo base_url(); ?>api/products/products.php",
                type:"POST",
                data:{action:action, product_id:product_id},
                dataType:"json",
                success:function(data){
                    $('#editProductId').val(data.id);
                    $('#editProductName').val(data.product_name);
                    $('#editProductDetails').val(data.product_details);
                    $('#editProductDescription').val(data.product_description);
                    $('#editProductPrice').val(data.product_price);
                    $('#editProductUnits').val(data.product_units);
                    $('#editProductModal').modal('show');
                }
            });
        });

        // submit 
        $('#editProductForm').submit(function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url:"<?php echo base_url(); ?>api/products/new_product.php",
                type:"POST",
                data:form_data,
                dataType:"json",
                beforeSend:function(){
                    $('#editProductSubmitBtn').html('Loading...');
                },
                success:function(data){
                    if(data.message == "success"){
                        $('#editProductSubmitBtn').html('Success');
                        $('#editProductForm')[0].reset();
                        $('#editProductModal').modal('hide');
                        window.location.reload();
                    }

                    if(data.message == "emptyCategory"){
                        $('#alertProductMessage').html('<div class="alert alert-danger">Please select a category and try again</div>');
                        return false;
                    }
                }
            });

        });


    });
</script>