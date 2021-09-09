
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="contact.php" class="nav-link">Contact</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Blood Bank</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Shop</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!-- Profile Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
                <?php echo $_SESSION['user_details']['fullName']; ?>
                <i class="fa fa-angle-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                <a href="edit-profile.php" class="dropdown-item"><i class="fas fa-user mr-2"></i> Profile</a>
                <div class="dropdown-divider m-0"></div>
                <a href="change-password.php" class="dropdown-item"><i class="fas fa-lock mr-2"></i> Change Password</a>
                <div class="dropdown-divider m-0"></div>
                <a href="logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i> Log Out</a>
            </div>
        </li>
    </ul>
</nav>