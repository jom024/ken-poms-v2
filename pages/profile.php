<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Employee Profile</h2>
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

    <div class="profile-container">
        <div class="profile-header">
            <img src="images/account.png" alt="Profile Picture">
            <h2>January Toledo</h2>
            <p>Employee</p>
        </div>
        <div class="profile-details">
            <h3>Personal Information</h3>
            <p class="ms-3"><strong>Email:</strong> <span id="email">jtoledo@example.com</span></p>
            <p class="ms-3"><strong>Phone:</strong> <span id="phone">09999999999</span></p>
            <p class="ms-3"><strong>Address:</strong> <span id="address">Talamban, USC</span></p>
        </div>
        <div class="account-details">
            <h3>Account Details</h3>
            <p class="ms-3"><strong>Username:</strong> <span id="usern">January</span></p>
            <p class="ms-3"><strong>Member Since:</strong> January 1, 2020</p>
        </div>
        <div class="account-settings">
            <h3>Account Settings</h3>
            <div class="btn-container">
                <button id="edit-profile-btn" class="btn-primary">Edit Profile</button>
                <button id="save-profile-btn" class="btn-primary" style="display: none;">Save Profile</button>
                <button class="btn-danger">Logout</button>
            </div>
        </div>
    </div>
</div>
<script src="script.js"></script>
<script src="profjs.js"></script>