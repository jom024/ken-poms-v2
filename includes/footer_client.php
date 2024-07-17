<script>
    // var el = document.getElementById("wrapper");
    // var toggleButton = document.getElementById("menu-toggle");

    // toggleButton.onclick = function() {
    //     el.classList.toggle("toggled");
    // };
    // view-order
    $(document).ready(function() {

        $('.view-client').click(function(e) {
            e.preventDefault();

            // console.log('hello');

            var client_id = $(this).closest('tr').find('.client-id').text();

            $.ajax({
                type: "POST",
                url: "code_client.php",
                data: {
                    'click-view-client-btn': true,
                    'client-id': client_id,
                },
                success: function(response) {
                    // console.log(response);

                    $('.view-client-data').html(response);
                    $('#viewClientModal').modal('show');
                }
            });
        });
    });

    // edit-client
    $(document).ready(function() {

        $('.edit-client').click(function(e) {
            e.preventDefault();


            var client_id = $(this).closest('tr').find('.client-id').text();
            // console.log(client_id);

            $.ajax({
                type: "POST",
                url: "code_client.php",
                data: {
                    'click-edit-client-btn': true,
                    'client-id': client_id,
                },
                success: function(response) {
                    // console.log(response);

                    $.each(response, function(Key, value) {
                        // console.log(value['client_id']);

                        $('#client_id').val(value['client_id']);
                        $('#company_name').val(value['company_name']);
                        $('#contact_name').val(value['contact_name']);
                        $('#contact_title').val(value['contact_title']);
                        $('#city').val(value['city']);
                        $('#postal_code').val(value['postal_code']);
                        $('#province').val(value['province']);
                        $('#contact_number').val(value['contact_number']);
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

            var client_id = $(this).closest('tr').find('.client-id').text();
            // console.log(order_id);

            $.ajax({
                method: "POST",
                url: "code_client.php",
                data: {
                    'click_delete_btn': true,
                    'client-id': client_id,
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                }
            });

        });
    });
</script>