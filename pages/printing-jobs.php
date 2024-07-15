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
                        <h4 class="text-left float-start p-3">PRINT ORDER MANAGEMENT</h4>
                        <!-- Button trigger modal -->
                        <div class="btn-group m-3 float-end">
                            <button type="button" class="btn btn-primary ordercss" data-bs-toggle="modal" data-bs-target="#addOrder">
                                <i class="lni lni-plus"></i> ADD</button>
                            <button type="button" class="btn btn-secondary ordercss" data-bs-toggle="modal" data-bs-target="#">
                                <i class="lni lni-funnel"></i>FILTERS</button>



                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-warning table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Client ID</th>
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

                                $fetch_query = "SELECT * FROM orders";
                                $fetch_query_run = mysqli_query($connection, $fetch_query);

                                if (mysqli_num_rows($fetch_query_run) > 0) {
                                    while ($row =  mysqli_fetch_array($fetch_query_run)) {
                                ?>
                                        <tr>
                                            <th scope="row" class="order-id"> <?php echo $row['order_id']; ?> </t>
                                            <td> <?php echo $row['client_id']; ?> </td>
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