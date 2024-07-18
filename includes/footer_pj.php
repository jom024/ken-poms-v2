<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
    // view-pj
    $(document).ready(function() {

        $('.view-pj').click(function(e) {
            e.preventDefault();

            // console.log('hello');

            var job_order_num = $(this).closest('tr').find('.job-order-num').text();

            $.ajax({
                type: "POST",
                url: "code_pj.php",
                data: {
                    'click-view-pj-btn': true,
                    'job-order-num': job_order_num,
                },
                success: function(response) {
                    // console.log(response);

                    $('.view-pj-data').html(response);
                    $('#viewPJModal').modal('show');
                }
            });
        });
    });

    // edit-pj
    $(document).ready(function() {

        $('.edit-pj').click(function(e) {
            e.preventDefault();


            var job_order_num = $(this).closest('tr').find('.job-order-num').text();
            // console.log(client_id);

            $.ajax({
                type: "POST",
                url: "code_pj.php",
                data: {
                    'click-edit-pj-btn': true,
                    'job-order-num': job_order_num,
                },
                success: function(response) {
                    // console.log(response);

                    $.each(response, function(Key, value) {
                        // console.log(value['client_id']);


                        $('#job_order_num').val(value['job_order_num']);
                        $('#quotation-id').val(value['quotation_id']);
                        $('#product-name').val(value['product_name']);
                        $('#description-edit').val(value['description']);
                        $('#job-price').val(value['job_price']);
                    });
                    $('#editPJ').modal('show');
                }
            });
        });
    });

    // delete-order
    $(document).ready(function() {
        $('.delete_btn').click(function(e) {
            e.preventDefault();

            var job_order_num = $(this).closest('tr').find('.job-order-num').text();
            // console.log(order_id);

            $.ajax({
                method: "POST",
                url: "code_pj.php",
                data: {
                    'click_delete_btn': true,
                    'job-order-num': job_order_num,
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                }
            });

        });
    });
</script>