<?php require_once('../../init/initialization.php');
$page = "promotions";
$title = "TadTechAfrica || Admin";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'admins' . DS . 'header.php');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Product Promotions </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>admins/index.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Promotions</li>
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
                        <h3 class="card-title">Product Promotion Table</h3>
                        <div class="card-tools">
                            <a href="#" id="newProductPromotionBtn" class="btn btn-primary">
                                <i class="fa  fa-plus-square"></i> Promote Product
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="loadPromotions" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Classification</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Banner</th>
                                    <th>Price</th>
                                    <th>Delete</th>
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
    <div class="modal fade" id="newProductPromotionModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Classification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="newProductPromotionForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <span id="alertPromotionsMessage"></span>
                        </div>

                        <div class="form-group">
                            <label for="newClassificationName">Products:</label>
                            <?php
                            $products = new Products();
                            $all_products = $products->find_all();
                            ?>
                            <select name="product_id" id="product_id" class="form-control">
                                <option disabled selected>Choose product</option>
                                <?php if (count($all_products) > 0) {
                                    foreach ($all_products as $product) { ?>
                                        <option value="<?php echo htmlentities($product['id']); ?>">
                                            <?php echo htmlentities($product['product_name']); ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="">No Products</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="banner_image">Banner Image</label>
                            <input type="file" id="banner_image" name="banner_image" class="form-control" />
                            <p class="help-block">Banner Image.</p>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="newProductPromotionSubmitBtn" class="btn btn-primary">Publish</button>
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

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'admins' . DS . 'footer.php'); ?>

<script>
    $(document).ready(function() {
        function find_products_promotion() {
            var dataTable = $('#loadPromotions').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url(); ?>api/product_promotions/fetch.php",
                    type: "POST",
                },
                "autoWidth": false
            });
        }
        find_products_promotion();

        $('#newProductPromotionBtn').click(function(event) {
            event.preventDefault();
            $('#newProductPromotionModal').modal('show');
            $('#newProductPromotionForm')[0].reset();
        });

        $('#newProductPromotionForm').submit(function(event) {
            event.preventDefault();

            event.preventDefault();
            var banner_image = $('#banner_image').val();
            if (banner_image == '') {
                $('#alertPromotionsMessage').html('<div class="alert alert-danger alert-dismissible">Please Select an image</div>');
                return false;
            } else {
                var extension = banner_image.split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    $('#banner_image').val('');
                    $('#alertPromotionsMessage').html('<div class="alert alert-danger alert-dismissible">The file selected is invalid. Please check and try again</div>');
                    return false;
                } else {
                    $.ajax({
                        url: "<?php echo base_url(); ?>api/product_promotions/new_product_promotions.php",
                        type: "POST",
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        beforeSend: function() {
                            $("#newProductPromotionSubmitBtn").html('Uploading..');
                        },
                        success: function(data) {
                            if (data.message == 'success') {
                                toastr.success('Product successfully promoted');
                                $('#loadPromotions').DataTable().destroy();
                                find_products_promotion();
                                $("#newProductPromotionSubmitBtn").html('Success');
                                $('#newProductPromotionForm')[0].reset();
                                $('#newProductPromotionModal').modal('hide');
                            }
                        }
                    });
                }
            }
        });

        // delete 
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            if (confirm("Are you sure.?")) {
                var action = "DELETE_PROMOTION";
                var promotion_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>api/product_promotions/promotions.php",
                    type: "POST",
                    data: {
                        action: action,
                        promotion_id: promotion_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.message == "success") {
                            toastr.success('Successfully removed product from promotion.');
                            $('#loadPromotions').DataTable().destroy();
                            find_products_promotion();
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>