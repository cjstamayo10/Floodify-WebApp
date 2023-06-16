<?php 
    require_once '../../../assets/config/db_conn/config.php';
    $timestamp = date('Y-m-d H:i:s');
    $barangay = $_POST['barangay'];
    $user_name = $_POST['user_name'];
    $message = $_POST['message'];
    $sql = "INSERT INTO tbl_live_chat(`barangay`, `user_name`, `message`, `timestamp`) VALUES ('$barangay', '$user_name', '$message', '$timestamp')";
    $conn->query($sql);
    $conn->close();
?>