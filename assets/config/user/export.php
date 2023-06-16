<?php
    require_once('../../../vendor/tcpdf/tcpdf.php');
    require_once ('../db_conn/config.php');
    $timestamp = date('Y-m-d H:i:s');
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $user_name = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : 'resident';
    $sql_count = "SELECT COUNT(*) FROM tbl_requestdata WHERE user_name = '$user_name'";
    $result = $conn->query($sql_count);
    $row = $result->fetch_assoc();
    $count = $row['COUNT(*)'];
    $sql_request = "INSERT INTO tbl_requestdata (user_ip_address, user_name, date_updated) VALUES ('$user_ip', '$user_name', '$timestamp')";
    $conn->query($sql_request);
    $pdf = new TCPDF('P', PDF_UNIT, 'LEGAL', true, 'UTF-8', false);
    $pdf->SetCreator('Floodify Website');
    $pdf->SetAuthor('Floodify');
    $pdf->SetTitle('Malabon Flood Risk and Flood Map');
    $pdf->SetSubject('Flood Risk and Flood Map Info');
    $pdf->SetKeywords('PDF, TCPDF, PHP, MySQL');
    $pdf->AddPage();
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); }
    $sql = 'SELECT * FROM tbl_floodmap';
    $result = $conn->query($sql);
    $html = '<table border="1" cellpadding="5">';
    $html .= '<tr><th colspan="2" style="text-align: center; font-weight: bold; font-size: 16px;">Flood Map</th></tr>';
    $html .= '<tr><th style="text-align: center; font-weight: bold;">Flood Map</th><th style="text-align: center; font-weight: bold;">Flood Map Details</th></tr>';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $flood_map = $row['flood_map_img'];
            $html .= '<tr>';
            $html .= '<td style="vertical-align: top;"><img src="../../img/flood_map/'.$flood_map.'" alt=""></td>';
            $html .= '<td style="vertical-align: top;">' . $row['flood_map_title'] . '</td>';
            $html .= '</tr>'; } }
    $html .= '</table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); }
    $sql = 'SELECT * FROM tbl_flood_risk_info';
    $result = $conn->query($sql);
    $html = '<table border="1" cellpadding="5">';
    $html .= '<tr><th colspan="2" style="text-align: center; font-weight: bold; font-size: 16px;">Flood Risk</th></tr>';
    $html .= '<tr><th style="text-align: center; font-weight: bold;">Flood Risk Title</th><th style="text-align: center; font-weight: bold;">Flood Risk Details</th></tr>';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td style="vertical-align: top;">' . $row['flood_risk_title'] . '</td>';
            $html .= '<td style="vertical-align: top;">' . $row['flood_risk_content'] . '</td>';
            $html .= '</tr>'; } }
    $html .= '</table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $conn->close();
    $pdf->Output('Malabon City Flood Risk and Flood Map.pdf', 'D');
    header("Location: ../../../index.php");
?>