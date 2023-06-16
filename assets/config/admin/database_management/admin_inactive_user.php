<?php
// Set the time limit for inactivity
$inactive = 3600; // 1 hour in seconds
// Check if the last activity time is set
if (isset($_SESSION['timeout'])) {
  $session_life = time() - $_SESSION['timeout'];
  if ($session_life > $inactive) {
    // If the session has been inactive for longer than the limit, log out the user
    session_destroy();
    header('location: admin-login');
  }
}
// Update the last activity time
$_SESSION['timeout'] = time();
?>