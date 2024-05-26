<?php

include('./includes/connection.php');
$department = $_SESSION['department'];

$stmt = $conn->prepare("SELECT COUNT(*) AS notification_count FROM leave_tbl WHERE department = ?");
$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $row = $result->fetch_assoc();
    $notificationCount = $row['notification_count'];
} else {
    echo "Error: " . $conn->error;
}


?>
