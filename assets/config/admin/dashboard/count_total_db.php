<?php 
    $sql = "SELECT COUNT(*) AS total FROM tbl_admin_verify";
    $sql_map = "SELECT COUNT(*) AS total_map FROM tbl_floodmap";
    $sql_risk = "SELECT COUNT(*) AS total_risk FROM tbl_flood_risk_info";
    $sql_info = "SELECT COUNT(*) AS total_info FROM tbl_website_info";
    $sql_weather = "SELECT COUNT(*) AS total_weather FROM tbl_weather_info";
    $sql_request_data = "SELECT COUNT(*) AS request_count FROM tbl_requestdata";
    $result = mysqli_query($conn, $sql);
    $result_map = mysqli_query($conn, $sql_map);
    $result_risk = mysqli_query($conn, $sql_risk);
    $result_info = mysqli_query($conn, $sql_info);
    $result_weather = mysqli_query($conn, $sql_weather);
    $result_request_data = mysqli_query($conn, $sql_request_data);
    if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result_map) > 0 || mysqli_num_rows($result_risk) > 0 || mysqli_num_rows($result_info) > 0 || mysqli_num_rows($result_weather) > 0 || mysqli_num_rows($result_request_data) > 0 ) {
        $row = mysqli_fetch_assoc($result);
        $row_map = mysqli_fetch_assoc($result_map);
        $row_risk = mysqli_fetch_assoc($result_risk);
        $row_info = mysqli_fetch_assoc($result_info);
        $row_weather = mysqli_fetch_assoc($result_weather);
        $row_request_data = mysqli_fetch_assoc($result_request_data);
        $count = $row['total'];
        $count_map = $row_map['total_map'];
        $count_risk = $row_risk['total_risk'];
        $count_info = $row_info['total_info'];
        $count_weather = $row_weather['total_weather'];
        $count_request_data = $row_request_data['request_count'];
    } else {
        echo "No data found.";
    }
?>