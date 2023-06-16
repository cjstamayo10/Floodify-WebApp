<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location:../../../frm_admin_login.php');
    }
    $id = $_GET['info_id'];
    $sql = "DELETE FROM `tbl_requestdata` WHERE request_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        header("Location: frm_request_data.php?msgDel=Information Deleted Successfully!");
    }
    else
    {
    echo "Failed: ".mysqli_error($conn);
    }
    $conn->close();
?>