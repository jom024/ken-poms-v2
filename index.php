<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <?php

    if (isset($_GET['page'])) {
        @$page = $_GET['page'];
    }

    // If a page is set in the URL, use it
    if (isset($_GET['page']) && in_array($_GET['page'], ['dashboard', 'customers', 'orders', 'printing-jobs', 'settings', 'profile', 'delivery'])) {
        @$page = $_GET['page'];
    }

    // Include the corresponding CSS file if it exists
    echo '<link rel="stylesheet" href="css/' . @$page . '.css">';

    if (isset($_GET['sortOrder'])) {
        echo '<link rel="stylesheet" href="css/orders.css">';
    }
    ?>
    <title>POMS | Ken Printshoppe</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><img src="ken_logo2.png" alt="ken-logo" style="width: 30px; height: auto; margin-bottom: 2px; margin-right: 5px;"><span style="font-size: large;">Ken Printshoppe</span></div>
            <div class="list-group list-group-flush my-3">
                <a href="?page=dashboard" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?php echo (@$page == 'dashboard') ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="?page=customers" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?php echo (@$page == 'customers') ? 'active' : ''; ?>"><i class="fas fa-project-diagram me-2"></i>Customers</a>
                <a href="?page=delivery" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?php echo (@$page == 'delivery') ? 'active' : ''; ?>"><i class="fas fa-truck me-2"></i>Mode of Receiving</a>
                <a href="?page=orders" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?php echo (@$page == 'orders') ? 'active' : ''; ?>"><i class="fas fa-chart-line me-2"></i>Orders</a>
                <a href="?page=printing-jobs" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?php echo (@$page == 'printing-jobs') ? 'active' : ''; ?>"><i class="fas fa-paperclip me-2"></i>Printing Jobs</a>
                <a href="?page=payment" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?php echo (@$page == 'payment') ? 'active' : ''; ?>"><i class="fas fa-coins me-2"></i>Payment</a>
                <a href="?page=quotations" class="list-group-item list-group-item-action bg-transparent second-text fw-bold  <?php echo (@$page == 'quotations') ? 'active' : ''; ?>"><i class="far fa-clipboard me-2" ></i>Quotations</a>
                <a href="?page=particulars" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?php echo (@$page == 'particulars') ? 'active' : ''; ?>"><i class="fas fa-comment-dots me-2"></i>Particulars</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-map-marker-alt me-2"></i>Employees</a>
                <a href="login.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <?php

        if (@$page == 'dashboard' 
        || empty(@$page) && empty(@$GET['sortOrder'] )|| empty(@$page) && empty(@$GET['sortClient'] )) {
            include("pages/dashboard.php");
        } else
        if (
            @$page == 'orders' || @$_GET['sortOrder'] == 'most-recent-first'
            || @$_GET['sortOrder'] == 'oldest-first' || @$_GET['sortOrder'] == 'default'
            || @$_GET['sortOrder'] == 'highest-price-first' || @$_GET['sortOrder'] == 'lowest-price-first'
        ) {
            include("pages/orders.php");
        } else if (
            @$page == 'customers' || @$_GET['sortClient'] == 'a-z'
            || @$_GET['sortClient'] == 'z-a'
        ) {
            include("pages/customers.php");
        } else if (@$page == 'delivery') {
            include("pages/delivery.php");
        } else if (@$page == 'profile') {
            include("pages/profile.php");
        } else if (@$page == 'printing-jobs') {
            include("pages/printing-jobs.php");
        } else if (@$page == 'settings') {
            include("pages/settings.php");
        } else if (@$page == 'quotations') {
            include("pages/quotations.php");
        }

        ?>
        <!-- Page Content -->

        <!-- /#page-content-wrapper -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <?php
    if (
        @$page == 'orders' || @$_GET['sortOrder'] == 'most-recent-first'
        || @$_GET['sortOrder'] == 'oldest-first' || @$_GET['sortOrder'] == 'default'
        || @$_GET['sortOrder'] == 'highest-price-first' || @$_GET['sortOrder'] == 'lowest-price-first'
    ) {
        include("includes/footer_order.php");
    } else if (
        @$page == 'customers' || @$_GET['sortClient'] == 'a-z'
        || @$_GET['sortClient'] == 'z-a'
    ) {
        include("includes/footer_client.php");
    } else if (@$page == 'delivery') {
        include("includes/footer_mor.php");
    } else if (@$page == 'printing-jobs') {
        include("includes/footer_pj.php");
    } else if (@$page == 'quotations') {
        include("includes/footer_quo.php");
    }

    ?>

</body>

</html>