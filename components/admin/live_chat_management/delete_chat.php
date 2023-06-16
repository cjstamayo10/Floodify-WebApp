<?php
    session_start();
    //Import Database, and Automatically Logout the Admin when inactive.
    require_once '../../../assets/config/db_conn/config.php';
    require_once '../../../assets/config/admin/database_management/admin_inactive_user.php';
    //Automatically return to login page when not logged in.
    if(!isset($_SESSION['lastname'])){
        header('location: admin-account');
    }
    //Get ID of specific info
    $id = $_GET['info_id'];
    //Delete column of selected ID in table
    $sql = "DELETE FROM `tbl_live_chat` WHERE message_id = $id";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        //Return to View Info page when deleted successfully
        header("Location: message-management?msgDel=Chat Deleted Successfully!");
    }
    else
    {
    echo "Failed: ".mysqli_error($conn);
    }
    //Close Database Conenction
    $conn->close();
?>