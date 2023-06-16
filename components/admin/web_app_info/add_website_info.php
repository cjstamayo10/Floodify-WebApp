<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    if(isset($_POST["add_btn"]))
    {
        $timestamp = date('Y-m-d H:i:s');
        $website_name = $_POST["website_name"];
        $telephone_number = $_POST["telephone_number"];
        $cellphone_number = $_POST["cellphone_number"];
        $fb_page = $_POST["fb_page"];
        $email = $_POST["email"];
        $sql = "INSERT INTO `tbl_website_info`(`website_name`, `website_tell_num`, `website_cell_num`, `website_fb_page`, `website_email`, `creation_date`) VALUES ('$website_name','$telephone_number','$cellphone_number','$fb_page','$email','$timestamp')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            header("Location: web-app-info?msg=Information Added Successfully!");
        }
    }
    $conn->close();
?>