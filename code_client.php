<?php
$connection = mysqli_connect("localhost", "root", "", "ken_poms");

// Insert
if (isset($_POST['save'])) {
    $company_name = $_POST['company_name'];
    $contact_name = $_POST['contact_name'];
    $contact_title = $_POST['contact_title'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $province = $_POST['province'];
    $contact_number = $_POST['contact_number'];

    $insert_query = "INSERT INTO `client` (company_name, contact_name, contact_title, city, postal_code, province, contact_number) VALUES ('$company_name', '$contact_name', '$contact_title', '$city', '$postal_code', '$province', '$contact_number')";

    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = "Data inserted successfully";
        header("Location: index.php?page=customers");
    } else {
        $_SESSION['status'] = "Insertion of data failed";
        header("Location: index.php?page=customers");
    }
}


// View
if (isset($_POST['click-view-client-btn'])) {
    $id = $_POST['client-id'];

    $fetch_query = "SELECT * FROM `client` WHERE client_id='$id'";
    $fetch_query_run = mysqli_query($connection, $fetch_query);

    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row =  mysqli_fetch_array($fetch_query_run)) {
            echo '
<div class="card">
    <div class="card-body text-start">
        <h5 class="card-title text-center mb-4">Client Details</h5>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Client ID: <span class="fw-normal">'.$row['client_id'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Company Name: <span class="fw-normal">'.$row['company_name'].'</span></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Contact Name: <span class="fw-normal">'.$row['contact_name'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Contact Title: <span class="fw-normal">'.$row['contact_title'].'</span></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">City: <span class="fw-normal">'.$row['city'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Postal Code: <span class="fw-normal">'.$row['postal_code'].'</span></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Province: <span class="fw-normal">'.$row['province'].'</span></h6>
            </div>
            <div class="col-md-6">
                <h6 style="font-size: 14px; font-weight:bold;">Contact No.: <span class="fw-normal">'.$row['contact_number'].'</span></h6>
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
if (isset($_POST['click-edit-client-btn'])) {
    $id = $_POST['client_id'];
    $array_result = [];

    $fetch_query = "SELECT * FROM `client` WHERE client_id='$id'";
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
    $id = $_POST['client_id'];
    $company_name = $_POST['company_name'];
    $contact_name = $_POST['contact_name'];
    $contact_title = $_POST['contact_title'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postal_code = $_POST['postal_code'];
    $province = $_POST['province'];
    $contact_number = $_POST['contact_number'];

    $update_query = "UPDATE `client` SET company_name = '$company_name', contact_name ='$contact_name' , contact_title='$contact_title' , city='$city' , postal_code='$postal_code', province='$province', contact_number='$contact_number' WHERE client_id = '$id'";

    $update_query_run = mysqli_query($connection, $update_query);

    if($update_query_run){
        $_SESSION['status'] = "Data updated successfully";
        header("Location: index.php?page=customers");
    } else {
        $_SESSION['status'] = "Update failed";
        header("Location: index.php?page=customers");
    }
}

// delete
if(isset($_POST['click_delete_btn']))
{
    $id = $_POST['client-id'];

    $delete_query = "DELETE FROM `client` WHERE client_id = '$id'";
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