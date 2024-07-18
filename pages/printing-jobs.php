<?php
session_start();
require "code_pj.php";
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Printing Jobs</h2>
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
    <div class="modal fade" id="addPJ" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addPJLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addPJLabel">Add Job_Order Details</h1>
                </div>
                <form action="code_pj.php" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                        
                            <div class="col-md-6">
                                <label for="quotation_id" class="col-form-label">Quotation ID</label>
                                <input type="text" id="quotation_id" class="form-control" name="quotation_id">
                            </div>
                            <div class="col-md-6">
                                <label for="product_name" class="col-form-label">Product Name</label>
                                <input type="text" id="product_name" class="form-control" name="product_name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="hidden" name="" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="job_price" class="col-form-label">Job Price</label>
                                <input type="number" class="form-control" id="job_price" name="job_price">
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="description" class="col-form-label">Description</label>
                                <input type="textarea" class="form-control" id="description" name="description">
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
    <div class="modal fade" id="viewPJModal" tabindex="-1" aria-labelledby="viewPJModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewPJModalLabel">View Printing Job Details</h1>
                </div>
                <div class="modal-body">
                    <div class="view-pj-data">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editPJ" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPJLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPJLabel">Update Job Order Details</h1>
                </div>
                <form action="code_pj.php" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <input type="hidden" id="job_order_num" name="id" value='<?php echo $client_id; ?>'>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                            <?php
                                $connection = mysqli_connect("localhost", "root", "", "ken_poms");
                                $quotation_query = "SELECT quotation_id, quotation_num FROM `quotation`";
                                $quotation_query_run = mysqli_query($connection, $quotation_query);

                                $quotation_options = '';
                                if (mysqli_num_rows($quotation_query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($quotation_query_run)) {
                                        $quotation_options = '<option value="' . $row['quotation_id'] . '">' . $row['quotation_id'] .' | ' . $row['quotation_num']. '</option>';
                                    }
                                } ?>
                                <label for="quotation-id" class="col-form-label">Quotation ID</label>
                            </div>
                            <div class="col-md-4">
                                <select type="number" id="quotation-id" class="form-control" name="quotation_id_edit">
                                    <?php echo $quotation_options; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="product-name" class="col-form-label">Product Name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="product-name" class="form-control" name="product_name_edit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="description-edit" class="col-form-label">Description</label>
                            </div>
                            <div class="col-md-4">
                                <input type="textarea" id="description-edit" class="form-control" name="description_edit">
                            </div>
                            <div class="col-md-2">
                                <label for="job-price" class="col-form-label">Job Price</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="job-price" class="form-control" name="job_price_edit">
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
                        <h4 class="text-left float-start p-3">PRINTING JOBS</h4>
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
                                    <button type="button" class="btn btn-primary float-start mt-3 mb-3 ordercss" data-bs-toggle="modal" data-bs-target="#addPJ">
                                        <i class="lni lni-plus"></i> ADD</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-warning table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">J.O No.</th>
                                    <th scope="col">Quotation ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Job Price</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "ken_poms");
                                if (isset($_GET['sortClient'])) {
                                    if ($_GET['sortClient'] == 'a-z') {
                                        $sort_option = 'ASC';
                                        $order_by = 'company_name';
                                    } else if ($_GET['sortClient'] == 'z-a') {
                                        $sort_option = 'DESC';
                                        $order_by = 'company_name';
                                    }
                                }

                                if (empty($_GET['sortClient']) || $_GET['sortClient'] == 'default') {
                                    @$fetch_query = "SELECT * FROM `job_order`";
                                } else {
                                    @$fetch_query = "SELECT * FROM `job_order` ORDER BY $order_by $sort_option";
                                }

                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                if (mysqli_num_rows($fetch_query_run) > 0) {
                                    while ($row =  mysqli_fetch_array($fetch_query_run)) {
                                ?>
                                        <tr>
                                            <th scope="row" class="job-order-num"> <?php echo $row['job_order_num']; ?> </th>
                                            <td> <?php echo $row['quotation_id']; ?> </td>
                                            <td> <?php echo $row['product_name']; ?> </td>
                                            <td> <?php echo $row['description']; ?> </td>
                                            <td> <?php echo $row['job_price']; ?> </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm text-white view-pj ordercss" data-bs-toggle="modal" data-bs-target="#viewClient">
                                                    <i class="lni lni-eye"></i> VIEW</button>
                                                <button type="button" class="btn btn-success btn-sm edit-pj ordercss" data-bs-toggle="modal" data-bs-target="#editClient">
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