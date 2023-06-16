<?php
    session_start();
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    if (!isset($_SESSION['lastname'])) {
        header('location: admin-login');
    }
    $id = $_GET['user_id'];
    $fetch_data = "SELECT * FROM tbl_admin, tbl_admin_verify WHERE tbl_admin.verified_id = tbl_admin_verify.verified_id AND tbl_admin.admin_id = ?";
    $stmt = $conn->prepare($fetch_data);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $fetch_result = $stmt->get_result();
    $tbl_row = mysqli_fetch_assoc($fetch_result);
    $stmt->close();
    $timestamp = date('Y-m-d H:i:s');
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $verification_code = $_POST['verification_code'];
    $password = $_POST["password"];
    if (isset($_POST['update_btn'])) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE `tbl_admin` SET `admin_id`=?,`last_name`=?,`first_name`=?,`middle_name`=?, `date_updated` = ? WHERE admin_id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("issssi", $id, $last_name, $first_name, $middle_name, $timestamp, $id);
        $update_result = $stmt->execute();
        $stmt->close();
        if ($update_result) {
            $update_email = "UPDATE `tbl_admin_verify` SET `verified_id`=?,`verified_email`=?,`verification_code`=?,`password`=? WHERE verified_id = ?";
            $stmt = $conn->prepare($update_email);
            $stmt->bind_param("isssi", $id, $email, $verification_code, $hashed_password, $id);
            $update_email_result = $stmt->execute();
            $stmt->close();
            if ($update_email_result) {
                header("Location: admin-account?msg=Account Updated Successfully!");
            }
        }
        else {
            header("Location: admin-account?errorMsg=Account Updating Failed.");
        }
    }
    else {
        header("Location admin-account?errorMsg=Unknown Error Occured. Please try again.");
    }
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require '../../../vendor/phpmailer/vendor/autoload.php';
    if(isset($_POST['verify_btn'])) {
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'floodify.webapp@gmail.com';
            $mail->Password = 'thuytkawwkyfvrzf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('floodify.webapp@gmail.com', 'Admin Floodify');
            $mail->addAddress($email, $first_name, $last_name);
            $mail->isHTML(true);
            $new_verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $mail->Subject = 'Email Verification for Admin Account';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $new_verification_code . '</b></p>';
            $mail->send();
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE `tbl_admin_verify` SET `verified_id`=?,`verified_email`=?,`password`=?,`verification_code`=? WHERE verified_id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("isssi", $id, $email, $hashed_password, $new_verification_code, $id);
            $update_result = $stmt->execute();
            $update_email = "UPDATE `tbl_admin` SET `admin_id`=?,`last_name`=?,`first_name`=?,`middle_name`=?, `date_updated` = ? WHERE admin_id = ?";
            $stmt = $conn->prepare($update_email);
            $stmt->bind_param("issssi", $id, $last_name, $first_name, $middle_name, $timestamp, $id);
            $update_email_result = $stmt->execute();
            if ($update_email_result) {
                header("Location: verify-account?email=".$email);
                exit();
            }
        } catch (Exception $e) {
            header("Location: admin-account?errorMsg=Message could not be sent.");
        }
    }
    else {
        header("Location admin-account?errorMsg=Unknown Error Occured. Please try again.");
    }
    // Close Database Connection.
    $conn->close();
?>
<?php 
  //CSS Links and HTML Header
  include '../../../assets/config/admin/database_management/admin_header.php';
?>
    <!--Webpage Title-->
    <title>Update Admin</title>
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
    <!--Container-->
    <div class="container-section">
        <!--Current page of admin indicator-->
      <div class="text">Update Account</div>
      <nav class="mb-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="admin-account">Admin Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
        </nav>
        <div class="bg-body-tertiary shadow-sm border p-5 rounded">
            <!--Selected Information from the table displays here-->
            <form method="POST">
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="first_name" class="form-control" value="<?php echo $tbl_row['first_name']?>" aria-label="First name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="middle_name" class="form-control" value="<?php echo $tbl_row['middle_name']?>" aria-label="Middle name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="last_name" class="form-control" value="<?php echo $tbl_row['last_name']?>" aria-label="Last name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="email" name="email" readonly class="form-control" value="<?php echo $tbl_row['verified_email']?>" aria-label="Email" required>
                    </div>
                </div>
                <input type="hidden" name="verification_code" readonly class="form-control" value="<?php echo $tbl_row['verification_code']?>" aria-label="Verification Code" required>
                <div class="row mb-3">
                    <div class="col">
                        <input type="password" name="password" class="form-control" value="<?php echo $tbl_row['password']?>" aria-label="Password" required>
                    </div>
                </div>
                <!--Update Confirmation-->
                <div class="modal fade" id="update_account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Update Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure do you want to update <span class="fw-bold"><?php echo $tbl_row['verified_email']?></span>'s information?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="update_btn" value="update_btn" class="btn btn-dark">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Update Confirmation-->
                <div class="modal fade" id="verify_account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Update Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure do you want to verify <span class="fw-bold"><?php echo $tbl_row['verified_email']?></span>'s information again?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">No</button>
                                <button type="submit" name="verify_btn" value="verify_btn" class="btn btn-dark">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--Update Information Btn-->
            <div class="d-flex align-items-center justify-content-end">
                <button type="button" class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#update_account">
                    Update Details
                </button>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#verify_account">
                    Re-Verify Email
                </button>
            </div>
        </div>
    </div>
<!--JS Scripts and HTML Footer-->
<?php
  include '../../../assets/config/admin/database_management/admin_scripts.php';
  include '../../../assets/config/admin/footer.php';
?>