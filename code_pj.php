<?php
$connection = mysqli_connect("localhost", "root", "", "ken_poms");

// Insert
if (isset($_POST['save'])) {
    $quotation_id = $_POST['quotation_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $job_price = $_POST['job_price'];

    $insert_query = "INSERT INTO `job_order` (quotation_id, product_name, `description`, job_price) VALUES ('$quotation_id', '$product_name', '$description', '$job_price')";

    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = "Data inserted successfully";
        header("Location: index.php?page=printing-jobs");
    } else {
        $_SESSION['status'] = "Insertion of data failed";
        header("Location: index.php?page=printing-jobs");
    }
}

// View
if (isset($_POST['click-view-pj-btn'])) {
    $id = $_POST['job-order-num'];

    $fetch_query = "SELECT * FROM `job_order` WHERE job_order_num='$id'";
    $fetch_query_run = mysqli_query($connection, $fetch_query);

    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row =  mysqli_fetch_array($fetch_query_run)) {
            echo '
<div class="card">
    <div class="card-body text-start">
        <h5 class="card-title text-center mb-4">Printing Job Details</h5>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">J.O. No.: <span class="fw-normal">'.$row['job_order_num'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Quotation ID: <span class="fw-normal">'.$row['quotation_id'].'</span></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Product Name: <span class="fw-normal">'.$row['product_name'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Description: <span class="fw-normal">'.$row['description'].'</span></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Job Price: <span class="fw-normal">'.$row['job_price'].'</span></h6>
            </div>
        </div>
    </div>
</div>
';

        }
    } else {
        echo '<h4>No record found.</h4>';
    }
}

// Edit
if (isset($_POST['click-edit-pj-btn'])) {
    $id = $_POST['job-order-num'];
    
    $array_result = [];

    $fetch_query = "SELECT * FROM `job_order` WHERE job_order_num = '$id'";
    $fetch_query_run = mysqli_query($connection, $fetch_query);

    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row =  mysqli_fetch_array($fetch_query_run)) {
            
            array_push($array_result, $row);
            header('content-type: application/json');
            echo json_encode($array_result);
        }
    } else {
        echo '<h4>No record found.</h4>';
    }
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    // Validate and sanitize input data
    $quotation_id = $_POST['quotation_id_edit'];
    $product_name = $_POST['product_name_edit'];
    $description = $_POST['description_edit'];
    $job_price = $_POST['job_price_edit'];

    // Update query
    $update_query = "UPDATE `job_order` SET 
                        quotation_id = '$quotation_id', 
                        product_name = '$product_name', 
                        `description` = '$description', 
                        job_price = '$job_price'
                     WHERE job_order_num = '$id'";

    // Run the query and check for errors
    if (mysqli_query($connection, $update_query)) {
        $_SESSION['status'] = "Data updated successfully";
        header("Location: index.php?page=printing-jobs");
    } else {
        $_SESSION['status'] = "Update failed: " . mysqli_error($connection);
        header("Location: index.php?page=printing-jobs");
    }

}




// delete
if(isset($_POST['click_delete_btn']))
{
    $id = $_POST['job-order-num'];

    $delete_query = "DELETE FROM `job_order` WHERE job_order_num = '$id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if($delete_query_run)
    {
        echo "Order deletion successful.";
    } else 
    {
        echo "Order deletion failed.";
    }
}


?>

