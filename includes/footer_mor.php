<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
    // view-MOR
    $(document).ready(function() {

        $('.view-mor').click(function(e) {
            e.preventDefault();

            // console.log('hello');

            var modeofreceiving_id = $(this).closest('tr').find('.modeofreceiving_id').text();

            $.ajax({
                type: "POST",
                url: "code_mor.php",
                data: {
                    'click-view-mor-btn': true,
                    'modeofreceiving-id': modeofreceiving_id,
                },
                success: function(response) {
                    // console.log(response);

                    $('.view-mor-data').html(response);
                    $('#viewMORModal').modal('show');
                }
            });
        });
    });

    // edit-order
    $(document).ready(function() {

        $('.edit-order').click(function(e) {
            e.preventDefault();


            var order_id = $(this).closest('tr').find('.order-id').text();
            console.log(order_id);

            $.ajax({
                type: "POST",
                url: "code_mor.php",
                data: {
                    'click-edit-btn': true,
                    'order-id': order_id,
                },
                success: function(response) {
                    // console.log(response);

                    $.each(response, function(Key, value) {
                        // console.log(value['client_id']);

                        $('#order_id').val(value['order_id']);
                        $('#client_id').val(value['client_id']);
                        $('#order_status').val(value['order_status']);
                        $('#payment_status').val(value['payment_status']);
                        $('#priceID').val(value['total_price']);
                        $('#order_date').val(value['order_date']);
                        $('#fulfillment_date').val(value['fulfillment_date']);
                    });
                    // $('#editOrder').modal('show');
                }
            });
        });
    });

    // delete-order
    $(document).ready(function() {
        $('.delete_btn').click(function(e) {
            e.preventDefault();

            var order_id = $(this).closest('tr').find('.order-id').text();
            // console.log(order_id);

            $.ajax({
                method: "POST",
                url: "code_mor.php",
                data: {
                    'click_delete_btn': true,
                    'order-id': order_id,
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                }
            });

        });
    });
</script>