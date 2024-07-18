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

    header("Location: index.php?page=delivery");
}


// View
if (isset($_POST['click-view-mor-btn'])) {
    $id = $_POST['modeofreceiving-id'];

    $fetch_query = "SELECT * FROM `mode_of_receiving` WHERE modeofreceiving_id='$id'";
    $fetch_query_run = mysqli_query($connection, $fetch_query);

    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row =  mysqli_fetch_array($fetch_query_run)) {
            echo '
<div class="card">
    <div class="card-body text-start">
        <h5 class="card-title text-center mb-4">MOR Details</h5>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">MOR ID: <span class="fw-normal">'.$row['modeofreceiving_id'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Type: <span class="fw-normal">'.$row['type'].'</span></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Delivery Date: <span class="fw-normal">'.$row['delivery_date'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Pickup Date: <span class="fw-normal">'.$row['pickup_date'].'</span></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Receiver Name: <span class="fw-normal">'.$row['receiver_name'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Delivery Address: <span class="fw-normal">'.$row['delivery_address'].'</span></h6>
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
if (isset($_POST['click-edit-mor-btn'])) {
    $id = $_POST['modeofreceiving-id'];
    $array_result = [];

    $fetch_query = "SELECT * FROM `mode_of_receiving` WHERE modeofreceiving_id='$id'";
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
    $id = $_POST['modeofreceiving_id'];
    $type = $_POST['type_edit'];
    $delivery_date = $_POST['delivery_date_edit'];
    $pickup_date = $_POST['pickup_date_edit'];
    $receiver_name = $_POST['receiver_name_edit'];
    $delivery_address = $_POST['delivery_address_edit'];

    $update_query = "UPDATE `mode_of_receiving` 
                    SET `type` = '$type', 
                    delivery_date = '$delivery_date', 
                    pickup_date ='$pickup_date' , 
                    receiver_name='$receiver_name' , 
                    delivery_address='$delivery_address' 
                    WHERE modeofreceiving_id = '$id'";

    $update_query_run = mysqli_query($connection, $update_query);

    Header("Location: index.php?page=delivery");
}

// delete
if(isset($_POST['click_delete_btn']))
{
    $id = $_POST['modeofreceiving-id'];

    $delete_query = "DELETE FROM `mode_of_receiving` WHERE modeofreceiving_id = '$id'";
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