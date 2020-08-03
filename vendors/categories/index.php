<?php
require_once('../../init/initialization.php');
$page = "categories";
$title = "Vendors || Categories";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'vendors' . DS . 'header.php');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
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
                        <h3 class="card-title">Categories Table</h3>
                        <div class="card-tools">
                            <a href="#" id="newCategoryBtn" class="btn btn-primary">
                                <i class="fa  fa-plus-square"></i> New Category
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="loadCategories" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category Image</th>
                                    <th>Category</th>
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
    <div class="modal fade" id="newCategoryModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="newCategoryForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <span id="alertCategoryMessage"></span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="category_id" class="form-control" id="newCategoryId"/>
                        </div>
                        <div class="form-group">
                            <label for="newCategoryName">Category Name</label>
                            <input type="text" name="category" class="form-control" id="newCategoryName" placeholder="Enter category name"/>
                        </div>
                        <div class="form-group">
                            <label for="newCategoryImage">Category Image</label>
                            <input type="file" id="newCategoryImage" name="image" />

                            <p class="help-block">Please upload category image here.</p>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="newCategorySubmitBtn" class="btn btn-success">Save</button>
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
        function find_categories() {
            var dataTable = $('#loadCategories').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url(); ?>api/categories/fetch.php",
                    type: "POST",
                },
                "autoWidth": false
            });
        }
        find_categories();

        $('#newCategoryBtn').click(function(event){
            event.preventDefault();
            $('#newCategoryModal').modal('show');
            $('#newCategoryForm')[0].reset();
        });

        $('#newCategoryForm').submit(function(event){
            event.preventDefault();
            var category_image = $('#newCategoryImage').val();
            if(category_image == ''){
                $('#alertCategoryMessage').html('<div class="alert alert-danger alert-dismissible">Please Select an image</div>');
                return false;
            }else{
                var extension = category_image.split('.').pop().toLowerCase();
                if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
                    $('#newCategoryImage').val('');
                    $('#alertCategoryMessage').html('<div class="alert alert-danger alert-dismissible">The file selected is invalid. Please check and try again</div>');
                    return false;
                }else{
                    $.ajax({
                        url:"<?php echo base_url(); ?>api/categories/new_categoires.php",
                        type:"POST",
                        data: new FormData(this),
                        dataType:"json",
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData: false,
                        beforeSend: function () {
                            $("#newCategorySubmitBtn").html('Uploading..');
                        },
                        success:function(data){
                            if(data.message == 'success'){
                                toastr.success('Category successfully altered');
                                $('#loadCategories').DataTable().destroy();
                                find_categories();
                                $("#newCategorySubmitBtn").html('Success');
                                $('#newCategoryForm')[0].reset();
                                $('#newCategoryModal').modal('hide');
                            }
                        }
                    });
                }
            }
        });

        //edit 
        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var category_id = $(this).attr('id');
            var action = "FETCH_CATEGORY";
            $.ajax({
                url:"<?php echo base_url(); ?>api/categories/categories.php",
                type:"POST",
                data:{action:action, category_id:category_id},
                dataType:"json",
                success:function(data){
                    $('#newCategoryId').val(data.id);
                    $('#newCategoryName').val(data.category_name);
                    $('#newCategoryModal').modal('show');
                }
            });
        });

        // delete 
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            if(confirm("Are you sure.?")){
                var action = "DELETE_CATEGORY";
                var category_id = $(this).attr("id");
                $.ajax({
                    url:"<?php echo base_url(); ?>api/categories/categories.php",
                    type:"POST",
                    data:{action:action, category_id:category_id},
                    dataType:"json",
                    success:function(data){
                        if(data.message == "success"){
                            toastr.success('Successfully removed category.');
                            $('#loadCategories').DataTable().destroy();
                            find_categories();
                        }
                    }
                });
            }else{
                return false;
            }
        });
    });
</script>