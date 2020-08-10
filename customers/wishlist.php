<?php
require_once('../init/initialization.php');
$title = "TadTechAfrica || Get upto date with the lattest tech";
$page = "cart";
require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'header.php');
?>

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title">Wishlist Items</div>
                    <div id="loadWishlistItems" class="cart_items">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(PUBLIC_PATH . DS . 'layouts' . DS . 'landing' . DS . 'footer.php'); ?>

<script>
    $(document).ready(function() {
        function find_wishlist_items() {
            var action = "FETCH_WISHLIST_ITEMS";
            $.ajax({
                url: "<?php echo base_url(); ?>api/wishlist/wishlist.php",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    $('#loadWishlistItems').html(data.wishlist_items);
                }
            });
        }
        find_wishlist_items();

        $(document).on('click', '.delete', function(event) {
            event.preventDefault();
            if (confirm('Are you sure...?')) {
                var item_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo base_url(); ?>api/wishlist/remove_wishlist.php",
                    type: "POST",
                    data: {
                        item_id: item_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if(data.message == "success"){
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });
</script>