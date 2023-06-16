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
        $location_name = $_POST['location_name'];
        $temperature = $_POST['temperature'];
        $wind = $_POST['wind'];
        $humidity = $_POST['humidity'];
        $precipitation = $_POST['precipitation'];
        $sql = "INSERT INTO `tbl_weather_info`(`location_name`, `temperature`, `wind`, `humidity`, `precipitation`, `weather_date`) VALUES ('$location_name','$temperature','$wind','$humidity','$precipitation','$timestamp')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            header("Location: weather-info?msg=Information Added Successfully!");
        }
    }
    $conn->close();
?>