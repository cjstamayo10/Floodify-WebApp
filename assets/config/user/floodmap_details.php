<?php
    //Hide Warnings
    error_reporting(E_ALL ^ E_WARNING);
    
    //Import Weather Forecast API
    require_once '../db_conn/config.php';
    //Get the ID of specific info
    $id = $_GET['details_id'];
    //Display the data of specific ID
    $fetch_data = "SELECT * FROM `tbl_floodmap` WHERE flood_map_id = $id";
    $fetch_result = mysqli_query($conn, $fetch_data);
    $tbl_row = mysqli_fetch_assoc($fetch_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../../img/floodify-logo.png">
    <link rel="stylesheet" href="../../../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>User Access</title>
</head>
<body>
    <!--Navigation Panel for User Access-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container">
            <div class="logo">
                <a class="navbar-brand" href="../../../index.php">
                    <img src="../../img/floodify-logo.png" alt="Floodify" width="auto" height="50px">
                </a>
            </div>
            <div class="nav-btn-responsive">
                <div class="btn-container">
                    <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                        <span class="text-center"><i class="fs-4 fa-solid fa-bars"></i></span>
                    </button>
                </div>
                <div class="transition offcanvas-lg offcanvas-end" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                    <div class="offcanvas-header shadow-sm">
                        <div class="offcanvas-title" id="offcanvasResponsiveLabel">
                            <a class="navbar-brand" href="../../../index.php">
                                <img src="../../img/floodify-logo.png" alt="Floodify Logo" width="auto" height="50px">
                            </a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="navigation-links">
                            <ul class="navbar-nav fs-5">
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase fw-bold" href="../../../index.php" role="button" aria-expanded="false">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-uppercase dropdown-toggle fw-bold active-color" href="../../../frm_user.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        User
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../../../frm_user.php#message_management" data-nav-section="live_chat">Live Chat</a></li>
                                        <li><a class="dropdown-item" href="../../../frm_user.php#request_data" data-nav-section="request_data">Request Data</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-uppercase fw-bold dropdown-toggle" href="../../../frm_admin_login.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Admin
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../../../frm_admin_login.php">Admin Login</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase fw-bold" href="../../../frm_admin_login.php" role="button" aria-expanded="false">
                                        Database Management
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--Flood Map-->
    <div class="flood-map p-5">
        <div class="container">
            <nav class="mb-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-dark text-uppercase" href="../../../index.php">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $tbl_row['flood_map_title']?></li>
                </ol>
            </nav>
            <div class="map-risk-container">
                <div class="flood-map-container w-100 mb-4 d-flex flex-wrap flex-row align-items-center justify-content-center">
                    <div class="flood-map-img text-center mb-3">
                        <img src="../../img/flood_map/<?php echo $tbl_row['flood_map_img'] ?>" alt="Flood Map Image" width="100%" height="400px">
                    </div>
                </div>
                <div class="flood-map-date">
                    <?php 
                        echo date('D, d M Y | g:i A', strtotime($tbl_row ['creation_date'])); 
                    ?>
                </div>
                <div class="flood-map-title fw-bold fs-5 mb-2">
                    <?php echo $tbl_row['flood_map_title'] ?>
                </div>
                <div class="flood-map-content">
                    <?php echo $tbl_row['flood_map_details'] ?>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-->
    <div class="footer p-5">
        <div class="container">
            <div class="footer-container d-flex flex-wrap flex-row align-items-baseline justify-content-between">
                <div class="footer-content mb-4">
                    <div class="logo">
                        <a class="navbar-brand" href="home">
                            <img src="../../img/floodify-logo-white.png" alt="Floodify Logo" width="auto" height="50px">
                        </a>
                    </div>
                </div>
                <div class="footer-content mb-4 text-center">
                    <div class="references-title fs-6 fw-medium text-uppercase">References</div>
                    <div class="references-link">
                        <a class="text-decoration-none text-white" href=""><span class="hover-content">Click Here</span></a>
                    </div>
                </div>
                <div class="footer-content mb-4">
                    <div class="social-links-container text-center">
                        <div class="social-links-title fs-6 fw-medium text-uppercase">Contact Us</div>
                        <div class="social-links">
                            <a class="text-decoration-none text-white fs-5 mx-1" href=""><span class="hover-img"><i class="fa-brands fa-facebook"></i></span></a>
                            <a class="text-decoration-none text-white fs-5 mx-1" href=""><span class="hover-img"><i class="fa-solid fa-envelope"></i></span></a>
                        </div>
                    </div>
                </div>
                <div class="footer-content mb-4 w-50">
                    <div class="about-us">
                        <div class="about-us-title fs-6 fw-medium text-uppercase">About Us</div>
                        <div class="about-us-content text-break">
                            FLOODIFY’s purpose is to raise flood awareness among
                            Malabon residents. The Web App will include daily, 3-hour, and 5-day
                            weather predictions, as well as a live radar of Malabon City.
                            It will also show data analytics of flood-prone locations, which will be
                            shown on a flood map, as well as safety guides that may assist local
                            society people in avoiding spots with a high risk of flooding.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--JS Scripts-->
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>