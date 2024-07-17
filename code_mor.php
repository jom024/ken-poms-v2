<?php
$connection = mysqli_connect("localhost", "root", "", "ken_poms");

// Insert
if (isset($_POST['save'])) {
    $type = $_POST['type'];
    $pickup_date = $_POST['pickup_date'];
    $delivery_date = $_POST['delivery_date'];
    $receiver_name = $_POST['receiver_name'];
    $delivery_address = $_POST['delivery_address'];

    $insert_query = "INSERT INTO `mode_of_receiving` (`type`, pickup_date, delivery_date, receiver_name, delivery_address) VALUES ('$type', '$pickup_date', '$delivery_date', '$receiver_name', '$delivery_address')";

    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = "Data inserted successfully";
        header("Location: index.php?page=delivery");
    } else {
        $_SESSION['status'] = "Insertion of data failed";
        header("Location: error.php");
    }
}


// View
if (isset($_POST['click-view-mor-btn'])) {
    $id = $_POST['modeofreceiving_id'];

    $fetch_query = "SELECT * FROM `mode_of_receiving` WHERE modeofreceiving_id='$id'";
    $fetch_query_run = mysqli_query($connection, $fetch_query);

    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row =  mysqli_fetch_array($fetch_query_run)) {
            echo '
<div class="card">
    <div class="card-body text-start">
        <h5 class="card-title text-center mb-4">Order Details</h5>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">MOR ID: <span class="fw-normal">'.$row['modeofreceiving_id'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Client ID: <span class="fw-normal">'.$row['type'].'</span></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Order Status: <span class="fw-normal">'.$row['delivery_date'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Payment Status: <span class="fw-normal">'.$row['pickup_date'].'</span></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Total Price: <span class="fw-normal">'.$row['receiver_name'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Date of Order: <span class="fw-normal">'.$row['delivery_address'].'</span></h6>
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
if (isset($_POST['click-edit-btn'])) {
    $id = $_POST['order-id'];
    $array_result = [];

    $fetch_query = "SELECT * FROM `order` WHERE order_id='$id'";
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
if (isset($_POST['update']))
{
    $id = $_POST['order_id'];
    $client_id = $_POST['client_id'];
    $order_status = $_POST['order_status'];
    $payment_status = $_POST['payment_status'];
    $total_price = $_POST['total_price'];
    $order_date = $_POST['order_date'];
    $fulfillment_date = $_POST['fulfillment_date'];
    $update_query = "UPDATE `order` SET client_id = '$client_id', order_status = '$order_status', payment_status ='$payment_status' , total_price='$total_price' , order_date='$order_date' , fulfillment_date='$fulfillment_date' WHERE order_id = '$id'";

    $update_query_run = mysqli_query($connection, $update_query);

    if($update_query_run){
        $_SESSION['status'] = "Data updated successfully";
        header("Location: index.php?page=orders");
    } else {
        $_SESSION['status'] = "Update failed";
        header("Location: index.php?page=orders");
    }
}

// delete
if(isset($_POST['click_delete_btn']))
{
    $id = $_POST['order-id'];

    $delete_query = "DELETE FROM `order` WHERE order_id = '$id'";
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