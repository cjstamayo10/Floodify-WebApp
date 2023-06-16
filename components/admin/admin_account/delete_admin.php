<?php 
    session_start();
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    $id = $_GET['user_id'];
    $sql = "DELETE FROM tbl_admin_verify WHERE `tbl_admin_verify`.`verified_id` = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
        $delete_info = "DELETE FROM tbl_admin WHERE `tbl_admin`.`admin_id` = $id";
        $result_delete = mysqli_query($conn, $delete_info);
        if($result_delete){
            header("Location: admin-account?msgDel=Account Deleted Successfully!");
        }
        else {
            echo "Failed: ".mysqli_error($conn);
        }
    }
    else {
            echo "Failed: ".mysqli_error($conn);
        }
    $conn->close();
?>