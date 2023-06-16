<?php 
    require_once '../../../assets/config/db_conn/config.php';
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    // Delete all messages
    $sql = "DELETE FROM tbl_live_chat";
    if ($conn->query($sql) === TRUE) {
    echo "All messages have been cleared.";
    } else {
    echo "Error deleting messages: " . $conn->error;
    }
    // Close database connection
    $conn->close();
?>