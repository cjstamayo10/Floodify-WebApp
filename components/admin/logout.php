<?php
    session_start();
    require_once '../../assets/config/db_conn/config.php';
    require_once '../../assets/config/admin/dashboard/inactive_user.php';
    if(!isset($_SESSION['lastname'])){
        header('location: admin-login');
    }
    session_unset();
    if(session_destroy()){
        mysqli_close($conn);
        header('location: admin-login');
    }
    $conn->close();
?>