<div class="sidebar app-aside" id="sidebar">
    <div class="sidebar-container perfect-scrollbar" style="background-color: white;">
        <nav>
            <!-- start: MAIN NAVIGATION MENU -->
            <ul class="main-navigation-menu" style="margin: 0;">
                <li <?php if(isset($active_menu) && $active_menu=='dashboard'){echo 'class="active"';} ?>>
                    <a href="dashboard.php">
                        <div class="item-content">
                            <div class="item-media"><i class="ti-home"></i></div>
                            <div class="item-inner"><span class="title"> Dashboard <? echo $user_details['role']; ?> </span></div>
                        </div>
                    </a>
                </li>
                <?php if(isset($user_details['role']) && $user_details['role']=="admin"){ ?>
                    <li>
                        <a href="javascript:void(0)">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-user"></i></div>
                                <div class="item-inner"><span class="title"> Doctors </span><i class="icon-arrow"></i></div>
                            </div>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="doctor-specilization.php"><span class="title"> Doctor Specialization </span></a></li>
                            <li><a href="add-doctor.php"><span class="title"> Add Doctor</span></a></li>
                            <li><a href="Manage-doctors.php"><span class="title"> Manage Doctors </span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-user"></i></div>
                                <div class="item-inner"><span class="title"> Users </span><i class="icon-arrow"></i></div>
                            </div>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="manage-users.php"><span class="title"> Manage Users </span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-user"></i></div>
                                <div class="item-inner"><span class="title"> Patients </span><i class="icon-arrow"></i></div>
                            </div>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="manage-patient.php"><span class="title"> Manage Patients </span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="appointment-history.php">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-file"></i></div>
                                <div class="item-inner"><span class="title"> Appointment History </span></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-files"></i></div>
                                <div class="item-inner"><span class="title"> Conatctus Queries </span><i class="icon-arrow"></i></div>
                            </div>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="unread-queries.php"><span class="title"> Unread Query </span></a></li>
                            <li><a href="read-query.php"><span class="title"> Read Query </span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="doctor-logs.php">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-list"></i></div>
                                <div class="item-inner"><span class="title"> Doctor Session Logs </span></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="user-logs.php">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-list"></i></div>
                                <div class="item-inner"><span class="title"> User Session Logs </span></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-files"></i></div>
                                <div class="item-inner"><span class="title"> Reports </span><i class="icon-arrow"></i></div>
                            </div>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="between-dates-reports.php"><span class="title">B/w dates reports </span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="patient-search.php">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-search"></i></div>
                                <div class="item-inner"><span class="title"> Patient Search </span></div>
                            </div>
                        </a>
                    </li>
                <?php }else if(isset($user_details['role']) && $user_details['role']=="doctor"){ ?>
                    <li>
                        <a href="appointment-history.php">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-list"></i></div>
                                <div class="item-inner"><span class="title"> Appointment History </span></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-user"></i></div>
                                <div class="item-inner"><span class="title"> Patients </span><i class="icon-arrow"></i></div>
                            </div>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="add-patient.php"><span class="title"> Add Patient</span></a></li>
                            <li><a href="manage-patient.php"><span class="title"> Manage Patient </span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="search.php">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-search"></i></div>
                                <div class="item-inner"><span class="title"> Search </span></div>
                            </div>
                        </a>
                    </li>
                <?php }else if(isset($user_details['role']) && $user_details['role']=="patient"){ ?>
                    <li <?php if(isset($active_menu) && $active_menu=='book_appointment'){echo 'class="active"';} ?>>
                        <a href="book-appointment.php">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-pencil-alt"></i></div>
                                <div class="item-inner"><span class="title"> Book Appointment </span></div>
                            </div>
                        </a>
                    </li>
                    <li <?php if(isset($active_menu) && $active_menu=='appointment_history'){echo 'class="active"';} ?>>
                        <a href="appointment-history.php">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-list"></i></div>
                                <div class="item-inner"><span class="title"> Appointment History </span></div>
                            </div>
                        </a>
                    </li>
                    <li <?php if(isset($active_menu) && $active_menu=='medical_history'){echo 'class="active"';} ?>>
                        <a href="manage-medhistory.php">
                            <div class="item-content">
                                <div class="item-media"><i class="ti-list"></i></div>
                                <div class="item-inner"><span class="title"> Medical History </span></div>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <!-- end: CORE FEATURES -->
        </nav>
    </div>
</div>