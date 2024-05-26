<?php
include('./includes/connection.php');
$employee_id = $_SESSION['employee_id'];
// Assuming $employee_id is already defined
$sql = "SELECT COUNT(*) AS notification_count FROM leave_tbl WHERE employee_id = $employee_id";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $notificationCount = $row['notification_count'];
} else {
    echo "Error: " . $conn->error;
}

?>