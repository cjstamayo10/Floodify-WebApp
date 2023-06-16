<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    $id = $_GET['info_id'];
    $sql = "DELETE FROM `tbl_flood_risk_info` WHERE flood_risk_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        header("Location: flood-risk-info?msgDel=Information Deleted Successfully!");
    }
    else
    {
    echo "Failed: ".mysqli_error($conn);
    }
    $conn->close();
?>