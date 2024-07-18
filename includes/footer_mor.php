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

            var modeofreceiving_id = $(this).closest('tr').find('.modeofreceiving-id').text();
            console.log(modeofreceiving_id);
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

    // edit-MOR
    $(document).ready(function() {

        $('.edit-mor').click(function(e) {
            e.preventDefault();


            var modeofreceiving_id = $(this).closest('tr').find('.modeofreceiving-id').text();
            // console.log(modeofreceiving_id);
            $.ajax({
                type: "POST",
                url: "code_mor.php",
                data: {
                    'click-edit-mor-btn': true,
                    'modeofreceiving-id': modeofreceiving_id,
                },
                success: function(response) {
                    // console.log(response);

                    $.each(response, function(Key, value) {
                        // console.log(value['client_id']);

                        $('#modeofreceiving_id').val(value['modeofreceiving_id']);
                        $('#type-edit').val(value['type']);
                        $('#delivery-date').val(value['delivery_date']);
                        $('#pickup-date').val(value['pickup_date']);
                        $('#receiver-name').val(value['receiver_name']);
                        $('#delivery-address').val(value['delivery_address']);
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

            var modeofreceiving_id = $(this).closest('tr').find('.modeofreceiving-id').text();
            // console.log(order_id);

            $.ajax({
                method: "POST",
                url: "code_mor.php",
                data: {
                    'click_delete_btn': true,
                    'modeofreceiving-id': modeofreceiving_id,
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                }
            });

        });
    });
</script>