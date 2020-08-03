<?php
require_once('../../init/initialization.php');
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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products Table</h3>
                        <div class="card-tools">
                            <a href="#" id="newProductBtn" class="btn btn-primary">
                                <i class="fa  fa-plus-square"></i> New Product
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="loadProducts" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Units</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <div class="modal fade" id="newProductModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="newProductForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <span id="alertProductMessage"></span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="product_id" class="form-control" id="newProductId"/>
                        </div>
                        <div class="form-group">
                            <label for="newProductCategoryId">Category</label>
                            <?php 
                            $categories = new Categories(); 
                            $all_categories = $categories->find_all();
                            ?>
                            <select name="category_id" id="newProductCategoryId" class="form-control">
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
                            <label for="newProductName">Product Name:</label>
                            <input type="text" class="form-control" id="newProductName" name="product_name" placeholder="Enter Product name">
                        </div>

                        <div class="form-group">
                            <label for="newProductImage">Product Image</label>
                            <input type="file" id="newProductImage" name="image" />
                            <p class="help-block">Please upload product image here.</p>
                        </div>

                        <div class="form-group">
                            <label for="newProductDetails">Product Details:</label>
                            <textarea name="details" id="newProductDetails" class="form-control" placeholder="Enter Product Details"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="newProductDescription">Product Description:</label>
                            <textarea name="description" id="newProductDescription" class="form-control" placeholder="Enter Product Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="newProductPrice">Product Price:</label>
                            <input type="text" class="form-control" id="newProductPrice" name="price" placeholder="Enter Product price">
                        </div>

                        <div class="form-group">
                            <label for="newProductUnits">Product Units:</label>
                            <input type="text" class="form-control" id="newProductUnits" name="units" placeholder="Enter Product price">
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="newProductSubmitBtn" class="btn btn-success">Save</button>
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
    $(document).ready(function() {
        function find_products() {
            var dataTable = $('#loadProducts').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url(); ?>api/products/fetch.php",
                    type: "POST",
                },
                "autoWidth": false
            });
        }
        find_products();

        $('#newProductBtn').click(function(event){
            event.preventDefault();
            $('#newProductModal').modal('show');
            $('#newProductForm')[0].reset();
        });

        $('#newProductForm').submit(function(event){
            event.preventDefault();
            var product_image = $('#newProductImage').val();
            if(product_image == ''){
                $('#alertProductMessage').html('<div class="alert alert-danger alert-dismissible">Please Select an image</div>');
                return false;
            }else{
                var extension = product_image.split('.').pop().toLowerCase();
                if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
                    $('#newProductImage').val('');
                    $('#alertProductMessage').html('<div class="alert alert-danger alert-dismissible">The file selected is invalid. Please check and try again</div>');
                    return false;
                }else{
                    $.ajax({
                        url:"<?php echo base_url(); ?>api/products/new_product.php",
                        type:"POST",
                        data: new FormData(this),
                        dataType:"json",
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData: false,
                        beforeSend: function () {
                            $("#newProductSubmitBtn").html('Uploading..');
                        },
                        success:function(data){
                            if(data.message == 'success'){
                                toastr.success('Product successfully added');
                                $('#loadProducts').DataTable().destroy();
                                find_products();
                                $("#newProductSubmitBtn").html('Success');
                                $('#newProductForm')[0].reset();
                                $('#newProductModal').modal('hide');
                            }
                        }
                    });
                }
            }
        });

        // view 
        $(document).on('click', '.view', function(e){
            e.preventDefault();
            var product_id = $(this).attr('id');
            var action = "FETCH_PRODUCT";
            $.ajax({
                url:"<?php echo base_url(); ?>api/products/products.php",
                type:"POST",
                data:{action:action, product_id:product_id},
                dataType:"json",
                success:function(data){
                    var product_id = $.trim(data.id);
                    localStorage.setItem('product_id', product_id);
                    window.location.href = "<?php echo base_url(); ?>vendors/products/show.php?product="+product_id;
                }
            });
        });
    });
</script>