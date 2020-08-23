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
                <h1>Delivery</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Delivery Mode</li>
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
                        <h3 class="card-title">Mode of Delivery Table</h3>
                        <div class="card-tools">
                            <a href="#" id="newDeliveryModeBtn" class="btn btn-primary">
                                <i class="fa  fa-plus-square"></i> New Mode of Delivery
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="loadDeliveryModes" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mode</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Edit</th>
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
    <div class="modal fade" id="newDeliveryModeModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Mode of Delivery</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="newDeliveryModeForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <span id="alertMessage"></span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="mode_id" id="newDeliveryModeId" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="newDeliveryMode">Mode</label>
                            <select name="mode" id="newDeliveryMode" class="form-control">
                                <option value="" disabled selected>Choose Mode</option>
                                <option value="PICK UP">PICK UP</option>
                                <option value="SHIP WITHIN NAIROBI">SHIP OUTSIDE NAIROBI</option>
                                <option value="SHIP OUTSIDE NAIROBI">SHIP OUTSIDE NAIROBI</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="newDeliveryModeDescription">Description</label>
                            <textarea name="description" id="newDeliveryModeDescription" class="form-control" placeholder="Enter Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="newDeliveryModeAmount">Delivery Cost:</label>
                            <input type="text" class="form-control" id="newDeliveryModeAmount" name="delivery_amount" placeholder="Enter Delivery Amount">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="newDeliveryModeSubmitBtn" class="btn btn-success">Save</button>
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
        function find_delivery_mode() {
            var dataTable = $('#loadDeliveryModes').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url(); ?>api/delivery/fetch_mode.php",
                    type: "POST",
                },
                "autoWidth": false
            });
        }
        find_delivery_mode();

        $('#newDeliveryModeBtn').click(function(event){
            event.preventDefault();
            $('#newDeliveryModeModal').modal('show');
            $('#newDeliveryModeForm')[0].reset();
        });

        $('#newDeliveryModeForm').submit(function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url:"<?php echo base_url(); ?>api/delivery/new_mode.php",
                type:"POST",
                data:form_data,
                dataType:"json",
                beforeSend:function(){
                    $('#newDeliveryModeSubmitBtn').html('Loading..');
                },
                success:function(data){
                    if(data.message == "success"){
                        $('#newDeliveryModeSubmitBtn').html('Success');
                        $('#loadDeliveryModes').DataTable().destroy();
                        find_delivery_mode();
                        $('#newDeliveryModeForm')[0].reset();
                        $('#newDeliveryModeModal').modal('hide');
                    }

                    if(data.message == "modeExists"){
                        $('#alertMessage').html('<div class="alert alert-danger">Mode of delivery entered already exists.</div>');
                        $('#newDeliveryModeSubmitBtn').html('Error');
                        return false;
                    }
                }
            });

        });

        // view 
        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var delivery_mode_id = $(this).attr('id');
            var action = "FETCH_MODE";
            $.ajax({
                url:"<?php echo base_url(); ?>api/delivery/delivery_mode.php",
                type:"POST",
                data:{action:action, delivery_mode_id:delivery_mode_id},
                dataType:"json",
                success:function(data){
                    $('#newDeliveryModeId').val(data.id);
                    $('#newDeliveryModeDescription').val(data.mode_description);
                    $('#newDeliveryModeAmount').val(data.delivery_amount);
                    $('#newDeliveryModeModal').modal('show');
                }
            });
        });

        // delete
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            if(confirm("Are you sure?")){
                var delivery_mode_id = $(this).attr('id');
                var action = "DELETE_MODE";
                $.ajax({
                    url:"<?php echo base_url(); ?>api/delivery/delivery_mode.php",
                    type:"POST",
                    data:{action:action, delivery_mode_id:delivery_mode_id},
                    dataType:"json",
                    success:function(data){
                        if(data.message == "success"){
                            $('#loadDeliveryModes').DataTable().destroy();
                            find_delivery_mode();
                        }
                    }
                });   
            }else{
                return false;  
            }
        });
    });
</script>