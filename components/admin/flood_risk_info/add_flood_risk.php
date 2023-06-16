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
        $flood_risk_title = $_POST['flood_risk_title'];
        $flood_risk_content = $_POST['flood_risk_content'];
        $sql = "INSERT INTO `tbl_flood_risk_info`(`flood_risk_title`, `flood_risk_content`, `creation_date`) VALUES ('$flood_risk_title','$flood_risk_content','$timestamp')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            header("Location: flood-risk-info?msg=Information Added Successfully!");
        }
    }
    $conn->close();
?>