<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    if (isset($_POST["verify_email"]))
    {
        $timestamp = date('Y-m-d H:i:s');
        $email = $_POST["email"];
        $verification_code = $_POST["verification_code"];
        $sql = "UPDATE tbl_admin_verify SET verification_date = '$timestamp' WHERE verified_email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
        $result  = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) == 0)
        {
            header("Location: verify-account?errorMsg=Verification code failed.");
        }
        else{
            header("Location: admin-account?msg=Account Updated Successfully!");
            exit();
        }
    }
    $conn->close();
?>
<?php
  //CSS Links and HTML Header
  include '../../../assets/config/admin/database_management/admin_header.php';
?>
    <!--Webpage Title-->
    <title>Verify Admin</title>
<!--Sidebar Config-->
<?php
  include '../../../assets/config/admin/database_management/admin_sidebar.php';
?>
    <!--Admin Navbar-->
    <section class="home-section">
      <div class="home-content">
        <i class='bx bx-menu' ></i>
        <div class="container-fluid w-100">
            <div class="home-content-title d-flex flex-wrap align-items-center justify-content-between">
                <span class="text">Database Management</span>
                <span class="me-5 fs-5 fw-semibold"><i class="fs-4 me-2 fa-solid fa-user-tie"></i><?php echo $_SESSION['lastname']; ?></span>
            </div>
        </div>
      </div>
    </section>
    <div class="container-section">
        <!--Current page of admin indicator-->
        <?php
            if(isset($_GET['msg'])) 
            {
                $msg = $_GET['msg'];
                echo '<div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
                        '.$msg.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
            else if(isset($_GET['errorMsg'])){
                $errorMsg = $_GET['errorMsg'];
                echo '<div class="alert alert-warning alert-dismissible fade show fw-bold" role="alert">
                        '.$errorMsg.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
            else if(isset($_GET['msgDel']))
            {
                $msgDel = $_GET['msgDel'];
                echo '<div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
                        '.$msgDel.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        ?>
      <div class="text">Verify Email</div>
            <nav class="mb-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="admin-account">Admin Settings</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="admin-account">Add Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verify</li>
                </ol>
            </nav>
            <!--This is where the admin will input the verification code-->
            <form method="POST">
                <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="verification_code" class="form-control w-50" placeholder="Enter verification code" aria-label="Verification Code" required>
                    </div>
                </div>
                <button type="submit" name="verify_email" value="Verify Email" class="btn btn-dark">Verify Email</button>
            </form>
        </div>
    </div>
<!--JS Scripts and HTML Footer-->
<?php
  include '../../../assets/config/admin/database_management/admin_scripts.php';
  include '../../../assets/config/admin/footer.php';
?>