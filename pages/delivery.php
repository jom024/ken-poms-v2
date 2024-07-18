<?php
require "code_mor.php";
?>

<div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Mode of Receiving</h2>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link second-text fw-bold">
                        <i class="fas fa-bell my-1 me-2"></i>
                    </a>
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

    <!-- Insert Modal -->
    <div class="modal fade" id="addMOR" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMORLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addMORLabel">Add MOR Details</h1>
                </div>
                <form action="code_mor.php" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="type" class="col-form-label">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Pickup">Pickup</option>
                                    <option value="Delivery">Delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="delivery_date" class="col-form-label">Delivery Date</label>
                                <input type="date" name="delivery_date" id="delivery_date" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pickup_date" class="col-form-label">Pickup Date</label>
                                <input type="date" name="pickup_date" id="pickup_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="receiver_name" class="col-form-label">Receiver Name</label>
                                <input type="text" name="receiver_name" id="receiver_name" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="delivery_address" class="col-form-label">Delivery Address</label>
                                <input type="text" name="delivery_address" id="delivery_address" class="form-control">
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
    <div class="modal fade" id="viewMORModal" tabindex="-1" aria-labelledby="viewMORModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewMORModalLabel">View MOR Details</h1>
                </div>
                <div class="modal-body">
                    <div class="view-mor-data">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editMOR" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMORLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editMORLabel">Update MOR Details</h1>
                </div>
                <form action="code_mor.php" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <input type="hidden" id="modeofreceiving_id" name="modeofreceiving_id">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md6"></div>
                            <div class="col-md-2">
                                <label for="type-edit" class="col-form-label">Type</label>
                            </div>
                            <div class="col-md-4">
                                <select name="type_edit" id="type-edit" class="form-control">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Pickup">Pickup</option>
                                    <option value="Delivery">Delivery</option>
                                </select>
                            </div>
                            <div class="col-md6"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="delivery-date" class="col-form-label">Delivery Date</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="delivery-date" class="form-control" name="delivery_date_edit">
                            </div>
                            <div class="col-md-2">
                                <label for="pickup-date" class="col-form-label">Pickup Date</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="pickup-date" class="form-control" name="pickup_date_edit">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="receiver-name" class="col-form-label">Receiver Name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="receiver-name" class="form-control" name="receiver_name_edit">
                            </div>
                            <div class="col-md-2">
                                <label for="delivery-address" class="col-form-label">Delivery Address</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="delivery-address" class="form-control" name="delivery_address_edit">
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
                        <h4 class="text-left float-start p-3">MODE OF RECEIVING</h4>
                        <!-- Button trigger modal -->

                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-4 float-end">
                                    <div class="input-group mt-3 mb-3">
                                        <select name="sortOrder" class="form-control">
                                            <option value="default" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == "default") {
                                                                        echo 'default';
                                                                    } ?>>Default</option>
                                            <option value="most-recent-first" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == "most-recent-first") {
                                                                                    echo 'selected';
                                                                                } ?>>Most Recent</option>
                                            <option value="oldest-first" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == "oldest-first") {
                                                                                echo 'selected';
                                                                            } ?>>Oldest</option>
                                            <option value="highest-price-first" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == "highest-price-first") {
                                                                                    echo 'selected';
                                                                                } ?>>Highest Price</option>
                                            <option value="lowest-price-first" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == "lowest-price-first") {
                                                                                    echo 'selected';
                                                                                } ?>>Lowest Price</option>
                                            <option value="nearest-due" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == "nearest-due") {
                                                                            echo 'selected';
                                                                        } ?>>Lowest Price</option>
                                            <option value="lowest-price-first" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == "lowest-price-first") {
                                                                                    echo 'selected';
                                                                                } ?>>Lowest Price</option>
                                        </select>
                                        <button class="input-group-text btn-filter" type="submit" id="basic-addon2"><i class="fa fa-filter" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary float-start mt-3 mb-3 ordercss" data-bs-toggle="modal" data-bs-target="#addMOR">
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
                                    <th scope="col">Type</th>
                                    <th scope="col">Delivery Date</th>
                                    <th scope="col">Pickup Date</th>
                                    <th scope="col">Receiver Name</th>
                                    <th scope="col">Delivery Address</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "ken_poms");
                                if (isset($_GET['sortOrder'])) {
                                    if ($_GET['sortOrder'] == 'most-recent-first') {
                                        $sort_option = 'DESC';
                                        $order_by = 'order_date';
                                    } else if ($_GET['sortOrder'] == 'oldest-first') {
                                        $sort_option = 'ASC';
                                        $order_by = 'order_date';
                                    } else if ($_GET['sortOrder'] == 'highest-price-first') {
                                        $sort_option = 'DESC';
                                        $order_by = 'total_price';
                                    } else if ($_GET['sortOrder'] == 'lowest-price-first') {
                                        $sort_option = 'ASC';
                                        $order_by = 'total_price';
                                    }
                                }

                                if (empty($_GET['sortOrder']) || $_GET['sortOrder'] == 'default') {
                                    @$fetch_query = "SELECT * FROM `mode_of_receiving`";
                                } else {
                                    @$fetch_query = "SELECT * FROM `mode_of_receiving` ORDER BY $order_by $sort_option";
                                }

                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                if (mysqli_num_rows($fetch_query_run) > 0) {
                                    while ($row =  mysqli_fetch_array($fetch_query_run)) {
                                ?>
                                        <tr>
                                            <th scope="row" class="modeofreceiving-id"> <?php echo $row['modeofreceiving_id']; ?> </t>
                                            <td> <?php echo $row['type']; ?> </td>
                                            <td> <?php echo $row['delivery_date']; ?> </td>
                                            <td> <?php echo $row['pickup_date']; ?> </td>
                                            <td> <?php echo $row['receiver_name']; ?> </td>
                                            <td> <?php echo $row['delivery_address']; ?> </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm text-white view-mor ordercss" data-bs-toggle="modal" data-bs-target="#viewMOR">
                                                    <i class="lni lni-eye"></i> VIEW</button>
                                                <button type="button" class="btn btn-success btn-sm edit-mor ordercss" data-bs-toggle="modal" data-bs-target="#editMOR">
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
                                        <td colspan="6">No Record Found</td>
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