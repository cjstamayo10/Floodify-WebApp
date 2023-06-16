<?php
    session_start();
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require '../../../vendor/phpmailer/vendor/autoload.php';
    if(isset($_POST["add_btn"]))
    {
        $timestamp = date('Y-m-d H:i:s');
        $first_name = $_POST["first_name"];
        $middle_name = $_POST["middle_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        if($password == $confirm_password){
            $sql_verify = "SELECT * FROM tbl_admin_verify WHERE verified_email = '$email'";
            $email_verified = mysqli_query($conn,$sql_verify);
            $check_email = mysqli_num_rows($email_verified);
            if ($check_email > 0)
            {
                header("Location: admin-account?errorMsg=Email Already Exist.");
            }
            else
            {
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
                    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                    $mail->Subject = 'Email Verification for Admin Account';
                    $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
                    $mail->send();
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO tbl_admin_verify(verified_email, password, verification_code) VALUES ('" . $email . "', '" . $hashed_password . "', '" . $verification_code . "')";
                    $result = mysqli_query($conn, $sql);
                    if ($result){
                        $sql_view_id = "SELECT verified_id FROM tbl_admin_verify WHERE verified_email = '$email'";
                        $result_view = mysqli_query($conn, $sql_view_id);
                        if (mysqli_num_rows($result_view) > 0) {
                            $row = mysqli_fetch_assoc($result_view);
                            $admin_verified_id = $row["verified_id"];
                            $sql_add_details = "INSERT INTO tbl_admin (`verified_id`, `last_name`, `first_name`, `middle_name`, `creation_date`) VALUES ('$admin_verified_id', '$last_name', '$first_name', '$middle_name', '$timestamp')";
                            if (mysqli_query($conn, $sql_add_details)) {
                                header("Location: verify-account?email=".$email);
                                exit();
                            } else {
                                header("Location: admin-account?errorMsg=Trouble sending verification. Please try again.");
                            }
                        } else {
                            header("Location: admin-account?errorMsg=Error: tbl_admin_verify is empty");
                            exit();
                        }
                    }
                    
                } catch (Exception $e) {
                    header("Location: admin-account?errorMsg=Message could not be sent.");
                }
            }
        }
        else{
            header("Location: admin-account?errorMsg=Password not matched.");
        }
    }
    $conn->close();
?>