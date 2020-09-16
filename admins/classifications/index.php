<?php require_once('../../init/initialization.php');
$page = "classifications";
$title = "TadTechAfrica || Admin";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'admins' . DS . 'header.php');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Classifications</li>
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
                            <a href="#" id="newClassificationBtn" class="btn btn-primary">
                                <i class="fa  fa-plus-square"></i> New Classification
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="loadClassifications" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Classification</th>
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
    <div class="modal fade" id="newClassificationModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Classification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="newClassificationForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <span id="alertCategoryMessage"></span>
                        </div>
                        <div class="form-group">
                            <label for="newClassificationName">Classification:</label>
                            <select name="classification" id="newClassificationName" class="form-control">
                                <option disabled selected>Enter classification name</option>
                                <option value="Upcoming Products">Upcoming Products</option>
                                <option value="New Arrivals">New Arrivals</option>
                                <option value="Top Sales">Top Sales</option>
                                <option value="Todays Deal">Todays Deal</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="newClassificationSubmitBtn" class="btn btn-success">Save</button>
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
        function find_classifaction() {
            var dataTable = $('#loadClassifications').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url(); ?>api/classifications/fetch.php",
                    type: "POST",
                },
                "autoWidth": false
            });
        }
        find_classifaction();

        $('#newClassificationBtn').click(function(event) {
            event.preventDefault();
            $('#newClassificationModal').modal('show');
            $('#newClassificationForm')[0].reset();
        });

        $('#newClassificationForm').submit(function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>api/classifications/new_classification.php",
                type: "POST",
                data: form_data,
                dataType: "json",
                beforeSend: function() {
                    $("#newClassificationSubmitBtn").html('Loading..');
                },
                success: function(data) {
                    if (data.message == 'success') {
                        toastr.success('Product Classification successfully altered');
                        $('#loadClassifications').DataTable().destroy();
                        find_classifaction();
                        $("#newClassificationSubmitBtn").html('Success');
                        $('#newClassificationForm')[0].reset();
                        $('#newClassificationModal').modal('hide');
                    }
                }
            });

        });

        // delete 
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            if (confirm("Are you sure.?")) {
                var action = "DELETE_CLASSIFICATION";
                var classification_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>api/classifications/product_classifications.php",
                    type: "POST",
                    data: {
                        action: action,
                        classification_id: classification_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.message == "success") {
                            toastr.success('Successfully removed category.');
                            $('#loadClassifications').DataTable().destroy();
                            find_classifaction();
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>