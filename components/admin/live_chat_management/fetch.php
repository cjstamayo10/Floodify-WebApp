<?php 
    require_once '../../../assets/config/db_conn/config.php';
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM tbl_live_chat ORDER BY message_id DESC LIMIT 50";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
      while ($row = $result->fetch_assoc()) {
        ?>
        <div class="chatbox-container">
          <div class="action-time-container d-flex align-items-center">
            <div class="timestamp text-start me-2"><?php echo date('g:i A—D, d M Y', strtotime($row['timestamp'])); ?></div>
            <form action="delete-message-management" method="post">
                <a class="text-decoration-none text-white" href="delete-message-management?info_id=<?php echo $row['message_id'] ?>">
                    <button type="button" id="clear" class="btn btn-dark d-flex align-items-center">
                        <i class="fa-solid fa-trash-can me-1"></i>
                        Delete
                    </button>
                </a>
            </form>
          </div>
          <div class="chatbox-message d-flex flex-wrap flex-column">
            <div class="location fw-bold me-1"><?php echo $row['barangay']; ?></div>
            <div class="user-name-concern d-flex flex-wrap">
                <div class="user-name fw-bold me-1"><?php echo $row['user_name']; ?>: </div>
                <div class="concern"><?php echo $row['message'] ?></div>
            </div>
          </div>
        </div>
        <hr>
        <?php
      }
      echo "<script>$('#chatbox').scrollTop($('#chatbox')[0].scrollHeight);</script>";
    } 
    else 
    {
      echo '<p>No messages yet</p>';
    }
    $conn->close();
?>