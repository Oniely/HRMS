<?php
session_start();

if (isset($_POST['leave_id'])) {
  $leave_id = $_POST['leave_id'];

  // Debugging code
  echo "Received LeaveId: " . $leave_id;

  // Update the session variable
  if (!isset($_SESSION['clicked_notifications'])) {
    $_SESSION['clicked_notifications'] = array();
  }
  $_SESSION['clicked_notifications'][] = $leave_id;

  echo "Updated session variable: " . print_r($_SESSION['clicked_notifications'], true);
}
?>