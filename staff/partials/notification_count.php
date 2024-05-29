<?php
include('./includes/connection.php');
$employee_id = $_SESSION['employee_id'];
// Assuming $employee_id is already defined
$stmt = $conn->prepare("SELECT COUNT(*) AS notification_count FROM leave_tbl WHERE employee_id = ?");
$stmt->bind_param("s", $employee_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result) {
    $row = $result->fetch_assoc();
    $notificationCount = $row['notification_count'];
} else {
    echo "Error: " . $conn->error;
}

?>