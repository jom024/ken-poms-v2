<?php
session_start();
require "code_client.php";
$notifications = get_new_notifications($connection);
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Customers</h2>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                 <!--Notification icon -->
                 <li class="nav-item dropdown">
                    <a href="#" class="nav-link second-text fw-bold" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell my-1 me-2"></i>
                        <span class="badge bg-danger"><?= count($notifications) ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <?php if (count($notifications) > 0): ?>
                            <?php foreach ($notifications as $notification): ?>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        Client #<?= htmlspecialchars($notification['client_id']) ?> added: <?= htmlspecialchars($notification['company_name']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="#">No new orders</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i>John Doe
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="?page=profile">Profile</a></li>
                        <li><a class="dropdown-item" href="?page=settings">Settings</a></li>
                        <li><a class="dropdown-item" href="login.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
<?php
    function get_new_notifications($connection) {
    // Adjust the query to match your table structure and requirements
    $query = "SELECT * FROM `client` WHERE `client_id` > 3 ORDER BY `client_id` ASC";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

    <!-- Insert Modal -->
    <div class="modal fade" id="addClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addClientLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addClientLabel">Add Client Details</h1>
                </div>
                <form action="code_client.php" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="company_name" class="col-form-label">Company Name</label>
                                <input type="text" id="company_name" class="form-control" name="company_name">
                            </div>
                            <div class="col-md-6">
                                <label for="contact_name" class="col-form-label">Contact Name</label>
                                <input type="text" id="contact_name" class="form-control" name="contact_name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact_title" class="col-form-label">Contact Title</label>
                                <input type="text" id="contact_title" class="form-control" name="contact_title">
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="col-form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="postal_code" class="col-form-label">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code">
                            </div>
                            <div class="col-md-6">
                                <label for="province" class="col-form-label">Province</label>
                                <input type="text" class="form-control" id="province" name="province">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact_number" class="col-form-label">Contact No.</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- View Modal -->
    <div class="modal fade" id="viewClientModal" tabindex="-1" aria-labelledby="viewClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewClientModalLabel">View Client Details</h1>
                </div>
                <div class="modal-body">
                    <div class="view-client-data">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editClientLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editClientLabel">Update Client Details</h1>
                </div>
                <form action="code_client.php" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <input type="hidden" id="client_id" name="id" value='<?php echo $client_id; ?>'>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="company-name" class="col-form-label">Company Name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="company-name" class="form-control" name="company_name_edit">
                            </div>
                            <div class="col-md-2">
                                <label for="contact-name" class="col-form-label">Contact Name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="contact-name" class="form-control" name="contact_name_edit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="contact-title" class="col-form-label">Contact Title</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="contact-title" class="form-control" name="contact_title_edit">
                            </div>
                            <div class="col-md-2">
                                <label for="city-edit" class="col-form-label">City</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="city-edit" class="form-control" name="city_edit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="postal-code" class="col-form-label">Postal Code</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="postal-code" class="form-control" name="postal_code_edit">
                            </div>
                            <div class="col-md-2">
                                <label for="province" class="col-form-label">Province</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="province-edit" class="form-control" name="province_edit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="contact-number" class="col-form-label">Contact No.</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="contact-number" class="form-control" name="contact_number_edit">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <?php
                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                    echo $_SESSION['status'];
                ?> <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Nice!</strong> <?php $_SESSION['status'] ?>
                        <button type="button" class="btn-danger btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['status']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-left float-start p-3">CUSTOMERS</h4>
                        <!-- Button trigger modal -->

                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-4 float-end">
                                    <div class="input-group mt-3 mb-3">
                                        <select name="sortClient" class="form-control">
                                            <option value="default" <?php if (isset($_GET['sortClient']) && $_GET['sortClient'] == "default") {
                                                                        echo 'default';
                                                                    } ?>>Default</option>
                                            <option value="a-z" <?php if (isset($_GET['sortClient']) && $_GET['sortClient'] == "a-z") {
                                                                                    echo 'selected';
                                                                                } ?>>Alphabetical Order (A-Z)</option>
                                            <option value="z-a" <?php if (isset($_GET['sortClient']) && $_GET['sortClient'] == "z-a") {
                                                                                echo 'selected';
                                                                            } ?>>Alphabetical Order (Z-A)</option>
                                        </select>
                                        <button class="input-group-text btn-filter" type="submit" id="basic-addon2"><i class="fa fa-filter" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary float-start mt-3 mb-3 ordercss" data-bs-toggle="modal" data-bs-target="#addClient">
                                        <i class="lni lni-plus"></i> ADD</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-warning table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Contact Name</th>
                                    <th scope="col">Contact Title</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Postal Code</th>
                                    <th scope="col">Province</th>
                                    <th scope="col">Contact_Number</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "ken_poms");
                                if (isset($_GET['sortClient'])) {
                                    if ($_GET['sortClient'] == 'a-z') {
                                        $sort_option = 'ASC';
                                        $order_by = 'contact_name';
                                    } else if ($_GET['sortClient'] == 'z-a') {
                                        $sort_option = 'DESC';
                                        $order_by = 'contact_name';
                                    }   
                                }

                                if (empty($_GET['sortClient']) || $_GET['sortClient'] == 'default') {
                                    @$fetch_query = "SELECT * FROM `client`";
                                } else {
                                    @$fetch_query = "SELECT * FROM `client` ORDER BY $order_by $sort_option";
                                }

                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                if (mysqli_num_rows($fetch_query_run) > 0) {
                                    while ($row =  mysqli_fetch_array($fetch_query_run)) {
                                ?>
                                        <tr>
                                            <th scope="row" class="client-id"> <?php echo $row['client_id']; ?> </th>
                                            <td> <?php echo $row['company_name']; ?> </td>
                                            <td> <?php echo $row['contact_name']; ?> </td>
                                            <td> <?php echo $row['contact_title']; ?> </td>
                                            <td> <?php echo $row['city']; ?> </td>
                                            <td> <?php echo $row['postal_code']; ?> </td>
                                            <td> <?php echo $row['province']; ?> </td>
                                            <td> <?php echo $row['contact_number']; ?> </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm text-white view-client ordercss" data-bs-toggle="modal" data-bs-target="#viewClient">
                                                    <i class="lni lni-eye"></i> VIEW</button>
                                                <button type="button" class="btn btn-success btn-sm edit-client ordercss" data-bs-toggle="modal" data-bs-target="#editClient">
                                                    <i class="lni lni-pencil"></i> EDIT</button>
                                                <button type="button" class="btn btn-danger btn-sm delete_btn ordercss">
                                                    <i class="lni lni-trash-can"></i> DELETE</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="9">No Record Found</td>
                                    </tr>
                                <?php
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>