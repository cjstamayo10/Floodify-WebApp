<?php
    require_once './assets/config/db_conn/index_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="./assets/img/floodify-logo.png">
    <script type="text/javascript" src="./vendor/mapbox/mapbox-gl.js"></script>
    <link href="./vendor/mapbox/mapbox-gl.css" rel="stylesheet"/>
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Floodify | Home</title>
</head>
<body>
    <!--Navigation Panel for User Access-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom shadow-sm">
        <div class="container">
            <div class="logo">
                <a class="navbar-brand" href="https://floodify.infinityfreeapp.com">
                    <img src="./assets/img/floodify-logo.png" alt="Floodify" width="auto" height="50px">
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
                            <a class="navbar-brand" href="#">
                                <img src="./assets/img/floodify-logo.png" alt="Floodify" width="auto" height="50px">
                            </a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="navigation-links">
                            <ul class="navbar-nav fs-5">
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase fw-bold active-color" href="home" role="button" aria-expanded="false">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-uppercase fw-bold dropdown-toggle" href="user-access" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        User
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="user-access#message_management" data-nav-section="live_chat">Live Chat</a></li>
                                        <li><a class="dropdown-item" href="user-access#request_data" data-nav-section="request_data">Request Data</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-uppercase fw-bold dropdown-toggle" href="admin-login" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Admin
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="admin-login">Admin Login</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase fw-bold" href="dashboard" role="button" aria-expanded="false">
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
    <!--Home Page Information-->
    <div class="hero-bg py-5 d-flex flex-wrap align-items-center">
        <div class="container">
            <div class="home-page-container w-100 d-flex flex-row flex-wrap align-items-center justify-content-center">
                <div class="home-container d-flex flex-column align-items-center w-100 h-100 justify-content-center mb-4">
                    <div class="fs-1 fw-bold mb-4 text-center">
                        Floodify: A Web Application Flood Monitoring System with Data Analytics for Malabon City
                    </div>
                    <div class="about-container mb-4">
                        <div class="about-content text-center px-5 fs-6">
                            FLOODIFY’s purpose is to raise flood awareness among
                            Malabon residents. The Web App will include current, daily, and 5-day
                            weather predictions, as well as a live rain radar in Malabon City.
                            It will also show data of flood-prone locations, which will be
                            shown on a flood map, as well as flood risk that may assist local
                            society people in avoiding spots with a high risk of flooding.
                        </div>
                    </div>
                    <div class="img-container">
                        <img src="./assets/img/cmu-logo.png" alt="Floodify" width="auto" height="50px">
                        <img src="./assets/img/ccs-logo.png" alt="Floodify" width="auto" height="50px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include './assets/config/user/user_footer.php';
    ?>
    <!--JS Scripts-->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>