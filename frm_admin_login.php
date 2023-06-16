<?php
    session_start();
    require_once './assets/config/db_conn/config.php';
    if(isset($_SESSION['attempt_again']) && time() >= $_SESSION['attempt_again']) {
        unset($_SESSION['attempt'], $_SESSION['attempt_again']);
    }
    $_SESSION['attempt'] = $_SESSION['attempt'] ?? 0;
    $disabled = $countdown = '';
    if($_SESSION['attempt'] == 3) {
        $disabled = 'disabled';
        $countdown = '<span id="countdown">10</span> seconds';
        $_SESSION['error'] = 'Attempt limit reached.<br>Try again after '.$countdown.'<br>';
    } elseif(isset($_POST['admin_login'])) {
        $email = mysqli_real_escape_string($conn , $_POST['email']);
        $password = $_POST['password'];
        $check_email = "SELECT * FROM tbl_admin_verify WHERE verified_email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $row_count = mysqli_num_rows($stmt->get_result());
        if($row_count > 0) {
            $verify_login = "SELECT tbl_admin.admin_id, tbl_admin.last_name, tbl_admin.first_name, tbl_admin.middle_name, tbl_admin_verify.verified_email, tbl_admin_verify.password, tbl_admin_verify.verification_date FROM tbl_admin_verify, tbl_admin WHERE tbl_admin.admin_id = tbl_admin_verify.verified_id AND verified_email = ?";
            $stmt = $conn->prepare($verify_login);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $password_true = $row['password'];
                $verification_date = $row['verification_date'];
                if($verification_date != '0000-00-00 00:00:00.000000' && password_verify($password, $password_true)) {
                    $_SESSION['lastname'] = $row['last_name'];
                    unset($_SESSION['attempt']);
                    header("Location: dashboard");
                    exit;
                } else {
                    $_SESSION['attempt']++;
                    if($_SESSION['attempt'] == 3) {
                        $_SESSION['attempt_again'] = time() + 10;
                        $disabled = 'disabled';
                        $countdown = '<span id="countdown">10</span> seconds';
                    }
                    header("Location: admin-login?msg=Incorrect Login Credentials");
                }
            }
        }
        else{
            header("Location: admin-login?msg=Incorrect Login Credentials");
            $_SESSION['attempt']++;
            if($_SESSION['attempt'] == 3) {
                $_SESSION['attempt_again'] = time() + 10;
                $disabled = 'disabled';
                $countdown = '<span id="countdown">10</span> seconds';
            }
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="./assets/img/floodify-logo.png">
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/admin.css">
    <title>Admin Login</title>
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
                            <a class="navbar-brand" href="index.php">
                                <img src="./assets/img/floodify-logo.png" alt="Floodify" width="auto" height="50px">
                            </a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="navigation-links">
                            <ul class="navbar-nav fs-5">
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase fw-bold" href="home" role="button" aria-expanded="false">
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
                                    <a class="nav-link text-uppercase fw-bold dropdown-toggle active-color" href="admin-login" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    <div class="login-container">
        <div class="form-container shadow border border-2 rounded">
            <div class="form-img" style="background-image: url('./assets/img/malabon-cityhall.png');"></div>
            <div class="form">
                <div class="form-input-container d-flex flex-column">
                    <div class="error w-100">
                        <?php
                            if(isset($_GET['msg'])) 
                            {
                                $msg = $_GET['msg'];
                                if($_SESSION['attempt']==1 || $_SESSION['attempt']==2 || $_SESSION['attempt']==3){
                                    echo '<div class="alert alert-warning alert-dismissible fade show fw-bold" role="alert">
                                            '.$msg.'.<br>Attempts: '.$_SESSION['attempt'].'
                                        </div>';
                                }
                                else{
                                    echo '<div class="alert alert-warning alert-dismissible fade show fw-bold" role="alert">
                                            '.$msg.'.<br>Attempts: '.$_SESSION['attempt'].'
                                        </div>';
                                }
                            }
                        ?>
                    </div>
                    <div class="form-input-title">
                        <span class="bold-text">Administrator</span> Access
                    </div> 
                    <div class="input-container">
                        <form method="post">
                            <div class="input-content">
                                <input type="email" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="input-content">
                                <input type="password" name="password" placeholder="Your Password" required>
                            </div>
                            <div class="form-btn w-100 h-100 d-flex flex-row flex-wrap align-items-center justify-content-between">
                                <div class="form-btn-container d-flex flex-column">
                                    <?php 
                                        if(isset($_SESSION['error']))
                                        {
                                            echo '<div class="error-padding alert alert-warning alert-dismissible fade show fw-bold" role="alert">
                                                    <br>'.$_SESSION['error'].'
                                                </div>';
                                            unset($_SESSION['error']);
                                        } 
                                        else
                                        {
                                    ?>
                                        <button type="submit" name="admin_login">Login</button>
                                    <?php
                                        }
                                    ?>
                                </div> 
                                <div class="link">
                                    <a href="./index.php">Go to site</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--JS Scripts-->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        var countdown = document.getElementById("countdown");
        var timer;
        function startCountdown() {
        var timeLeft = parseInt(countdown.innerHTML);
            timer = setInterval(function() {
                timeLeft--;
                countdown.innerHTML = timeLeft;
                if (timeLeft <= 0) {
                clearInterval(timer);
                window.location.href = "admin-login";
                }
            }, 1000);
        }
        startCountdown();
    </script>
</body>
</html>