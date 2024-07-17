<?php
// session_start();
require "code.php";
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Orders</h2>
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
    <div class="modal fade" id="addOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addOrderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addOrderLabel">Add Order Details</h1>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="client-id" class="col-form-label">Client ID</label>
                                <input type="number" id="client-id" class="form-control" min="1" name="client_id">
                            </div>
                            <div class="col-md-3">
                                <label for="modeofreceiving-id" class="col-form-label">MOR ID</label>
                                <input type="number" id="modeofreceiving_id" class="form-control" min="1" name="modeofreceiving_id">
                            </div>
                            <div class="col-md-6">
                                <label for="order-status" class="col-form-label">Order Status</label>
                                <select name="order_status" id="order-status" class="form-control">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="On Delivery">On Delivery</option>
                                    <option value="Ready For Pick-up">Ready For Pick-up</option>
                                    <option value="Complete">Complete</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="payment-status" class="col-form-label">Payment Status</label>
                                <select name="payment_status" id="payment-status" class="form-control">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Downpayment">Downpayment</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="col-form-label">Total Price</label>
                                <input type="number" min="1" class="form-control" id="price" step="any" value="1.00" name="total_price">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="order-date" class="col-form-label">Date Ordered</label>
                                <input type="date" name="order_date" id="order-date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="fulfillment-date" class="col-form-label">Fulfillment Date</label>
                                <input type="date" name="fulfillment_date" id="fulfillment-date" class="form-control">
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
    <div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewOrderModalLabel">View Order Details</h1>
                </div>
                <div class="modal-body">
                    <div class="view-order-data">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editOrderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editOrderLabel">Update Order Details</h1>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <input type="hidden" id="order_id" name="order_id">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="client_id" class="col-form-label">Client ID</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" id="client_id" class="form-control" name="client_id">
                            </div>
                            <div class="col-md-2">
                                <label for="client_id" class="col-form-label" >MOR ID</label>
                            </div>  
                            <div class="col-md-4">
                                <input type="number" id="modeofreceiving_id" class="form-control" name="modeofreceiving_id">
                            </div>
                        </div>
                        <div class="row mb-3">
                        <div class="col-md-2">
                                <label for="order_status" class="col-form-label">Order Status</label>
                            </div>
                            <div class="col-md-4">
                                <select name="order_status" id="order_status" class="form-control">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="On Delivery">On Delivery</option>
                                    <option value="Ready For Pick-up">Ready For Pick-up</option>
                                    <option value="Complete">Complete</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="payment_status" class="col-form-label">Payment Status</label>
                            </div>
                            <div class="col-md-4">
                                <select name="payment_status" id="payment_status" class="form-control">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Downpayment">Downpayment</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                        <div class="col-md-2">
                                <label for="priceID" class="col-form-label">Total Price</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" min="1" class="form-control" id="priceID" step="any" name="total_price">
                            </div>
                            <div class="col-md-2">
                                <label for="order_date" class="col-form-label">Date Ordered</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="order_date" id="order_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="fulfillment_date" class="col-form-label">Fulfillment Date</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="fulfillment_date" id="fulfillment_date" class="form-control">
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
                        <h4 class="text-left float-start p-3">ORDER MANAGEMENT</h4>
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
                                            <!-- <option value="nearest-due" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == "nearest-due") {
                                                                                echo 'selected';
                                                                            } ?>>Lowest Price</option>
                                            <option value="lowest-price-first" <?php if (isset($_GET['sortOrder']) && $_GET['sortOrder'] == "lowest-price-first") {
                                                                                echo 'selected';
                                                                            } ?>>Lowest Price</option> -->
                                        </select>
                                        <button class="input-group-text btn-filter" type="submit" id="basic-addon2"><i class="fa fa-filter" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary float-start mt-3 mb-3 ordercss" data-bs-toggle="modal" data-bs-target="#addOrder">
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
                                    <th scope="col">Client ID</th>
                                    <th scope="col">MOR ID</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Fulfillment Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $connection = mysqli_connect("localhost", "root", "", "ken_poms");
                                if(isset($_GET['sortOrder'])){
                                    if($_GET['sortOrder'] == 'most-recent-first'){
                                        $sort_option = 'DESC';
                                        $order_by = 'order_date';
                                    } else if($_GET['sortOrder'] == 'oldest-first'){
                                        $sort_option = 'ASC';
                                        $order_by = 'order_date';
                                    } else if($_GET['sortOrder'] == 'highest-price-first'){
                                        $sort_option = 'DESC';
                                        $order_by = 'total_price';
                                    } else if($_GET['sortOrder'] == 'lowest-price-first'){
                                        $sort_option = 'ASC';
                                        $order_by = 'total_price';
                                    }
                                }
                                
                                if(empty($_GET['sortOrder']) || $_GET['sortOrder'] == 'default'){
                                    @$fetch_query = "SELECT * FROM `order`";
                                } else {
                                    @$fetch_query = "SELECT * FROM `order` ORDER BY $order_by $sort_option";
                                }

                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                if (mysqli_num_rows($fetch_query_run) > 0) {
                                    while ($row =  mysqli_fetch_array($fetch_query_run)) {
                                ?>
                                        <tr>
                                            <th scope="row" class="order-id"> <?php echo $row['order_id']; ?> </t>
                                            <td> <?php echo $row['client_id']; ?> </td>
                                            <td> <?php echo $row['modeofreceiving_id']; ?> </td>
                                            <td> <?php echo $row['order_status']; ?> </td>
                                            <td> <?php echo $row['payment_status']; ?> </td>
                                            <td> <?php echo $row['total_price']; ?> </td>
                                            <td> <?php echo $row['order_date']; ?> </td>
                                            <td> <?php echo $row['fulfillment_date']; ?> </td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm text-white view-order ordercss" data-bs-toggle="modal" data-bs-target="#viewOrder">
                                                    <i class="lni lni-eye"></i> VIEW</button>
                                                <button type="button" class="btn btn-success btn-sm edit-order ordercss" data-bs-toggle="modal" data-bs-target="#editOrder">
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
                                        <td colspan="8">No Record Found</td>
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