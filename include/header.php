<?php
require_once __DIR__ . '/../include/config.php';
if (!isset($_SESSION['user_id'])) {
    // Redirect ke login jika belum login
    header('Location: signin.php');
    exit;
}

// Ambil data user dari session
$userFullName = $_SESSION['user_full_name'];
$userProfilePicture = $_SESSION['user_profile_picture'];
?>

<head>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css" />
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css" />
<link rel="stylesheet" href="../assets/css/style.css" />
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
<link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css" />
</head>

    <style>
        .header .header-left .active {
    background: linear-gradient(to bottom,rgb(10, 35, 61), #0e3259) !important;
    }
    </style>

<div class="header">
    <div class="header-left active">
        <a href="../Dashboard/index.php" class="logo">
            <img src="../assets/img/logo1.png" alt="" />
        </a>
        <a id="toggle_btn" href="javascript:void(0);" style="width: 30px; height: 30px; border-radius: 50%; background-color: #092c4c; display: flex; align-items: center; justify-content: center;">
        <img src="../assets/img/ikeamaskot.png" alt="toggle" style="width: 20px; height: 20px;" />
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">
        <!-- Language Dropdown -->
        <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
                <img src="../assets/img/flags/us1.png" alt="" height="20" />
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="../assets/img/flags/us.png" alt="" height="16" /> English
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="../assets/img/flags/id.png" alt="" height="16" /> Indonesian
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="../assets/img/flags/es.png" alt="" height="16" /> Spanish
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="../assets/img/flags/de.png" alt="" height="16" /> German
                </a>
            </div>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <img src="../assets/img/icons/notification-bing.svg" alt="img" />
                <span class="badge rounded-pill">4</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="../activities.php">
                                <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img alt="" src="../assets/img/profiles/avatar-02.jpg" />
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details">
                                            <span class="noti-title">John Doe</span> added new task
                                            <span class="noti-title">Patient appointment booking</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                    <a href="activities.php">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="../assets/img/profiles/avatar-03.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                          <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.php">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="../assets/img/profiles/avatar-06.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details">
                            <span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project
                            <span class="noti-title">Doctor available module</span>
                          </p>
                          <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.php">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="../assets/img/profiles/avatar-17.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
                          <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="notification-message">
                    <a href="activities.php">
                      <div class="media d-flex">
                        <span class="avatar flex-shrink-0">
                          <img alt="" src="../assets/img/profiles/avatar-13.jpg" />
                        </span>
                        <div class="media-body flex-grow-1">
                          <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
                          <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                        </div>
                      </div>
                    </a>
                  </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="../activities.php">View all Notifications</a>
                </div>
            </div>
        </li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img">
                <img src="../assets/img/profiles/<?= $userProfilePicture ?>" alt="<?= $userFullName ?>"/>
                    <span class="status online"></span>
                </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img">
                        <img src="../assets/img/profiles/<?= $userProfilePicture ?>" alt="<?= $userFullName ?>" />
                            <span class="status online"></span>
                        </span>
                        <div class="profilesets">
                            <h6><?= $userFullName ?></h6>
                            <h5>Member</h5>
                        </div>
                    </div>
                    <hr class="m-0" />
                    <a class="dropdown-item" href="../profile.php">
                        <i class="me-2" data-feather="user"></i> My Profile
                    </a>
                    <a class="dropdown-item" href="../generalsettings.php">
                        <i class="me-2" data-feather="settings"></i>Settings
                    </a>
                    <hr class="m-0" />
                    <a class="dropdown-item logout pb-0" href="../signin.php">
                        <img src="../assets/img/icons/log-out.svg" class="me-2" alt="img" />Logout
                    </a>
                </div>
            </div>
        </li>
    </ul>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
<script>
    feather.replace(); // Menginisialisasi Feather Icons
</script>
<script src="../assets/js/jquery.slimscroll.min.js"></script>
<script src="../assets/js/script.js"></script>

</div>