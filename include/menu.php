<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo app('short_name'); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline mt-1">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search menu" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='dashboard'){echo 'active';} ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                    </a>
                </li>
                <?php if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=="admin"){ ?>
                    <li class="nav-item <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='add-admin' || $_SESSION['active_menu']=='manage-admin'){echo 'menu-open';} ?>">
                        <a href="#" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='add-admin' || $_SESSION['active_menu']=='manage-admin'){echo 'active';} ?>">
                            <i class="nav-icon fas fa-user"></i><p>Admin<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add-admin.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='add-admin'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Add Admin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage-admin.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='manage-admin'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Manage Admin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='add-doctor' || $_SESSION['active_menu']=='manage-doctor' || $_SESSION['active_menu']=='doctor-specilization'){echo 'menu-open';} ?>">
                        <a href="#" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='add-doctor' || $_SESSION['active_menu']=='manage-doctor' || $_SESSION['active_menu']=='doctor-specilization'){echo 'active';} ?>">
                            <i class="nav-icon fas fa-user"></i><p>Doctors<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add-doctor.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='add-doctor'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Add Doctor</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage-doctor.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='manage-doctor'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Manage Doctor</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="doctor-specialization.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='doctor-specilization'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Doctor Specialization</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=="admin" || $_SESSION['user_details']['role']=="doctor"){ ?>
                    <li class="nav-item <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='add-patient' || $_SESSION['active_menu']=='manage-patient' || $_SESSION['active_menu']=='patient-search'){echo 'menu-open';} ?>">
                        <a href="#" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='add-patient' || $_SESSION['active_menu']=='manage-patient' || $_SESSION['active_menu']=='patient-search'){echo 'active';} ?>">
                            <i class="nav-icon fas fa-user"></i><p>Patient<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="add-patient.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='add-patient'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Add Patient</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manage-patient.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='manage-patient'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Manage Patient</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="patient-search.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='patient-search'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Search Patient</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='book-appointment' || $_SESSION['active_menu']=='appointment-history'){echo 'menu-open';} ?>">
                    <a href="#" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='book-appointment' || $_SESSION['active_menu']=='appointment-history'){echo 'active';} ?>">
                        <i class="nav-icon fas fa-file"></i><p>Appointment<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if(isset($_SESSION['user_details']) && $_SESSION['user_details']['role']=='patient'){ ?>
                            <li class="nav-item">
                                <a href="book-appointment.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='book-appointment'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Book Appointment</p>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="appointment-history.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='appointment-history'){echo 'active';} ?>">
                                <i class="far fa-circle nav-icon"></i><p>Appointment History</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=="patient"){ ?>
                    <li class="nav-item">
                        <a href="medical-history.php" class="nav-link" <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='medical-history'){echo 'active';} ?>>
                            <i class="nav-icon fas fa-file"></i><p>Medical History</p>
                        </a>
                    </li>
                <?php } ?>
                <?php if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=="admin"){ ?>
                    <li class="nav-item">
                        <a href="between-dates-reports.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='between-dates-reports'){echo 'active';} ?>">
                            <i class="nav-icon fas fa-file"></i><p>B/w dates reports</p>
                        </a>
                    </li>
                    <li class="nav-item <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='unread-queries' || $_SESSION['active_menu']=='read-query'){echo 'menu-open';} ?>">
                        <a href="#" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='unread-queries' || $_SESSION['active_menu']=='read-query'){echo 'active';} ?>">
                            <i class="nav-icon fas fa-file"></i><p>Contact us Queries<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="unread-queries.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='unread-queries'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Unread Query</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="read-query.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='read-query'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Read Query</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='doctor-logs' || $_SESSION['active_menu']=='user-logs'){echo 'menu-open';} ?>">
                        <a href="#" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='doctor-logs' || $_SESSION['active_menu']=='user-logs'){echo 'active';} ?>">
                            <i class="nav-icon fas fa-record-vinyl"></i><p>Session Logs<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="doctor-logs.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='doctor-logs'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Doctors</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="user-logs.php" class="nav-link <?php if(isset($_SESSION['active_menu']) && $_SESSION['active_menu']=='user-logs.php'){echo 'active';} ?>">
                                    <i class="far fa-circle nav-icon"></i><p>Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>